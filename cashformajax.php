<?php 

//mail("ian@brandedoffers.com","ajax debugger info",print_R($_POST,1));

set_time_limit(0);

require_once "../includes/functions.php";
require_once "../includes/leadmesh.php";

if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')) {
    session_cache_limiter("private_no_expire");
}

if (!session_id()) {
    $ok = @session_start();
    
    if (!$ok) {
        session_regenerate_id(true); // replace the Session ID
        session_start(); // restart the session (since previous start failed)
    }
}



if (isset($_POST["call_fail"]) && $_POST["call_fail"] == "call failed") {
  //  debug_messages("Ajax call timed out");
    die;
}

if (isset($_POST["template_loaded"]) && $_POST["template_loaded"] == "template loaded") {
    //debug_messages("Template loaded: " . @$_POST["template_type"]);
    die;
}

if (isset($_POST["window_close"]) && $_POST["window_close"] == "window close") {
    //debug_messages("Visitor is leaving the page");
    die;
}

if (isset($_POST["visitor_redirect"]) && $_POST["visitor_redirect"] == "visitor redirect") {
    //debug_messages("Redirecting via: " . @$_POST["visitor_type"]);
    die;
}

//debug_messages("Ajax call started");
$redirect_link = "";
/**
 * @todo Quick fix for income issue
 */
$_REQUEST['monthly_income'] = intval($_REQUEST['monthly_income']);
$_REQUEST['dob'] = "$_REQUEST[dob_m]/$_REQUEST[dob_d]/$_REQUEST[dob_y]";

// make long dob (American format mm/dd/yyyy)
if(!isset($_REQUEST['dob'])){
	$_REQUEST['dob'] = $_REQUEST['dob_m']."/".$_REQUEST['dob_d']."/".$_REQUEST['dob_y'];
}

$_REQUEST["primary_phone"] = preg_replace("@\D+@","",$_REQUEST["primary_phone"]);
$_REQUEST["employer_phone"] = preg_replace("@\D+@","",$_REQUEST["employer_phone"]);

