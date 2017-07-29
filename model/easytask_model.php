<?php 





class Easytask {

	

	private $user_id;

	private $db;

	private $etdb;

	

	public function __construct($user_id = NULL) {

		

		require_once( ABSPATH.'/portal/include/include.php' );

		

		require_once( ABSPATH.'/portal/model/order_model.php' );



                //global $current_user;

                

		if ($user_id)

			$this->user_id = $user_id;

		elseif (is_user_logged_in() ) 

                    $this->user_id = get_current_user_id();

                

                    //$current_user = wp_get_current_user();

                    //$this->user_id = $current_user->ID;

                    //$this->user_id = 3888;

                    

                    

                    //$this->user_id = get_current_user_id();

                //}

			

		// Initiate local database

		global $wpdb;

		$this->db = $wpdb;

		

		// Initiate EasyTask database

		$this->etdb = new wpdb(ET_USER, ET_PASS, ET_DB, ET_HOST);

	}

		

	

	/*

	* @Author: Atiqur Sumon

	*/

	public function insertClient() {

		$user_info = get_userdata($this->user_id);

		

		$data = array(

			'user_id' => $user_info->ID,

			'username' => $user_info->user_login,

			'email' => $user_info->user_email,

			'create_date' => $user_info->user_registered,

			'modify_date' => $user_info->user_registered,

			'vendor' => VENDOR

		);

		

		// Add contact name

		if (isset($_POST['contact_name']))

			$data['name'] = sanitize_text_field($_POST['contact_name']);

		else

			$data['name'] = $user_info->user_nicename;

		// Add company name

		if (isset($_POST['company_name']))

			$data['cname'] = sanitize_text_field($_POST['company_name']);

		// Add country

		if (isset($_POST['country']))

			$data['country'] = $_POST['country'];

		// Add currency

		if (isset($_POST['default_currency']))

			$data['default_currency'] = $_POST['default_currency'];

		// Add currency

		if (isset($_POST['find_us']))

			$data['find_us'] = sanitize_text_field($_POST['find_us']);

		

		// Insert data into clients table

		$this->etdb->insert( ET_CLIENT_TABLE, $data );

	}

	



	/*

	* @Author: Atiqur Sumon

	*/

	public function deleteClient() {

		$this->etdb->delete( ET_CLIENT_TABLE, array('user_id' => $this->user_id, 'vendor' => VENDOR) );

	}

	

	

	/*

	* @Author: Atiqur Sumon

	*/

	public function insertTempJob() {

		if (!$this->_tempJobExists() ) {

			$order = new Order();

			$row = $order->getTempOrder($_GET['id']);

			$data = $this->_preDataForET($row);

			// Insert job into EasyTask job table

			$job_id = $this->_insertJob($data);

                      

                        $order->updateJobId($_GET['id'], $job_id);

                 

			return $job_id;

		}

	}



        

	/*

	* @Author: Atiqur Sumon

	*/

