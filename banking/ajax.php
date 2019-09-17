<?php
$ajax_actions = array('cb_verify_otp', 'cb_new_enquiry', 'cb_new_referral', 'cb_update_verified');

foreach ($ajax_actions as $key => $value) {
	add_action('wp_ajax_'.$value, $value);
	add_action('wp_ajax_nopriv_'.$value, $value);
}

function cb_verify_otp(){
	$_POST = (array) json_decode(file_get_contents('php://input'));


	$mobile = $_POST['mobile'];

	$otp = rand(111111,999999);

	$msg = urlencode('Your OTP - '. $otp .' for chennaibanking enquiry');

	$content = (array) json_decode(file_get_contents('http://online.chennaisms.com/api/mt/SendSMS?user=sarath.itrocker&password=india123&senderid=SARATH&channel=Trans&DCS=0&flashsms=0&number=91'.$mobile.'&text='.$msg.'&route=6'));

	if($content['ErrorMessage'] == 'Done'){
		$data = array('status' => 'Success', 'res' => base64_encode($otp));
	} else {
	    $data = array('status' => 'Error', 'msg' => 'Invalid Mobile Number');
	}
	
	echo json_encode($data);
	die(0);
}

function cb_new_enquiry(){
	global $wpdb;

	$_POST = (array) json_decode(file_get_contents('php://input'));

	$data = array();
	foreach ($_POST as $key => $value) {
		if($value){
			$data[$key] = $value;
		}
	}

	if($data['banks']){
		$data['banks'] = serialize($data['banks']);
	}
	$data['dob'] = implode('-', $data['dob']);
	$data['enquiry_ts'] = date('Y-m-d H:i:s');
	
	//print_r($data);

	$res = $wpdb->insert('wp_enquiry', $data);

	if($res){
		$data = array('status' => 'Success', 'id' => $wpdb->insert_id);
	} else {
		$data = array('status' => 'Error', 'msg' => 'Error while saving this enquiry. Please try again');
	}

	echo json_encode($data);
	die(0);
}

function cb_update_verified(){
	global $wpdb;

	$_POST = (array) json_decode(file_get_contents('php://input'));

	$wpdb->insert('wp_enquiry', array('mobile_verified' => 1), array('id' => $_POST['id']));

	$data = array('status' => 'Success');
	echo json_encode($data);
	die(0);
}

function cb_new_referral(){
	global $wpdb;

	$_POST = (array) json_decode(file_get_contents('php://input'));

	$data = array();
	foreach ($_POST as $key => $value) {
		if($value){
			$data[$key] = $value;
		}
	}
	$data['refer_date'] = date('Y-m-d H:i:s');
	
	//print_r($data);

	$res = $wpdb->insert('wp_referral', $data);

	if($res){
		$data = array('status' => 'Success', 'id' => $wpdb->insert_id);
	} else {
		$data = array('status' => 'Error', 'msg' => 'Error while saving this enquiry. Please try again');
	}

	echo json_encode($data);
	die(0);
}