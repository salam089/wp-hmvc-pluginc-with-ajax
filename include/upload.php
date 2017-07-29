<?php
ini_set('memory_limit', '256M');
@include_once('UploadHandler.php');

$uploadDir =dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'uploads'.DIRECTORY_SEPARATOR ;
$uploadThumbDir ='/wamp/www/cpiv3.1/wp-content/plugins/oel-cmp/include/uploads/';

$data['options'] = array(
    'upload_dir' => $uploadDir,
    'upload_url' => 'http://www.clippingpath.dev/app/form/upload',
    'upload_thumb_dir' => $uploadThumbDir,
    'script_url' => 'http://www.clippingpath.dev/app/form/upload',
    'order_id' => '90909',
    'customer_dir'=> $uploadDir
);

new UploadHandler($data['options']);

exit;
