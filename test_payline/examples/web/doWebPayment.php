<?php
// INITIALIZE
require_once("../../include.php");
$array = array();
$payline = new paylineSDK(MERCHANT_ID, ACCESS_KEY, PROXY_HOST, PROXY_PORT, PROXY_LOGIN, PROXY_PASSWORD, PRODUCTION);
$payline->returnURL = RETURN_URL;
$payline->cancelURL = CANCEL_URL;
$payline->notificationURL = NOTIFICATION_URL;

// PAYMENT
$array['payment']['amount'] = $_POST['amount'];
$array['payment']['currency'] = $_POST['currency'];
$array['payment']['action'] = PAYMENT_ACTION;
$array['payment']['mode'] = PAYMENT_MODE;

// ORDER
$array['order']['ref'] = $_POST['ref'];
$array['order']['amount'] = $_POST['amount'];
$array['order']['currency'] = $_POST['currency'];

// CONTRACT NUMBERS
$array['payment']['contractNumber'] = CONTRACT_NUMBER;
$contracts = explode(";",CONTRACT_NUMBER_LIST);
$array['contracts'] = $contracts;
$secondContracts = explode(";",SECOND_CONTRACT_NUMBER_LIST);
$array['secondContracts'] = $secondContracts;

// EXECUTE
//$result = $payline->do_webpayment($array);
$result = $payline->doWebPayment($array);
//print_r($result);
// RESPONSE
if(isset($_POST['debug'])){
	require('../demos/result/header.html');
	echo '<H3>REQUEST</H3>';
	print_a($array, 0, true);
	echo '<H3>RESPONSE</H3>';
	print_a($result, 0, true);
	require('../demos/result/footer.html');
}
else{
	if(isset($result) && $result['result']['code'] == '00000'){
		header("location:".$result['redirectURL']);
		exit();
	}
	elseif(isset($result)) {
	echo 'ERROR : '.$result['result']['code']. ' '.$result['result']['longMessage'].' <BR/>';
	}

}
?>
