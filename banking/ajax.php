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

	$content = (array) json_decode(file_get_contents('http://online.chennaisms.com/api/mt/SendSMS?user=sarath.itrocker&password=india123&senderid=CHNBNK&channel=Trans&DCS=0&flashsms=0&number=91'.$mobile.'&text='.$msg.'&route=6'));

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
		$id = $wpdb->insert_id;
		$lid = 1000000000+$id;

		$wpdb->update('wp_enquiry', array('lead_id' => $lid), array('id' => $id));

		$to = 'harinathr.ism@gmail.com';
		$subject = $lid.' '.$data['etype'].' Lead';


		$body = '<h3>Hi Admin,</h3>';
		$body .= "<p><b>Lead ID</b>: $lid</p>";

		$body .= "<p><b>Name: </b>: ".$data['name']."</p>
			<p><b>Email:</b>: ".$data['email']."</p>
			<p><b>Mobile:</b>: ".$data['mobile']."</p>
			<p><b>Gender:</b>: ".$data['gender']."</p>
			<p><b>Dob:</b>: ".$data['dob']."</p>
			<p><b>ZIP:</b>: ".$data['zip']."</p>
			<p><b>Occupation:</b>: ".$data['occupation']."</p>";
		

		if($data['occupation'] == 'Salaried'){
			$body .= "<p><b>Company Name: </b>: ".$data['company']."</p>";
			$body .= "<p><b>Monthly Income: </b>: ".$data['monthly']."</p>";
			$body .= "<p><b>I receive Salary By: </b>: ".$data['salary_by']."</p>";
		} elseif($data['occupation'] == 'Self Employed'){
			$body .= "<p><b>Latest Year Income after Tax: </b>: ".$data['income']."</p>";	
		}

		if($data['etype'] == 'Credit Card'){
			$body .= "<p><b>Existing Creditcard: </b>: ".$data['cc']."</p>";
			if($data['cc'] == 'Yes'){
				$body .= "<p><b>Banks: </b>: ".implode(",", $data['banks'])."</p>";
				$body .= "<p><b>Credit Limit: </b>: ".$data['creditlimit']."</p>";
			}
		} else{
			$body .= "<p><b>Are you paying any monthly EMI?: </b>: ".$data['cc']."</p>";
			if($data['cc'] == 'Yes'){
				$body .= "<p><b>Total amount of EMIs you currently pay per month: </b>: ".$data['creditlimit']."</p>";
			}
		}

		$body .= "<p><b>Preferred Language: </b>: ".($data['language'] == 'Others' ? $data['otherlanguage'] : $data['language'])."</p>";

		wp_mail( $to, $subject, $body );
		$data = array('status' => 'Success', 'id' => $id);
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