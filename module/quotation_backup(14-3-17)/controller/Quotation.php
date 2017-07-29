<?php


class Quotation
{
    use loader;


    public $user_id;
    public $quotation_id;
    public $rurl;
    public $db;

    public function __construct($user_id = NULL)
    {
        global $wpdb;
        $database = $wpdb;
        $this->db = $database;


        $this->loadModel(get_class($this));
        $this->loadController("Users");

        //$this->sendQuotationMail();

        if ($user_id) {

            $this->user_id = $user_id;

        }elseif (is_user_logged_in()) {

            $this->user_id = get_current_user_id();

            // Initiate local database

        }


    }



    /**
     * by shah alam
     */


    private function sendQuotationMail(){
        $this->loadLibrary('Emails');
        if(class_exists('\App\Emails')){

            $email = \Swift_Message::newInstance();
            $loader = new \Twig_Loader_String();
            $twig = new \Twig_Environment($loader);

            $customer_name = "shah alam";
            $site_name = "Clipping Path india";
            $site_url = "https://www.clippingpathindia.com";
            $quotation_id = '00123';
            $subject = "{{email_action}} - {{site_name}}";

            // Get email template from WP custom post type
            $email_template = get_post( 3458);
            $subject = $email_template->post_title;
            $email_template->post_content;

            var_dump($email_template->post_content);
            extract($_POST);

            $email->setFrom('oel.shahalam@gmail.com'); //email address the website sends from
            $email->setTo($client_email);
            $email->setReplyTo('oel.mabrur@gmail.com'); //this is the bounce if they submit a bad email
            $email_action = "Quote Request Submitted";


            if(trim($sizing) == 'r'){
                $sizing_out = "Resize to:";
                if(isset($width)&& $width > 0&&isset($height)&& $height>0){
                    $sizing_union = " X ";
                }else{
                    $sizing_union = "";
                }
                if(isset($width)&& $width>0){
                    $widthTo = $width."px ";
                }
                if(isset($height)&& $height>0){
                    $heightTo = $height."px ";
                }

                if(isset($sizing_margin)&&$sizing_margin){
                    $margin = "Margin: ".$sizing_margin.$resizeMarginType;
                }else{
                    $margin = "";
                }

                $sizing_out .= $widthTo.$sizing_union.$heightTo;
            }


            if($sizing=='o'){
                $sizing_out = "Keep orginal size";
                if(isset($original_margin_chk)&& $original_margin_chk=='1'){
                    $margin = "Margin: ".$original_margin.$orginalMarginType;
                }else{
                    $margin = "";
                }

            }

            $message = "<table width=\"600px\" style=\"text-align:center;\">
            <tr>
            <td align='left' >
            <p class='our_p'>Dear {{client_name}},</p>
             <p  class='our_p'>&nbsp;</p>
             <p  class='our_p'>Thank you for your interest in our service. For your record, here are the details of your submission:</p>
             <p class='our_p'&nbsp;</p class='our_p'
             <p class='our_p'Your meassage: {{quotation_details}}</p>
             <p class='our_p'Quantity: {{quantity}}</p>
             <p class='our_p'Yearly quantity: {{yearly_quantity}} </p>
             <p class='our_p'Output size: {{sizing_out}}</p>
             <p class='our_p'{{margin}}</p>
             <p class='our_p'&nbsp;</p>

             <p class='our_p'We'll look at it and get back to you with a quote as quickly as we possibly can. If you have any question in the meantime, do not hesitate to contact us by replying to this email.</p>
            <p class='our_p'&nbsp;</p>
            <p style=\"font-weight:bold;\"> Best regards</p>
            <p class='our_p'&nbsp;</p>
           </td>
            </tr>
            <tr>
            <td>
                <table width=\"380\">
                    <tr>
                        <td align='left'><img src='https://www.clippingpathindia.com/wp-content/uploads/clipping-path-india-logo-email-signature.jpg'></td>
                         <td align='left'>
                         <p style=\"line-height:14px; font-size:12px; margin-bottom: 0px;\"><a href=\"mailto:baubd089@gmail.com\">babubd089@gmail.com</a></p>
                         <p style=\"line-height:14px; font-size:12px;margin-bottom: 0px;\">Foxhall Lodge. Foxhall Road</p>
                         <p style=\"line-height:14px; font-size:12px;margin-bottom: 0px;\">Nottingham, NG7 6LH, UK</p>
                         <p style=\"line-height:14px; font-size:12px;margin-bottom: 0px;\">+44 (0) 115 960 4510</p>
                         </td>
                    </tr>
                     <tr>
                        <td align='left' colspan='2'>
                        <div style=\"height:5px;width:330px;clear:both;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6em;background-color:#ccc;margin:5px 0px;padding:0\"> </div>
                                <div style=\"color:#ccc;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6em;margin:0;padding:0\">
                                <a style=\"color:#3b5998;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6em;margin:0;padding:0\"
                                href=\"https://www.facebook.com/clippingpathservice\" target=\"_blank\" data-saferedirecturl=\"https://www.google.com/url?hl=en&amp;q=https://www.facebook.com/clippingpathservice&amp;source=gmail&amp;ust=1488268737712000&amp;usg=AFQjCNGdEJkAX8cojJHdCCJpCRNxSUqidw\">Facebook</a> |
                                <a style=\"color:#55acee;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6em;margin:0;padding:0\" href=\"https://twitter.com/clip_path_india\" target=\"_blank\" data-saferedirecturl=\"https://www.google.com/url?hl=en&amp;q=https://twitter.com/clip_path_india&amp;source=gmail&amp;ust=1488268737712000&amp;usg=AFQjCNFqV2xfb6-LQziwj_acW6CeCBg1mw\">Twitter</a> |
                                <a style=\"color:#0976b4;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6em;margin:0;padding:0\"
                                href=\"https://uk.linkedin.com/company/clipping-path-india?trk=tabs_biz_home\" target=\"_blank\" data-saferedirecturl=\"https://www.google.com/url?hl=en&amp;q=https://uk.linkedin.com/company/clipping-path-india?trk%3Dtabs_biz_home&amp;source=gmail&amp;ust=1488268737712000&amp;usg=AFQjCNFLHUhU8Us_r8pFhFVff3zC1TngPA\">LinkedIn</a> |
                                <span style=\"color:#dd4b39;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6em;margin:0;padding:0\">
                                <a style=\"color:#dd4b39;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6em;margin:0;padding:0\"
                                 href=\"https://plus.google.com/u/0/+clippingpathindia\" target=\"_blank\" data-saferedirecturl=\"https://www.google.com/url?hl=en&amp;q=https://plus.google.com/u/0/%2Bclippingpathindia&amp;source=gmail&amp;ust=1488268737712000&amp;usg=AFQjCNH3xb_n0vRbgr1jbQ-MfZ063s_CAw\">Google+</a></span>
                                </div>
                                <div style=\"color:#999;font-size:90%;line-height:120%;font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;margin:6px 0 0;padding:0\">
                                    Clipping Path India is a brand of Outsource Experts Ltd. <br style=\"font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6em;margin:0;padding:0\">
                                    Company registered in England and Wales. <br style=\"font-family:'Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6em;margin:0;padding:0\">
                                     Registration No: 06815610. VAT No: GB980098593
                                </div>
                         </td>
                    </tr>
                </table>
               </td>
                </tr>
            </table>";

            $message = $email_template->post_content;

            $fields = [
                'client_name' => $client_name,
                'client_email' => $client_email,
                'site_name' => $site_name,
                'site_url' => $site_url,
                'quotation_id'=> $quotation_id,
                "email_action"=>$email_action,
                "post"=>$post,
                "quantity"=> $quantity,
                "yearly_quantity"=> $yearlyImgEdit,
                "quotation_details"=> $quotation_details,
                "sizing_out"=> $sizing_out,
                "margin" => $margin
            ];
            $subject = $twig->render($subject, $fields);
            $message = $twig->render($message, $fields);
            $email->setSubject($subject);
            $email->setBody($message, 'text/html');

            \App\Emails::sendEmail($email);
        }else{
            echo  "notfound";
        }

    }

