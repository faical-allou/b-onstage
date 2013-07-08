<?php
// INITIALIZE
include "../../include.php";
$array = array();
$payline = new paylineSDK(MERCHANT_ID, ACCESS_KEY, PROXY_HOST, PROXY_PORT, PROXY_LOGIN, PROXY_PASSWORD, PRODUCTION);

//TRANSACTION INFORMATIONS
$array['transactionId'] = $_POST['transactionId'];	
$array['orderRef'] = $_POST['orderRef'];
$array['startDate'] = $_POST['startDate'];
$array['endDate'] = $_POST['endDate'];
$array['authorizationNumber'] = $_POST['authorizationNumber'];
$array['paymentMean'] = $_POST['paymentMean'];
$array['transactionType'] = $_POST['transactionType'];
$array['name'] = $_POST['name'];
$array['firstName'] = $_POST['firstName'];
$array['email'] = $_POST['email'];	
$array['cardNumber'] = $_POST['cardNumber'];
$array['currency'] = $_POST['currency'];
$array['minAmount'] = $_POST['minAmount'];
$array['maxAmount'] = $_POST['maxAmount'];
$array['walletId'] = $_POST['walletId'];
$array['contractNumber'] = $_POST['contractNumber'];
$array['returnCode'] = $_POST['returnCode'];

//SWITCHER
$array['Switch']['Forced'] = isset($_POST['switcher']);
$array['Switch']['Choice'] = $_POST['choice']; 
// EXECUTE
$response = $payline->transactionsSearch($array);
require('../demos/result/header.html');
echo '<H3>REQUEST</H3>';
print_a($array);
echo '<H3>RESPONSE</H3>';
print_a($response, 0, true);
require('../demos/result/footer.html');
?>