$_REQUEST["monthly_income"] = intval($_REQUEST["monthly_income"]);
if ($_REQUEST["monthly_income"] < 100) {
    $_REQUEST["monthly_income"] = 100;
}
else if ($_REQUEST["monthly_income"] > 9999) {
    $_REQUEST["monthly_income"] = 9999;
}


    $columns = array('first_name', 'last_name', 'email', 'zipcode', 'state', 'street_address', 'apt_no', 'city', 'address_length', 'primary_phone', 'drivers_lic', 'id_state',  'dob_d', 'dob_m', 'dob_y', 'social_security', 'employer','type_of_income', 'receive_pay', 'monthly_income', 'pay_date_one', 'pay_date_two', 'often_paid','home_owner', 'aff_id', 'sub_id', 'sub_id2', 'auto_year', 'auto_make', 'auto_model', 'auto_style', 'auto_mileage', 'auto_reg_state', 'auto_vin', 'auto_condition', 'auto_owed', 'auto_insured', 'auto_ins_carrier');
	
    $fields = array();
    $values = array();
    
    foreach ($columns as $field) {
        $key = $field;
        
        if ($key == 'id') {
            continue;
        }
        
        $fields []= $key;
        $values []= "'".@$_REQUEST[$key]."'";
    }
    
    $fields = join(',',$fields);
    $values = join(',',$values);
	
	//mail("ian@brandedoffers.com","insert statement","INSERT INTO atl_leads (".$fields.",timestamp) VALUES (".$values.",NOW())");

    $insert_lead = $DBC->exec("INSERT INTO atl_leads ($fields,timestamp) VALUES ($values,NOW())");
	
	$bridge = new LeadMesh('f069e6715383f9d45c7b610cbf0c59fe5ebe3bd5b97293c2a699d885c891557b ');
	
	if(!isset($_REQUEST['months_at_address'])){ // if address_months isnt set, we set it to 0
		$_REQUEST['months_at_address'] = 0;
	}
	
	if(!isset($_REQUEST['years_address'])){
		$_REQUEST['years_address'] = 0;
	}
	
	$_REQUEST['years_address'] = intval($_REQUEST['months_at_address']/12);
	$_REQUEST['months_address'] = $_REQUEST['months_at_address']%12;
	
	
	if(!isset($_REQUEST['address_start_date'])){
		$amonths = (($_REQUEST['years_address']*12)+$_REQUEST['months_address']);
		$_REQUEST['address_start_date'] = date ( 'm/d/Y' , strtotime ('-'.$amonths.' months' , strtotime ( date('Y-m-01') )) );
	}elseif(isset($_REQUEST['address_start_date'])){
		$datetime1 = date_create($_REQUEST['address_start_date']);
		$datetime2 = date_create();
		$interval = date_diff($datetime1, $datetime2);
		$_REQUEST['years_address'] = $interval->format('%y');
		$_REQUEST['months_address'] = $interval->format('%m');
	}
	
	
	// employment_start_date
	if(!isset($_REQUEST['employment_months'])){
		$_REQUEST['employment_months'] = 0;
	}
	if(!isset($_REQUEST['years_employed'])){
		$_REQUEST['years_employed'] = 0;
	}
	
	//if($_REQUEST['years_employed'] == 0 && $_REQUEST['employment_months'] > 11){
		$_REQUEST['years_employed'] = intval($_REQUEST['employment_months']/12);
		$_REQUEST['months_employed'] = $_REQUEST['employment_months']%12;
	//}
	
	if(!isset($_REQUEST['employment_start_date'])){
		$emonths = (($_REQUEST['years_employed']*12)+$_REQUEST['months_employed']);
		$_REQUEST['employment_start_date'] = date ( 'm/d/Y' , strtotime ('-'.$emonths.' months' , strtotime ( date('Y-m-01') )) );
	}else{
		$datetime1 = date_create($_REQUEST['employment_start_date']);
		$datetime2 = date_create();
		$interval = date_diff($datetime1, $datetime2);
		$_REQUEST['years_employed'] = $interval->format('%y');
		$_REQUEST['months_employed'] = $interval->format('%m');
	}
	
	
	
	// bank_start_date
	if(!isset($_REQUEST['months_with_bank'])){
		$_REQUEST['months_with_bank'] = "0";
	}
	if(!isset($_REQUEST['years_with_bank'])){
		$_REQUEST['years_with_bank'] = "0";
	}
	
	$_REQUEST['years_with_bank'] = intval($_REQUEST['months_with_bank']/12);
	$_REQUEST['months_with_bank'] = $_REQUEST['months_with_bank']%12;
	
	$bmonths = (($_REQUEST['bank_years']*12)+$_REQUEST['months_with_bank']);
	$_REQUEST['bank_start_date'] = date ( 'm/d/Y' , strtotime ('-'.$bmonths.' months' , strtotime ( date('Y-m-01') )) );
	$_REQUEST['employment_start_date_m'] = substr($_REQUEST['employment_start_date'],0,2);
	$_REQUEST['employment_start_date_d'] = substr($_REQUEST['employment_start_date'],3,2);
	$_REQUEST['employment_start_date_y'] = substr($_REQUEST['employment_start_date'],-4);
	$_REQUEST['address_start_date_m'] = substr($_REQUEST['address_start_date'],0,2);
	$_REQUEST['address_start_date_d'] = substr($_REQUEST['address_start_date'],3,2);
	$_REQUEST['address_start_date_y'] = substr($_REQUEST['address_start_date'],-4);
	$_REQUEST['bank_start_date_m'] = substr($_REQUEST['bank_start_date'],0,2);
	$_REQUEST['bank_start_date_d'] = substr($_REQUEST['bank_start_date'],3,2);
	$_REQUEST['bank_start_date_y'] = substr($_REQUEST['bank_start_date'],-4);
	$_REQUEST['employment_total_months'] = $_REQUEST['months_employed'] + ($_REQUEST['years_employed']*12);
	$_REQUEST['address_total_months'] = $_REQUEST['months_address'] + ($_REQUEST['years_address']*12);
	$_REQUEST['bank_total_months'] = $_REQUEST['months_with_bank'] + ($_REQUEST['years_with_bank']*12);
	$_REQUEST['social_security1'] = substr($_REQUEST['social_security'],0,3);
	$_REQUEST['social_security2'] = substr($_REQUEST['social_security'],3,2);
	$_REQUEST['social_security3'] = substr($_REQUEST['social_security'],-4);
	$_REQUEST['primary_phone1'] = substr($_REQUEST['primary_phone'],0,3);
	$_REQUEST['primary_phone2'] = substr($_REQUEST['primary_phone'],3,3);
	$_REQUEST['primary_phone3'] = substr($_REQUEST['primary_phone'],-4);
	$_REQUEST['employer_phone1'] = substr($_REQUEST['employer_phone'],0,3);
	$_REQUEST['employer_phone2'] = substr($_REQUEST['employer_phone'],3,3);
	$_REQUEST['employer_phone3'] = substr($_REQUEST['employer_phone'],-4);
	$_REQUEST['pay_date_one_m'] = substr($_REQUEST['pay_date_one'],0,2);
	$_REQUEST['pay_date_one_d'] = substr($_REQUEST['pay_date_one'],3,2);
	$_REQUEST['pay_date_one_y'] = substr($_REQUEST['pay_date_one'],-4);
	$_REQUEST['pay_date_one_year'] = substr($_REQUEST['pay_date_one'],-4);
	$_REQUEST['pay_date_two_m'] = substr($_REQUEST['pay_date_two'],0,2);
	$_REQUEST['pay_date_two_d'] = substr($_REQUEST['pay_date_two'],3,2);
	$_REQUEST['pay_date_two_y'] = substr($_REQUEST['pay_date_two'],-4);
	$_REQUEST['pay_date_two_year'] = substr($_REQUEST['pay_date_two'],-4);
	
	$_REQUEST['ip'] = $_SERVER['REMOTE_ADDR'];
	$_REQUEST['aff_id'] = $_REQUEST['aff_id'];
	$_REQUEST['sub_id'] = $_REQUEST['sub_id'];
	$_REQUEST['sub_id2'] = $_REQUEST['sub_id2'];
	$_REQUEST['offer_id'] = $_REQUEST['offer_id'];
	
	
	
	$time_start = microtime(true); //start a timer
	$raw_response = $bridge->send_lead($_REQUEST); //make the request to lead mesh
	$time_end = microtime(true); //end our timer
	$execution_time = ($time_end - $time_start);  //get our request time length
	
	//$insert_lm_response = mysql_query("INSERT INTO `fastcash_db`.`wp_lmresponselog` (`id`,`response`) VALUES (NULL , '".$raw_response."');"); //record the response from leadmesh, so we can watch them for token errors
	//$insert_lead_log = mysql_query("INSERT INTO `mcbo_db`.`time_log` (`id`,`length`,`tier`,`aff_id`,`sub_id`) VALUES (NULL, '".$execution_time."', '".$tier_id."', '".$hasoffers_ids["afid"]."', '".$hasoffers_ids['subid']."');"); //log how long the request took
    
    $_SESSION["raw_response"] = $raw_response;
    //$_SESSION["request_hash"] = $request_hash;


