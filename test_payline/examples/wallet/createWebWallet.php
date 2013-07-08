<!DOCTYPE html PUBLIC "-//IETF//DTD HTML 2.0//EN">
<?php
// INITIALIZE
include "../../include.php";
$array = array();
$payline = new paylineSDK(MERCHANT_ID, ACCESS_KEY, PROXY_HOST, PROXY_PORT, PROXY_LOGIN, PROXY_PASSWORD, PRODUCTION);

// CONTRACT NUMBER
$array['contractNumber'] = $_POST['contractNumber'];

// SELECTED CONTARCT LIST
if (isset($_POST['paymentContractNumber'])){
    $contracts = explode(";",$_POST['paymentContractNumber']);
    $array['contracts'] = $contracts;
}

//UPDATE PERSONNAL DETAIL
$array['updatePersonalDetails'] =
isset($_POST['updatePersonalDetails']) ? 1 : 0;

// BUYER (optional)
$array['buyer']['lastName'] = $_POST['buyerLastName'];
$array['buyer']['firstName'] = $_POST['buyerFirstName'];
$array['buyer']['walletId'] = $_POST['buyerWalletId'];
$array['buyer']['email'] = $_POST['buyerEmail'];
$array['buyer']['accountCreateDate'] =
$_POST['buyerAccountCreateDate'];
$array['buyer']['accountAverageAmount'] =
$_POST['buyerAverageAmount'];
$array['buyer']['accountOrderCount'] = $_POST['buyerOrderCount'];

// ADDRESS (optional)
$array['address']['name'] = $_POST['addressName'];
$array['address']['street1'] = $_POST['addressStreet1'];
$array['address']['street2'] = $_POST['addressStreet2'];
$array['address']['cityName'] = $_POST['addressCity'];
$array['address']['zipCode'] = $_POST['addressZipCode'];
$array['address']['country'] = $_POST['addressCountry'];
$array['address']['phone'] =  $_POST['addressPhone'];

// TRANSACTION OPTIONS
$array['notificationURL'] = $_POST['notificationURL'];
$array['returnURL'] = $_POST['returnURL'];
$array['cancelURL'] = $_POST['cancelURL'];
$array['customPaymentPageCode'] = $_POST['customPaymentPageCode'];
$array['securityMode'] = $_POST['securityMode'];
$array['languageCode'] = $_POST['languageCode'];

// EXECUTE
$response = $payline->createWebWallet($array);
require('../demos/result/header.html');
echo '<H3>REQUEST</H3>';
print_a($array);
echo '<H3>RESPONSE</H3>';
print_a($response, 0, true);
require('../demos/result/footer.html');


?>
