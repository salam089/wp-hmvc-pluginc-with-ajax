<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/31/2016
 * Time: 2:24 PM
 */
class PostHandaler
{
    public $db, $controller, $class, $module, $method;



    function __construct($data)
    {
        global $wpdb;
        global $cpi_modules;
        $this->db = $wpdb;
        $class = strtolower(strstr($data->type, '_', true));
        $this->class = $class;
        $this->module = $class;
        $this->method = str_ireplace($class.'_', '', $data->type);
        switch ($class) {
            case "quote":
                $this->controller = ucfirst('Quotation');
                $controller_file_path = $cpi_modules['Quotation'].CPI_CONTROLLER.'/'.$this->controller.'.php';
                include_once($controller_file_path);
                break;
            default:
                 $this->controller = ucfirst($class);
                 $module_index = ucfirst($class);
                 $controller_file_path = $cpi_modules[$module_index].CPI_CONTROLLER.'/'.$this->controller.'.php';
                require_once($controller_file_path);
                break;
        }
        global $_POST;
        $post = $data;
        $_POST = (array)$post;

    }

    function quote_request($post)
    {

        $data = array();
        $quotation = new $this->controller();
        $inserted = $post;
        $inserted = $quotation->processQuotationRequirements($post->operation);

        if($inserted==true){
            $data = array("last_processed_data" => $inserted);
            $data['message'] = 'Your Quotation have been submited';
            $data['error'] = false;
            $data['success'] = true;
        }else{
            $data = array("error_data" => $inserted);
            $data['message'] = 'There is something going wrong refresh your browser and upload again';
            $data['error'] = true;
            $data['success'] = false;
        }

        return $data;
    }

    function quotation_free_trial_add($post){
        $data = array();
       $controller = $this->controller;


        if(class_exists($controller)){
            $this->controller." ==  class loaded";
            $quotationCtrl = new $controller();
            return $inserted = $quotationCtrl->freeTrialQuotatioAdd($post->operation);

        }else{

            return false;
        }


    }


    function quotation_list()
    {
        include_once('../wp-content/plugins/oel-cmp/Model/Quotation.php');
        $quotation = new Quotation();

        $data = $quotation->quotationList();
    }

    function getAll()
    {
        return $this->class . '--' . $this->controller;
    }


    function processRequest(){

        $object = new $this->controller();
        $args = func_get_args();

        $requested = call_user_func_array(array($object, generate_method_name($this->method)), $args);

        if($requested){
            return $requested;
        }else{
            $data = array("details" => array('post'=>$_POST, 'module'=>$this->module, 'method'=>$this->method, 'args'=>$args, 'requested'=>$requested));
            $data['message'] = 'There is something going wrong try again with method: '.$this->method;
            $data['error'] = true;
            $data['success'] = false;
            return $data;
        }



    }



}