try {
    $response = $bridge->process_response($raw_response);
}
catch(Exception $e){
    $response = new stdClass();
}


if (isset($response->redir)) {
	$redirect_link = $response->redir;
} else {
	preg_match("@[<]redir[>](.*?)[<]/redir[>]@",$raw_response,$matches);
	$redirect_link = isset($matches[1]) ? $matches[1] : "";	
}

if (isset($response->price)) {
	$lead_price = $response->price;
} else {
	preg_match("@[<]price[>](.*?)[<]/price[>]@",$raw_response,$matches);
	$lead_price = isset($matches[1]) ? $matches[1] : "";
}

if(!isset($_REQUEST["sub_id"]) OR $_REQUEST["sub_id"] == ""){ //OR $hasoffers_ids["subid"]){
	$_REQUEST["sub_id"] = "0";
}
if(!isset($_REQUEST["sub_id2"]) OR $_REQUEST["sub_id2"] == ""){ //OR $hasoffers_ids["subid2"]){
	$_REQUEST["sub_id2"] = "0";
}
if(!isset($_REQUEST["offer_id"]) OR $_REQUEST["offer_id"] == ""){ //OR $hasoffers_ids["subid"]){
	$_REQUEST["offer_id"] = "234";
}

//if($hasoffers_ids["offerid"] == "138"){	//we are only doing the bucket system on offer_id 138, which is FasterCashToday.com CPA
//	$known = mysql_query("SELECT * from `mcbo_db`.`ho_buckets` WHERE `aff_id` = '".$_SESSION['afid']."' AND `sub_id` = '".$_SESSION['subid']."' AND `sub_id2` = '".$_SESSION['subid2']."' AND `site_id` = 'FCTCPA';");
	
