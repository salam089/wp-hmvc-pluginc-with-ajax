<?php
/*
 * jQuery File Upload Plugin PHP Example
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */
if(!session_id()){
    session_start();

}
error_reporting(E_ALL | E_STRICT);
require('UploadHandler.php');


 $jobFolder = $job_folder = session_id(). "_" . date("Y-m-d");
 $user_folder = (isset($_SESSION["user_folder"]))? $_SESSION["user_folder"]:"quotation";

$uploadDir = "/data/files/$user_folder/$jobFolder/";
$uploadThumbDir = $uploadDir = "/data/files/$user_folder/$jobFolder/";


 //$uploadDir = "/data/files/quotation/Quotation-1245/";
//$uploadThumbDir = $uploadDir =  "/data/files/quotation/Quotation-1245/";


$data['options'] = array(
    'upload_dir' => $uploadDir,
    'upload_url' => 'http://www.clippingpath.dev/wp-admin/admin-ajax.php?action=upload_handaler&deleted_file=',
    'upload_thumb_dir' =>$uploadDir,
    'script_url' =>  'http://www.clippingpath.dev/wp-content/plugins/oel-cmp/templates/assets/js/uploader/server/php/index.php',
    'order_id' => '12300',
    'customer_dir'=> $uploadDir
);

//new UploadHandler( $data['options']);
$upload_handler = new UploadHandler($data['options']);
