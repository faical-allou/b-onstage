<!DOCTYPE html PUBLIC "-//IETF//DTD HTML 2.0//EN">
<?php
// INITIALIZE
include "../../include.php";
$array = array();
$payline = new paylineSDK(MERCHANT_ID, ACCESS_KEY, PROXY_HOST, PROXY_PORT, PROXY_LOGIN, PROXY_PASSWORD, PRODUCTION);


// CONTRACT NUMBER
$array['contractNumber'] = $_POST['contractNumber'];

// ADDRESS (optional)
$array['address']['name'] = $_POST['addressName'];
$array['address']['street1'] = $_POST['addressStreet1'];
$array['address']['street2'] = $_POST['addressStreet2'];
$array['address']['cityName'] = $_POST['addressCity'];
$array['address']['zipCode'] = $_POST['addressZipCode'];
$array['address']['country'] = $_POST['addressCountry'];
$array['address']['phone'] =  $_POST['addressPhone'];

// CARD INFO
$array['card']['number'] = $_POST['cardNumber'];
$array['card']['type'] = $_POST['cardType'];
$array['card']['expirationDate'] = $_POST['cardExpirationDate'];
$array['card']['cvx'] = $_POST['cardCrypto'];
$array['card']['ownerBirthdayDate'] =
$_POST['cardOwnerBirthdayDate'];
$array['card']['password'] = $_POST['cardPassword'];

// WALLET INFO
$array['wallet']['walletId'] = $_POST['walletId'];
$array['wallet']['lastName'] = $_POST['lastName'];
$array['wallet']['firstName'] = $_POST['firstName'];
$array['wallet']['email'] = $_POST['email'];
$array['wallet']['comment'] = $_POST['comment'];

// PRIVATE DATA (optional)
$privateData1 = array();
$privateData1['key'] = $_POST['privateDataKey1'];
$privateData1['value'] = $_POST['privateDataValue1'];
$payline->setPrivate($privateData1);

$privateData2 = array();
$privateData2['key'] = $_POST['privateDataKey2'];
$privateData2['value'] = $_POST['privateDataValue2'];
$payline->setPrivate($privateData2);

$privateData3 = array();
$privateData3['key'] = $_POST['privateDataKey3'];
$privateData3['value'] = $_POST['privateDataValue3'];
$payline->setPrivate($privateData3);

//AUTHENTICATION 3DSECURE
$array['3DSecure']['md'] = $_POST['3DSecureMd'];
$array['3DSecure']['pares'] = $_POST['3DSecurePares'];

//VERSION
$array['version'] = $_POST['version'];

// EXECUTE
$response = $payline->createWallet($array);
require('../demos/result/header.html');
echo '<H3>REQUEST</H3>';
print_a($array);
echo '<H3>RESPONSE</H3>';
print_a($response, 0, true);
require('../demos/result/footer.html');

?>