//	if(!$known){
		//echo "unknown";
//		$unknown = mysql_query("INSERT INTO `mcbo_db`.`ho_buckets` (`id`,`aff_id`,`sub_id`,`sub_id2`,`site_id`,`owed`) VALUES (NULL, '".$_SESSION['afid']."', '".$_SESSION['subid']."', '".$_SESSION['subid2']."', 'FCTCPA', '".$lead_price."');");	
//	} else {
//		$lead_price = $known['0']['owed']+$lead_price;
//	}
		
		if($lead_price > "0.00"){
//			$lead_price = $lead_price-70;
			$payout = $lead_price*0.70;
			if($_REQUEST['offer_id']=="252"){
				$payout = "0.00";
			}
			$notifyHO = hasoffers_notify_of_conversion(0,$_REQUEST['offer_id'], $_REQUEST['aff_id'], intval($payout), intval($lead_price), $_REQUEST['sub_id'], $_REQUEST['sub_id2']);
			//print_r($notifyHO);
	}
		
//		$update_debt = mysql_query("UPDATE `mcbo_db`.`ho_buckets` SET `owed` = '".$lead_price."' WHERE `aff_id` = '".$_SESSION['afid']."' AND `sub_id` = '".$_SESSION['subid']."' AND `site_id` = 'FCTCPA';");
//	//}
//}elseif(isset($_SESSION['tid']) AND $_SESSION['tid'] != ""){
//		$x = notify_ho_of_conversion_by_tid($lead_price,$_SESSION['offer_id'],$_SESSION['tid']);
//}else{
//	//mail("ian@brandedoffers.com","i had no one to notify",print_r($_SESSION,1));
//}



if ($bridge->valid_response($response)) {
	require_once "../includes/responses/redirect.tpl.php";
}else {
    require_once "../includes/responses/iframe.tpl.php";
}

//$x = brandedmailer_subscribe($_REQUEST['email'], $_REQUEST['first_name'], $_REQUEST['last_name'],$_REQUEST['state'],1);


function hasoffers_notify_of_conversion($trans_id, $offer_id, $affiliate_id, $payout, $revenue, $aff_sub="", $aff_sub2=""){
	//set transid to 0 to not report via transaction ID. this might break things if you are posting to an offer that requires it though.
	$APIbase = 'https://api.hasoffers.com/Api?';
	$NetworkId = 'brandedoffersaff';
	$NetworkToken = 'NETwQs2KqmlUNxUvdbwjEH1d1pe4Cl';
 
	$params = array(
		'Format' => 'json'
		,'Target' => 'Conversion'
		,'Method' => 'create'
		,'Service' => 'HasOffers'
		,'Version' => 2
		,'NetworkId' => $NetworkId
		,'NetworkToken' => $NetworkToken
		,'data' => array(
			   'offer_id' => $offer_id,
			   'affiliate_id' => $affiliate_id,
			   'payout' => $payout,
			   'revenue' => $revenue,
			   'affiliate_info1' => $aff_sub,
			   'affiliate_info2' => $aff_sub2
		)
	);
	
	if($trans_id != "0" ){
		$params['data']['ad_id'] = $trans_id;	
	}
	 
	$url = $APIbase . http_build_query( $params );
	$HOresult = file_get_contents( $url );
	
	return $HOresult;
	
}

function notify_ho_of_conversion_by_tid($price,$offer_id,$trans_id) {
	$price = floatval($price);
	$my_url = 'http://brandedoffersaff.go2cloud.org/aff_lsr?offer_id='.$offer_id.'&amount='.$price.'&transaction_id='.$trans_id;
	$notify = file_get_contents($my_url);
	
	return $notify;
}

