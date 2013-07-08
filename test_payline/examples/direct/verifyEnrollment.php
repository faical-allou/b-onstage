<!DOCTYPE html PUBLIC "-//IETF//DTD HTML 2.0//EN">
<?php
// INITIALIZE
include "../../include.php";
$array = array();
$payline = new paylineSDK(MERCHANT_ID, ACCESS_KEY, PROXY_HOST, PROXY_PORT, PROXY_LOGIN, PROXY_PASSWORD, PRODUCTION);

// PAYMENT
$array['payment']['amount'] = $_POST['paymentAmount'];
$array['payment']['currency'] = $_POST['paymentCurrency'];
$array['payment']['action'] = $_POST['paymentFonction'];
$array['payment']['mode'] =  $_POST['paymentMode'];
$array['payment']['contractNumber'] = $_POST['paymentContractNumber'];
$array['payment']['differedActionDate'] = "";

// CARD INFO
$array['card']['number'] = $_POST['cardNumber'];
$array['card']['type'] = $_POST['cardType'];
$array['card']['expirationDate'] = $_POST['cardExpirationDate'];
$array['card']['cvx'] = $_POST['cardCrypto'];
$array['card']['ownerBirthdayDate'] = $_POST['cardOwnerBirthdayDate'];
$array['card']['password'] = $_POST['cardPassword'];

//USERAGENT
$array['userAgent'] = $_POST['UsrAgent'];

// ORDER
$array['orderRef'] = $_POST['orderRef'];

// RESPONSE
$result = $payline->verifyEnrollment($array);

require('../demos/result/header.html');
echo '<H3>REQUEST</H3>';
print_a($array);
echo '<H3>RESPONSE</H3>';
print_a($result, 0, true);
require('../demos/result/footer.html');
?>