        public function lastOrderOffice() {

            if ($this->user_id && $this->user_id > 0) {

                $client_id = $this->_getETClientID();

                

		$row = $this->etdb->get_row( "

			SELECT office

			FROM ".ET_JOB_TABLE." 

			WHERE clientid = ".$client_id." 

			AND vendor = '".VENDOR."'

                        AND status IN ('Being reviewed', 'Completed', 'Correction', 'E-mail sent', 'In progress', 'On hold', 'Revision')

                        AND office != ''

                        ORDER BY id DESC

			LIMIT 1");

		return ($this->etdb->num_rows) ? $row->office : false;

            }

            else {

                return false;

            }

        }



        

	/*

	* @Author: Atiqur Sumon

	*/

	private function _insertJob($data) {

		$this->etdb->insert( ET_JOB_TABLE, $data );

		return $this->etdb->insert_id;

	}





	/*

	* @Author: Atiqur Sumon

	*/

	private function _preDataForET($row) {

		$data = array( 

			'temp_job_id' => $row->id, 

			'vendor' => VENDOR, 

                        'office' => $row->office,

			'request' => $row->request, 

			//'jobtype' => $row->service, 

			//'quantity' => $row->quantity, 

			//'format' => $row->format.'. '.$row->options.'. '.$row->path, 

			'time' => dateTime(), 

			//'comment' => 'Request: '.$row->request.'. Turnaround: '.$row->turnaround, 

			//'price' => $row->quotation, 

			//'instruction' => $row->instruction, 

			'status' => $row->status,

			//'joborder' => '100' 

		);

		return $data;

	}



	

	/*

	* @Author: Atiqur Sumon

	*/

	private function _addLatestData($row) {

		$data = array( 

			'id' => $row->job_id,

			'jobname' => $row->jobname,

			'jobtype' => $row->service, 

			'quantity' => $row->quantity,

			'format' => $row->format.'. '.$row->options.'. '.$row->path, 

			'comment' => 'Request: '.$row->request.'. Turnaround: '.$row->turnaround, 

			'price' => $row->quotation, 

			'instruction' => $row->instruction, 

			'note' => $row->upload_note,

			'status' => 'Awaiting review',

			'time' => dateTime(),

			'joborder' => '100'

		);

		return $data;

	}



	

	/*

	* @Author: Atiqur Sumon

	*/

	private function _tempJobExists() {

		$count = $this->etdb->get_var( "

			SELECT COUNT(*) 

			FROM ".ET_JOB_TABLE."

			WHERE `temp_job_id` = ".$_GET['id']."

			AND `vendor` = '".VENDOR."'");

		return ($count >= 1) ? true : false;

	}

	



	/*

	* @Author: Atiqur Sumon

	*/

	public function submitRequest($temp_job_id) {

            

                /*if(($temp_job_id == '')||($temp_job_id == 0)){

                    $txt = date("Y-m-d H:i:s").' Temp job id missing';

                    $myfile = file_put_contents('logs.txt', $txt.PHP_EOL , FILE_APPEND);

                }else{

                    $txt = $temp_job_id.' Temp job id is ok';

                    $myfile = file_put_contents('logs.txt', $txt.PHP_EOL , FILE_APPEND);

                }*/

            

		$order = new Order();

		$row = $order->getTempOrder($temp_job_id);

		

                

		$email = $row->email;



		// Get temp job data, manipulate and then insert into EasyTask job table

		$data = $this->_preDataForET($row);

		$latest_data = $this->_addLatestData($row);

		$data = array_merge( $data, $latest_data );



		if ($this->user_id) {

			// Get ID from easytask client table

			$client_id = $this->_getETClientID();

			// If client not found, then insert it and get inserted ID

			if (!$client_id) {

				$client_id = $this->_insertClientIntoET();

			}

		}

		else {

			// Check whether or not this customer is added to easytask client table as guest, if yes then return ID, if not then insert and then return id

			$client_id = $this->_getETGuestID($email);

			

			//echo '<pre>Print: '; print_r($client_id); echo '</pre>';

			if ($client_id) {

				$this->_updateETGuest($row, $client_id);

			}

			else {

				$client_id = $this->_insertETGuest($row);

			}

		}

		

		$data['clientid'] = $client_id;

		

		//echo '<pre>Print: '; print_r($data); echo '</pre>';

		

		

               

                $this->_updateJob($data);

             

		$this->_insertJobHistory($data);

		return true;

	}

	



	/*

	* @Author: Atiqur Sumon

	*/

	private function _insertJobHistory($data) {

		$data['jobid'] = $data['id'];

		unset($data['id']);

		unset($data['temp_job_id']);

		$data['added_time'] = dateTime();

		$this->etdb->insert(ET_JOB_HISTORY_TABLE, $data);

	}

	



	/*

	* @Author: Atiqur Sumon

	*/

	private function _insertClientIntoET() {

		require_once( ABSPATH.'/portal/model/client_model.php' );

		$client = new Client($this->user_id);



		$client_data = $client->getClientData();

		$data = $this->_prepClientDataForET($client_data);

		$this->etdb->insert( ET_CLIENT_TABLE, $data );

		return $this->etdb->insert_id;

	}

	

	/*

	* @Author: Atiqur Sumon

	*/

	private function _prepClientDataForET($data) {

		unset($data['id']);

		$data['vendor'] = VENDOR;

		$data['name'] = $data['contact_name'];

		unset($data['contact_name']);

		$data['username'] = $data['user_login'];

		unset($data['user_login']);

		$data['cname'] = $data['company_name'];

		unset($data['company_name']);

		$data['address1'] = $data['address_1'];

		unset($data['address_1']);

		$data['address2'] = $data['address_2'];

		unset($data['address_2']);

		$data['address3'] = $data['address_3'];

		unset($data['address_3']);

		$data['invoice_email_address'] = $data['invoice_email'];

		unset($data['invoice_email']);

		$data['website'] = $data['website_url'];

		unset($data['website_url']);

		$data['phone'] = $data['telephone'];

		unset($data['telephone']);

		$data['note'] = $data['other_note'];

		unset($data['other_note']);

		

		return $data;

	}

	



	/*

	* @Author: Atiqur Sumon

	*/

	private function _updateJob($data) {

		//echo $data['id'];

		

                

                try {

                      $this->etdb->update( ET_JOB_TABLE, $data, array('id' => $data['id']) );

                    }

                    //catch exception

                    catch(Exception $e) {

                        $txt = date("Y-m-d H:i:s").$e->getMessage();

                        //$myfile = file_put_contents('logs2.txt', $txt.PHP_EOL , FILE_APPEND);

                    }

                

                

	}

	

	/*

	* @Author: Atiqur Sumon

	*/

	private function _getETClientID() {

		$row = $this->etdb->get_row( "

			SELECT id

			FROM ".ET_CLIENT_TABLE." 

			WHERE user_id = ".$this->user_id." 

			AND vendor = '".VENDOR."'

			LIMIT 1");

		return ($this->etdb->num_rows) ? $row->id : NULL;

	}

	

	/*

	* @Author: Atiqur Sumon

	*/

	private function _getETGuestID($email) {

		$row = $this->etdb->get_row( "

			SELECT id

			FROM ".ET_CLIENT_TABLE." 

			WHERE email = '".$email."'

			AND vendor = '".VENDOR."'

			AND user_id = '0' 

			LIMIT 1");

		return ($this->etdb->num_rows) ? $row->id : NULL;

	} 

        

        

        

        public function orderAwaitingPayment(){

            

           /*if(($this->user_id == '')||($this->user_id == 0)){

                $txt = date("Y-m-d H:i:s").' user id missing';

                $myfile = file_put_contents('logs.txt', $txt.PHP_EOL , FILE_APPEND);

            }*/

              

            $query = $this->etdb->get_row("

		SELECT *

		FROM ".ET_JOB_TABLE."

		JOIN ".ET_CLIENT_TABLE." ON ".ET_JOB_TABLE.".clientid = ".ET_CLIENT_TABLE.".id

		WHERE ".ET_CLIENT_TABLE.".user_id = ".$this->user_id." 

		AND ".ET_JOB_TABLE.".vendor = '".VENDOR."' 

		AND ".ET_JOB_TABLE.".`status` IN ('Awaiting confirmation','Awaiting payment')");

		

		return $this->etdb->num_rows;

                

        }

	



	/*

	* @Author: Atiqur Sumon

	*/

	private function _insertETGuest($row) {

		$data = $this->_prepGuestDataForET($row);		

		$this->etdb->insert(ET_CLIENT_TABLE, $data);

		return $this->etdb->insert_id;

	}

	

	/*

	* @Author: Atiqur Sumon

	*/

	private function _updateETGuest($row, $client_id) {

		$data = $this->_prepGuestDataForET($row);		

		$this->etdb->update(ET_CLIENT_TABLE, $data, array('id' => $client_id) );

	}

	



	/*

	* @Author: Atiqur Sumon

	*/

	private function _prepGuestDataForET($row) {

		$data = array();

		$data['vendor'] = VENDOR;

		$data['username'] = $row->ip_address;

		$data['name'] = $row->contact_name;

		$data['email'] = $row->email;

		$data['cname'] = $row->company_name;

		$data['country'] = $row->country;

		$data['default_currency'] = $row->default_currency;

		$data['find_us'] = $row->find_us;

		$data['create_date'] = dateTime();

		$data['modify_date'] = dateTime();

		

		return $data;

	}





	/*

	* @Author: Atiqur Sumon

	*/

	public function getOrders() {



		// Limit

		$sLimit = "";

		if ( isset( $_REQUEST['iDisplayStart'] ) && $_REQUEST['iDisplayLength'] != '-1' ) {

			$sLimit = "LIMIT ".intval( $_REQUEST['iDisplayStart'] ).", ".

			intval( $_REQUEST['iDisplayLength'] );

		}

		

		// Order by

		$sOrder = "ORDER BY ".ET_JOB_TABLE.".time DESC";

		

		// Where

		//$fWhere = "WHERE user_id = ".$this->user_id." AND paid_in_full IN (".$status.")";

		$fWhere = "WHERE ".ET_CLIENT_TABLE.".user_id = ".$this->user_id." AND ".ET_JOB_TABLE.".vendor = '".VENDOR."' AND ".ET_JOB_TABLE.".status != 'Cancelled'";

		//$fWhere = "WHERE 1";

		$sWhere = $fWhere;

		

		$sQuery = "

		SELECT SQL_CALC_FOUND_ROWS ".

			ET_JOB_TABLE.".id, ".

			ET_JOB_TABLE.".jobname, ".

			ET_JOB_TABLE.".quantity, ".

			ET_JOB_TABLE.".time, ".

			ET_JOB_TABLE.".deadline, ".

			ET_JOB_TABLE.".office, ".

			ET_JOB_TABLE.".status 

		FROM ".ET_JOB_TABLE."

		LEFT JOIN ".ET_CLIENT_TABLE." ON ".ET_JOB_TABLE.".clientid = ".ET_CLIENT_TABLE.".id

		$sWhere

		$sOrder

		$sLimit

		";

		$rResult = $this->etdb->get_results($sQuery, ARRAY_A);

		

		$sQuery = "SELECT FOUND_ROWS()";

		$iFilteredTotal = $this->etdb->get_var($sQuery);

		

		$sQuery = "

		SELECT COUNT(".ET_JOB_TABLE.".id)

		FROM ".ET_JOB_TABLE." 

		LEFT JOIN ".ET_CLIENT_TABLE." ON ".ET_JOB_TABLE.".clientid = ".ET_CLIENT_TABLE.".id

		".$fWhere;



		$iTotal = $this->etdb->get_var($sQuery);

		

		$output = array(

			"sEcho" => intval($_REQUEST['sEcho']),

			"iTotalRecords" => $iTotal,

			"iTotalDisplayRecords" => $iFilteredTotal,

			"aaData" => array()

		);

		

		foreach($rResult as $aRow) {

                    // Date submitted

                    $date_submitted = date( "d M Y H:i", strtotime($aRow['time']) );

                    // Date submitted

                    $deadline = ($aRow['deadline'] != '0000-00-00 00:00:00') ? date( "d M Y H:i", strtotime($aRow['deadline']) ) : "";

                    // Est. Time left

                    if ($aRow['status'] == 'In progress') {

                            $est_completion_time = ($aRow['deadline'] != '0000-00-00 00:00:00') ? strtotime($aRow['deadline'] ) : null;

                            if ($est_completion_time != null) {

                                    $est_completion_time = $est_completion_time - time();

                                    $time_left = '<span class="badge badge-info">'.formatCompTime($est_completion_time).'</span>';

                            }

                    }

                    else {

                            $time_left = "...";

                    }

                    // Status

                    $status = $this->_formatStatus($aRow['status']);



                    $row = array($aRow['id'], $aRow['jobname'], $aRow['quantity'], $date_submitted, $deadline, $time_left, $status);



                    $output['aaData'][] = $row;

		}

		

		return json_encode( $output );

	}

	



	/*

	* @Author: Atiqur Sumon

	*/

	private function _formatStatus($status) {

		if ($status == 'Awaiting review')

			return '<div class="label label-warning">'.$status.'</div>';

		elseif ($status == 'Being reviewed')

			return '<div class="label label-warning">'.$status.'</div>';

		elseif ($status == 'In progress')

			return '<div class="label label-info">'.$status.'</div>';

		elseif ($status == 'E-mail sent')

			return '<div class="label label-success">Completed</div>';

		elseif ($status == 'Completed')

			return '<div class="label label-success">'.$status.'</div>';

		elseif ($status == 'Awaiting confirmation')

			return '<div class="label label-primary">'.$status.'</div>';

		elseif ($status == 'Awaiting payment')

			return '<div class="label label-primary">'.$status.'</div>';

		elseif ($status == 'On hold')

			return '<div class="label label-warning">'.$status.'</div>';

		elseif ($status == 'Correction')

			return '<div class="label label-danger">'.$status.'</div>';

		elseif ($status == 'Revision')

			return '<div class="label label-secondary">'.$status.'</div>';

		else 

			return null;

	}





	/*

	* @Author: Atiqur Sumon

	*/

	public function updateClientIntoET($client_data) {

		$data = $this->_prepClientDataForET($client_data);

		$this->etdb->update( ET_CLIENT_TABLE, $data , array('vendor' => VENDOR, 'user_id' => $this->user_id) );

	}

	

	

	/*

	* @Author: Atiqur Sumon

	*/

	public function totalOrder() {

		$query = "

		SELECT COUNT(*) total_order

		FROM ".ET_JOB_TABLE."

		LEFT JOIN ".ET_CLIENT_TABLE." ON ".ET_JOB_TABLE.".clientid = ".ET_CLIENT_TABLE.".id

		WHERE ".ET_CLIENT_TABLE.".user_id = ".$this->user_id." 

		AND ".ET_JOB_TABLE.".vendor = '".VENDOR."' 

		AND ".ET_JOB_TABLE.".status IN ('Awaiting confirmation', 'Awaiting payment', 'Awaiting review', 'Being reviewed', 'Completed', 'Correction', 'E-mail sent', 'In progress', 'On hold', 'Revision')";

		

		return $this->etdb->get_var($query);

	}

        

        

        

                



	/*

	* @Author: Atiqur Sumon

	*/

	public function orderInProgress() {

		$query = "

		SELECT COUNT(*) in_progress

		FROM ".ET_JOB_TABLE."

		LEFT JOIN ".ET_CLIENT_TABLE." ON ".ET_JOB_TABLE.".clientid = ".ET_CLIENT_TABLE.".id

		WHERE ".ET_CLIENT_TABLE.".user_id = ".$this->user_id." 

		AND ".ET_JOB_TABLE.".vendor = '".VENDOR."' 

		AND ".ET_JOB_TABLE.".status IN ('In progress')";

		

		return $this->etdb->get_var($query);

	}
	
	
	
	
	/*
     * @Author: Mamun
     * create a new job for quotation in easytask job table
     */

    public function insertQuotationJob($temp_job_id) {


        $order = new Order();
        $row = $order->getTempOrder($temp_job_id);
        $data = $this->_preQuotationDataForET($row);




        // Insert job into EasyTask job table
        $job_id = $this->_insertJob($data);



        $order->updateJobId($temp_job_id, $job_id);

        $client_id = $this->_getETClientID();

        $this->_updateEasytaskJobId($job_id, $client_id);

        return $job_id;
    }




 /*
     * @Author: Mamun
     * update easytask job for quotation table with client_id
     */

    private function _updateEasytaskJobId($job_id, $client_id) {

        $data = array(
            'clientid' => $client_id,
            'office' => 'Dhaka'
        );

        $this->etdb->update(ET_JOB_TABLE, $data, array('id' => $job_id));
    }

    /*
     * @Author: Mamun
     * prepare data for quotation easytask job table
     */

    private function _preQuotationDataForET($row) {
        $data = array(
            'temp_job_id' => $row->id,
            'userid' => $row->user_id,
            'vendor' => VENDOR,
            'request' => $row->request,
            'jobtype' => $row->service,
            'quantity' => $row->quantity,
            'format' => $row->format . '. ' . $row->options . '. ' . $row->path,
            'time' => dateTime(),
            'comment' => 'Request: ' . $row->request . '. Turnaround: ' . $row->turnaround,
            'price' => $row->quotation,
            'instruction' => $row->instruction,
            'status' => 'Being reviewed',
            'sizing' => $row->sizing,
            'width' => $row->width,
            'height' => $row->height,
            'margin' => $row->margin,
            'marginType' => $row->marginType,
            'joborder' => '100'
        );
        return $data;
    }


    /*
     * @Author: Mamun
     * Update job table with comments and file format
     */
    
    public function updateJobStatus($job_id) {

        $data['status'] = 'Being reviewed';

        //modify by Mamun

        if (isset($_POST['comment']) && ($_POST['comment'] != '')) {
            $data['comment'] = $_POST['comment'] . ' Request: Quote' . '. Turnaround: 24 hours';
        }

        if (isset($_POST['format']) && ($_POST['format'] != '')) {
            $data['format'] = $_POST['format'];
        }

        $data['id'] = $job_id;

        $this->_updateJob($data);
    }
	
	
	/*
	* @Author: Mamun
	*/
	public function getJobDetails($qno) {
          
		return $this->etdb->get_row("
			SELECT ".
			ET_JOB_TABLE.".jobname, ".

			ET_JOB_TABLE.".userid, ".

			ET_JOB_TABLE.".temp_job_id, ".

			ET_IPN_ORDERS_TABLE.".payment_status                            

			FROM ".ET_JOB_TABLE." 
                            
            JOIN ".ET_IPN_ORDERS_TABLE." ON ".ET_JOB_TABLE.".quotation_no = ".ET_IPN_ORDERS_TABLE.".custom 
                            
			WHERE ".ET_JOB_TABLE.".quotation_no = '".$qno."'
                            
			LIMIT 1", ARRAY_A);
	}
    
    
    
    
    
    }





?>