<!DOCTYPE html PUBLIC "-//IETF//DTD HTML 2.0//EN">
<?php
// INITIALIZE
include "../../include.php";
$array = array();
$payline = new paylineSDK(MERCHANT_ID, ACCESS_KEY, PROXY_HOST, PROXY_PORT, PROXY_LOGIN, PROXY_PASSWORD, PRODUCTION);

//TRANSACTION INFORMATIONS
$array['transactionId'] = $_POST['transactionID'];
$array['orderRef'] = $_POST['orderRef'];
$array['startDate']= $_POST['Startdate'];
$array['endDate']= $_POST['Enddate'];
if(isset($_POST['transactionHistory'])){
	$array['transactionHistory']= 'Y';
}else{
	$array['transactionHistory']= '';
}

//VERSION
$array['version'] = $_POST['version'];

//SWITCHER
$array['Switch']['Forced'] = isset($_POST['switcher']);
$array['Switch']['Choice'] = $_POST['choice']; 
// EXECUTE
$response = $payline->getTransactionDetails($array);
require('../demos/result/header.html');
echo '<H3>REQUEST</H3>';
print_a($array);
echo '<H3>RESPONSE</H3>';
print_a($response, 0, true);
require('../demos/result/footer.html');
?>