    /**
     * @Author: Mamun
     */

    public function updatePotentialClient()
    {

        $data = array(
            'user_id' => $this->user_id,
            'conversion_status' => 1,
            'modify_date' => dateTime()
        );
        $this->db->update(CMP_POTENTIAL_CLIENT_TABLE, $data, array('id' => $_REQUEST['pcid']));
        //return true;
    }

    /**
     * @Author: Mamun
     */

    public function updateQuotation()
    {

        $data = array(
            'user_id' => $this->user_id,
            'modify_date' => dateTime()
        );

        $this->db->update(CMP_QUOTATION_TABLE, $data, array('id' => $_REQUEST['id']));

    }

    /**
     * @Author: Mamun
     */

    public function getQuotationDetails($invoice_ids)
    {
        global $wpdb;

        return $this->db->get_row("
			SELECT id,vendor, user_id,billing_name,billing_address,quotation_date, quotation_no, total_net, total_tax,tax_no,
                        vat_number,payment_instructions,notes,email_sent,username,currency, paid_in_full,total_gross,tax_rate,vendor_address,
                        potential_client_id,sizing,width,height,margin,marginType,quantity
			FROM " . CMP_QUOTATION_TABLE . "
			WHERE id = $invoice_ids
			", ARRAY_A
        );

    }

