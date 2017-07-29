<?php
function redirect($url) {
    $string = '<script type="text/javascript">';
    $string .= 'window.location = "' . $url . '"';
    $string .= '</script>';
    echo $string;
}

function getCountries() {
	global $wpdb;
	return $wpdb->get_results( 'SELECT * FROM countries', OBJECT );
}

function getCurrencies() {
	$array = array(
		'AUD' => 'Australian Dollar',
        'CAD' => 'Canadian Dollar',
        'EUR' => 'Euro',
        'GBP' => 'British Pound (Sterling)',
        'USD' => 'US Dollar'
	);
	return $array;
}

function getFindUs() {
	$array = array(
		'Referral from Friend or Colleague',
        'Online Search',
        'Blog or Magazine Article',
        'Twitter / Facebook / Linkedin / Social Site',
        'Advertisement',
        'Used before',
		'Other'
	);
	return $array;
}

function dateTime() {
	return date('Y-m-d H:i:s');
}

function getIP() {
    //return $_SERVER['REMOTE_ADDR']; // Old method
    //
    //Just get the headers if we can or else use the SERVER global // New method
    if ( function_exists( 'apache_request_headers' ) ) {
        $headers = apache_request_headers();
    } 
    else {
        $headers = $_SERVER;
    }
    //Get the forwarded IP if it exists
    if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {
        $the_ip = $headers['X-Forwarded-For'];
    } 
    elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {
        $the_ip = $headers['HTTP_X_FORWARDED_FOR'];
    } 
    else {
        $the_ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
    }
    return $the_ip;
}
        
function errorFormat($msg) {
	return '<div class="alert alert-danger"> '.$msg.'</div>';
}

function successFormat($msg) {
	return '<div class="alert alert-success"> '.$msg.'</div>';
}

function infoFormat($msg) {
	return '<div class="alert alert-info"> '.$msg.'</div>';
}

function checkCaptcha () {
	//return true;// temporary
	if ( is_user_logged_in() ) {
		return true;
	}
	else {
		if ( ( function_exists( 'cptch_check_custom_form' ) && cptch_check_custom_form() !== true ) || ( function_exists( 'cptchpr_check_custom_form' ) && cptchpr_check_custom_form() !== true ) )
			return false;
		else 
			return true;
	}
}

function captchaErrorMsg() {
	return "Please complete the CAPTCHA.";
}

function invalidUrlMsg() {
        $to = "sumonmg@me.com, shakilearl@gmail.com, oel.mamunraza@gmail.com";
        $subject = "CPI Error";
        $message = "A customer tried to submit order/quote, but got an error. Here is the details:\r\nFull URL: ".selfURL()." \r\nIP: ".getIP()." \r\nUser ID: ".get_current_user_id();
        //wp_mail($to, $subject, $message);
        
	return "Opps! It looks like there is something wrong with the url. Please <a href='".CONTACT_URL."'>let us know</a> of this error so that we can fix it.";
}

function selfURL() { 
    $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : ""; 
    $protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s; 
    $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]); 
    return $protocol."://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; 
} 

function strleft($s1, $s2) { 
    return substr($s1, 0, strpos($s1, $s2)); 
}

function base64url_encode($data) { 
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
}

function base64url_decode($data) { 
  return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
} 
 
function enquirySubjects() {
	$array = array(
		'Pricing or product related enquiry',
		'Order related enquiry',
		'Billing or invoice related enquiry',
		'Other enquiry',
	);
	return $array;
}

function fileFormates() {
	$array = array(
		"JPG, leave original background",
		"JPG, white background",
		
		"PSD, Transparent background single layer",
		"PSD, Transparent background multiple layer",
		"PSD, layer mask single layer",
		"PSD, white background single layer",
		"PSD, white background multiple layer",
		"TIF, Transparent background single layer",
		"TIF, Transparent background multiple layer",
		"TIF, layer mask single layer",
		"TIF, white background single layer",
		"TIF, white background multiple layer",
		
		"PNG, transparent background",
		"PNG, white background",
		
		"AI",
		"EPS",
		"PDF",
		"Other (please specify in the instruction area below)"
	);
	return $array;
}

function turnaroundTimes() {
	$array = array(
		'Flexible',
		'12 hours',
		'18 hours',
		'24 hours',
		'36 hours',
		'48 hours',
		'72 hours',
		'Other'
	);
	return $array;
}

function quotationOptions() {
	$array = array(
		'Start work immediately',
		'Start work and send quotation',
		'Send quotation first',
	);
	return $array;
}

function europeCountries() {
	$array = array(
		'AL', 'AD', 'AT', 'BY', 'BE', 'BA', 
		'BG', 'HR', 'CY', 'CZ', 'DK', 'EE', 
		'FO', 'FI', 'FR', 'DE', 'GI', 'GR', 
		'HU', 'IS', 'IE', 'IT', 'LV', 'LI', 
		'LT', 'LU', 'MK', 'MT', 'MD', 'MC',
		'NL', 'NO', 'PL', 'PT', 'RO', 'RU',
		'SM', 'RS', 'SK', 'SI', 'ES', 'SE',
		'CH', 'UA', 'VA', 'RS', 'IM', 'RS', 'ME'
	);
	return $array;
}