    /**
     * @Author: Mamun
     */

    public function getQuotationItemsDetails($quotation_id)
    {

        return $this->db->get_results("
			SELECT *
			FROM " . CMP_QUOTATION_ITEMS_TABLE . "
			WHERE quotation_id = " . $quotation_id, ARRAY_A
        );

    }

    /**
     * @Author: Mamun
     */

    public function getItemsSum($quotation_id)
    {

        return $this->db->get_row("
			SELECT
				SUM(job_id) job_id,
				SUM(net_price_per_unit) net_price_per_unit,
				SUM(no_of_units) no_of_units,
				SUM(discount_amount) discount_amount,
				SUM(net_price_for_item) net_price_for_item,
				SUM(tax_for_item) tax_for_item,
				SUM(gross_price_for_item) gross_price_for_item
			FROM " . CMP_QUOTATION_ITEMS_TABLE . "
			WHERE quotation_id = " . $quotation_id . "
			", ARRAY_A
        );

    }

    /**
     * @Author: Mamun
     */

    public function getCurrency()
    {

        $query = $this->db->get_row("
			SELECT currency
			FROM " . CMP_QUOTATION_TABLE . "
			WHERE user_id = " . $this->user_id . "
			AND paid_in_full = 0
			LIMIT 1
		");
        return ($query->currency) ? $query->currency : null;

    }

    /**
     * @Author: Mamun
     */

    public function processContactDetails()
    {

        $this->rurl = 'quotation-preview.html?id=' . $_REQUEST['id'] . '&pcid=' . $_REQUEST['pcid'] . '&secret_key=' . $_REQUEST['secret_key'];

        if (isset($_POST['order_step_2'])) {

            $error = null;

            if (!$_POST["contact_name"]) {

                $error .= "<li>Please enter your name</li>";
            }
            if (!$_POST['email']) {

                $error .= "<li>Please enter your email address</li>";
            }
            if (!$_POST["country"]) {

                $error .= "<li>Please select your country</li>";
            }
            if (!$_POST["find_us"]) {

                $error .= "<li>Please select how you found us</li>";
            }
            if (!is_email($_POST['email'])) {

                $error .= '<li>Invalid email address</li>';
            }
            if (!isset($_POST['create_account'])) {

                $error .= '<li>Please choose below whether you want to create an account or submit request as guest</li>';
            }

            $GLOBALS['contact_name'] = $_POST["contact_name"];

            $GLOBALS['email'] = $_POST["email"];

            $GLOBALS['company_name'] = $_POST["company_name"];

            $GLOBALS['country'] = $_POST["country"];

            $GLOBALS['find_us'] = $_POST["find_us"];

            $GLOBALS['username'] = $_POST["username"];


            if ($error) {

                $error = "<ul>" . $error . "</ul>";

                define('ERROR', $error);

            } else {

                if ($_POST['create_account'] == 0) {

                    wp_redirect($this->rurl);

                    exit;
                }
            }
        } else {

            if (is_user_logged_in()) {

                wp_redirect($this->rurl);

                exit;

            } else {

                $GLOBALS['contact_name'] = '';

                $GLOBALS['username'] = '';

                $GLOBALS['email'] = '';

                $GLOBALS['company_name'] = '';

                $GLOBALS['country'] = '';

                $GLOBALS['find_us'] = '';

            }
        }
    }

    /**
     * @Author: Mamun
     */

    public function quotationFound()
    {

        return $this->db->get_row("
			SELECT id,user_id
			FROM " . CMP_QUOTATION_TABLE . "
			WHERE id = " . $_GET['id'] . "
			AND quotation_date = " . $_GET['secret_key'] . "
			LIMIT 1
		");
    }

    public function freeTrialQuotatioAdd($data)
    {
        $user_data = array();
        $user_data['client_name'] = $account = sanitize_text_field($_POST['client_name']);
        $account = $user_data['client_email'] = sanitize_email($_POST['client_email']);
        $user_data['user_password'] = $_POST['password'];
        $user_data['find_us'] = sanitize_text_field($_POST['findus']);
        $user_data['terms'] = (isset($_POST['terms']) && !empty($_POST['terms'])) ? $_POST['terms'] : false;



        $this->loadController("Users");

        if (empty($account)) {
            $error = 'Enter an username or e-mail address.';
        } else {
            if (is_email($account)) {
                if (email_exists($account)) {
                    $get_by = 'email';
                    $exists_user_id = get_user_by( 'email', $account );
                } else {
                    $exists_user_id = false;
                }
            } else if (validate_username($account)) {
                if (username_exists($account))
                    $exists_user_id = get_user_by( 'email', $account );
                else
                    $exists_user_id = false;
            } else
                $error = 'Invalid username or e-mail address.';
        }


        if ($error) {
            $data = array("abc" => $data);
            $data['message'] = $error;
            $data['error'] = true;
            $data['success'] = false;
        } else {

            if (class_exists('Users')) {

                // Add currency
                $users = new Users();

                if( !$exists_user_id){
                    $sign_up_data = $users->user_signup($user_data);
                    if (is_int($sign_up_data)) {
                        $this->user_id = $sign_up_data;
                    }
                }

                $this->processQuotationRequirements($data);
                $data = array("inserted-data" => $sign_up_data);
                $data['message'] = 'Your Quotation have been submited';
                $data['error'] = false;
                $data['success'] = true;
            } else {
                $data = array("abc" => $data);
                $data['message'] = 'There is something going wrong try again or contact us.';
                $data['error'] = true;
                $data['success'] = false;
            }

        }

        return $data;

    }

    /**
     * @Author: Mamun
     * prepare data for quotaion form
     * check captcha error
     * create new potential client
     * create client quotaion
     */

    public function processQuotationRequirements($data, $all = false)
    {

        $client_email = sanitize_text_field($_POST['client_email']);

        $pcinfo = $this->existPotentialClient($client_email);



        if (isset($pcinfo->id) && ($pcinfo->id != '')) {


            $this->potential_client_id = $pcinfo->id;

           $potentialTableChangeStatus =  $this->updatePotentialClientdata();


        } else {

            $potentialTableChangeStatus = $this->potential_client_id = $this->insertPotentialClient();
        }



    if($potentialTableChangeStatus){
        return $this->insertQuotation();
    }else{
        return $potentialTableChangeStatus."fgf";
    }



    }

    /**
     * @Author: mamun
     * check already exist email address in the potential_client table
     */

    public function existPotentialClient($email)
    {
        global $wpdb;
        $row = $wpdb->get_row("
			SELECT *
			FROM " . CMP_POTENTIAL_CLIENT_TABLE . "
			WHERE client_email='" . $email . "' or  user_id = '" . $this->user_id . "'
			LIMIT 1");
        return $row;

    }

    /**
     * @Author: Mamun
     */

    public function updatePotentialClientdata()
    {




       $data = array(
            'client_name' => sanitize_text_field($_POST['client_name']),
            'client_email' => sanitize_text_field($_POST['client_email']),
            'modify_date' => cmp_dateTime()
        );


        return   $this->db->update(CMP_POTENTIAL_CLIENT_TABLE, $data, array('id' => $this->potential_client_id));



    }

    /**
     * @Author: Mamun
     * save customer's information to potential client table
     */

    public function insertPotentialClient()
    {
        global $wpdb;

        $data = array();

        $data['user_id'] = $this->user_id;

        $data['client_name'] = sanitize_text_field($_POST['client_name']);

        $data['client_email'] = sanitize_text_field($_POST['client_email']);

        $data['conversion_status'] = 0;

        $data['create_date'] = date('Y-m-d H:i:s');

        $data['modify_date'] = date('Y-m-d H:i:s');

        $data['billing_name'] = sanitize_text_field($_POST['client_name']);

        $geoip_country_name = 'BD';//getenv(GEOIP_COUNTRY_CODE);

        $data['client_country'] ="DB" ;$geoip_country_name;

        $wpdb->insert(CMP_POTENTIAL_CLIENT_TABLE, $data);

        return $wpdb->insert_id;

    }

    /**
     * @Author: Mamun
     * save customer's quotation into quotation table and update vendor table for next quotaion number
     */

    public function insertQuotation()
    {

        $this->quotation_id = $this->getlastQuotation();


        $newquotationNumber = 'CPI-Q-' . (substr(strrchr($this->quotation_id, "-"), 1) + 1);

        $vendorData = array("next_quotation_no" => $newquotationNumber);


        $data = array();

        $data['vendor'] = 'CPI';

        $data['potential_client_id'] = $this->potential_client_id;


        $data['user_id'] = $this->user_id;


        $data['billing_name'] = sanitize_text_field($_POST['client_name']);

        $data['quotation_no'] = $this->quotation_id;

        $data['quotation_date'] = strtotime(date('Y-m-d H:i:s'));

        $data['create_date'] = date('Y-m-d H:i:s');

        $data['modify_date'] = date('Y-m-d H:i:s');

        $data['status'] = 'Pending';


        $data['sizing'] = sanitize_text_field($_POST['sizing']);

        $data['quantity'] = sanitize_text_field($_POST['quantity']);

        $data['yearly_quantity'] = sanitize_text_field($_POST['yearlyImgEdit']);

        $data['quotation_details'] = sanitize_text_field($_POST['quotation_details']);

        $filepath = "";//$this->loadHelper('path');

        $data['image_folder'] = $filepath . session_id(). "_" . date("Y-m-d");//sanitize_text_field($_POST['quoteImgfolder']);

        if(isset($_POST['sizing']) && ($_POST['sizing']=='r')){

            if (isset($_POST['width']) && ($_POST['width'] != '')) {

                $data['width'] = sanitize_text_field($_POST['width']);

            }

            if (isset($_POST['height']) && ($_POST['height'] != '')) {

                $data['height'] = sanitize_text_field($_POST['height']);

            }


            if (isset($_POST['sizing_margin']) && ($_POST['sizing_margin'] != '')) {

                $data['margin'] = sanitize_text_field($_POST['sizing_margin']);

            }

            if (isset($_POST['resizeMarginType']) && ($_POST['resizeMarginType'] != '')) {

                $data['marginType'] = sanitize_text_field($_POST['resizeMarginType']);

            }

        }elseif(isset($_POST['sizing']) && ($_POST['sizing']=='o')){

            if (isset($_POST['original_margin']) && ($_POST['original_margin'] != '')) {

                $data['margin'] = sanitize_text_field($_POST['original_margin']);

            }

            if (isset($_POST['orginalMarginType']) && ($_POST['orginalMarginType'] != '')) {

                $data['marginType'] = sanitize_text_field($_POST['orginalMarginType']);

            }

        }


        $inserted_quotation = $this->db->insert(CMP_QUOTATION_TABLE, $data);



        if (is_wp_error($inserted_quotation)) {

            return $inserted_quotation->get_error_message();
        } else {

            unset($_SESSION["jod_folder"]);
            session_destroy();
            session_start();
            session_regenerate_id();
            $updated_vendor = $this->db->update(CMP_VENDOR_TABLE, $vendorData, array('vendor' => 'CPI'));

            if (is_wp_error($updated_vendor)) {
                return $updated_vendor->get_error_message();
            } else {
                return $updated_vendor;
            }
        }


    }

    /**
     * @Author: Mamun
     * retuen lastest quotation number
     */

    public function getlastQuotation()
    {

        $query = $this->db->get_row("
			SELECT next_quotation_no
			FROM " . CMP_VENDOR_TABLE . "
		");
        return $query->next_quotation_no;

    }

}

?>