/*
* @Author: Atiqur Sumon
*/
function currencySymbol($currency) 
{
	if ($currency == "USD" || $currency == "AUD" || $currency == "CAD")
		$symbol = "&#36;";
	elseif ($currency == "GBP")
		$symbol = "&#163;";
	elseif ($currency == "EUR")
		$symbol = "&#8364;";
	else
		$symbol = '';
	return $symbol;
}

/*
* @Author: Atiqur Sumon
*/
function invoiceStatusLabel($key) 
{
	$array = array(
		0 => "Due",
		1 => "Paid",
		2 => "Cancel",
		3 => "Processing eCheque",
		5 => "Processing Cheque",
		4 => "Under Review"
	);
	return $array[$key];
}

/*
* @Author: Atiqur Sumon
*/
function getEmailsAsArray ($em, $em_cc) {
	$email = preg_replace('/\s+/', '', $em);
	$email_array = explode(',', $email);
	$email_cc = preg_replace('/\s+/', '', $em_cc);
	$email_cc_array = explode(',', $email_cc);
	return array_filter( array_merge( $email_array, $email_cc_array ) );
}

/*
* @Author: Atiqur Sumon
*/
function paymentMethodLabel($key) {
	$array = array(
		'BB' => "Cheque",
		'DD' => "Direct debit",
		'FF' => "Standing order",
		'EE' => "Bank transfer",
		'CC' => "Credit card",
		'GG' => "Online",
		'AA' => "Cash",
		'XX' => "Other",
	);
	return $array[$key];
}


/*
* @Author: Atiqur Sumon
*/
/*function clientTableFields() 
{
	$array = array(
		// Contact details
		'contact_name',
		'email',
		'invoice_email',
		'company_name',
		'website_url',
		'telephone',
		//Billing address
		'address_1',
		'address_2',
		'address_3',
		'town',
		'state',
		'postcode',
		'country',
		'vat_number',
		'tax_exemption_code',
	);
	return $array;
}*/


/*
* @formatTimeAgo():
* @Author: Atiqur Sumon
*/
function formatCompTime($second) {
	if ($second < 60)
		$output = $second . " sec";
	elseif ($second >= 60 && $second < 1200)
		$output = formatMinuteSecond($second);
	elseif ($second >= 1200 && $second < 3600)
		$output = round($second / 60) . " min";
	elseif ($second >= 3600 && $second < 172800)
		$output = formatHourMinute($second);
	elseif ($second >= 172800 && $second < 2592000)
		$output = formatDayHour($second);
	elseif ($second >= 2592000 && $second < 31104000)
		$output = formatMonthDay($second);
	else {
		$output = formatYearMonth($second);
	}
	
	return $output;
}

/*
* @formatTimeAgo():
* @Author: Atiqur Sumon
*/
function formatMinuteSecond($second) {
	$minute = floor($second / 60);
	$rem_second = $second - ($minute * 60);
	$seconds = round($rem_second);
	return $minute . " min " . $seconds . " sec";
}

/*
* @formatTimeAgo():
* @Author: Atiqur Sumon
*/
function formatHourMinute($second) {
	$hour = floor($second / 60 / 60);
	$rem_second = $second - ($hour * 60 * 60);
	$minute = round($rem_second / 60);
	return $hour . " hr " . $minute . " min";
}

/*
* @formatDayHour():
* @Author: Atiqur Sumon
*/
function formatDayHour($second) {
	$day = floor($second / 60 / 60 / 24);
	$rem_second = $second - ($day * 60 * 60 * 24);
	$hour = round($rem_second / 60 / 60);
	return $day . " day " . $hour . " hr";
}

/*
* @formatMonthDay():
* @Author: Atiqur Sumon
*/
function formatMonthDay($second) {
	$month = floor($second / 60 / 60 / 24 / 30);
	$rem_second = $second - ($month * 60 * 60 * 24 * 30);
	$day = round($rem_second / 60 / 60 / 24);
	return $month . " mon " . $day . " day";
}

/*
* @formatYearMonth():
* @Author: Atiqur Sumon
*/
function formatYearMonth($second) {
	$year = floor($second / 60 / 60 / 24 / 30 / 12);
	$rem_second = $second - ($year * 60 * 60 * 24 * 30 * 12);
	$month = round($rem_second / 60 / 60 / 24 / 30);
	return $year . " year " . $month . " mon";
}

/**
 * @Author: Mamun
 */
function getCountry() {

    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {

        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {

        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        
    } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {

        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        
    } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {

        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        
    } elseif (isset($_SERVER['HTTP_FORWARDED'])) {

        $ipaddress = $_SERVER['HTTP_FORWARDED'];
        
    } else {

        $ipaddress = $_SERVER['REMOTE_ADDR'];
        
    }

    //$result = geoip_country_code_by_name($ipaddress);
	
	$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ipaddress));
	if($query && $query['status'] == 'success') {
	  $result = $query['countryCode'];
	} else {
	  $result = '';
	}
	
    return $result;
}

?>