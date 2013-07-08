<?php
// INITIALIZE
include "../../include.php";
$array = array();
$payline = new paylineSDK(MERCHANT_ID, ACCESS_KEY, PROXY_HOST, PROXY_PORT, PROXY_LOGIN, PROXY_PASSWORD, PRODUCTION);

//PAYMENT
$array['payment']['amount'] = $_POST['paymentAmount'];
$array['payment']['currency'] = $_POST['paymentCurrency'];
$array['payment']['action'] = $_POST['paymentFonction'];
$array['payment']['mode'] =  $_POST['paymentMode'];
$array['payment']['contractNumber'] = $_POST['paymentContractNumber'];
$array['payment']['differedActionDate'] = "" ;

//ORDER
$array['order']['ref'] = $_POST['orderRef'];
$array['order']['origin'] = $_POST['orderOrigin'];
$array['order']['country'] = $_POST['orderCountry'];
$array['order']['taxes'] = $_POST['orderTaxes'];
$array['order']['amount'] = $_POST['orderAmount'];
$array['order']['date'] = $_POST['orderDate'];
$array['order']['currency'] = $_POST['orderCurrency'];

//BUYER (optional)
$array['buyer']['lastName'] = $_POST['buyerLastName'];
$array['buyer']['firstName'] = $_POST['buyerFirstName'];
$array['buyer']['walletId'] = $_POST['buyerWalletId'];
$array['buyer']['email'] =  $_POST['buyerEmail'];
$array['buyer']['accountCreateDate'] =  $_POST['buyerAccountCreateDate'];
$array['buyer']['accountAverageAmount'] =  $_POST['buyerAverageAmount'];
$array['buyer']['accountOrderCount'] =  $_POST['buyerOrderCount'];

//ADDRESS (optional)
$array['address']['name'] =  $_POST['addressName'];
$array['address']['street1'] =  $_POST['addressStreet1'];
$array['address']['street2'] =  $_POST['addressStreet2'];
$array['address']['cityName'] =  $_POST['addressCity'];
$array['address']['zipCode'] =  $_POST['addressZipCode'];
$array['address']['country'] =  $_POST['addressCountry'];
$array['address']['phone'] =  $_POST['addressPhone'];

//ORDER DETAILS (optional)
$item1 = array();
$item1['ref'] = $_POST['orderDetailRef1'];
$item1['price'] = $_POST['orderDetailPrice1'];
$item1['quantity'] = $_POST['orderDetailQuantity1'];
$item1['comment'] = $_POST['orderDetailComment1'];
$payline->setItem($item1);

$item2 = array();
$item2['ref'] = $_POST['orderDetailRef2'];
$item2['price'] = $_POST['orderDetailPrice2'];
$item2['quantity'] = $_POST['orderDetailQuantity2'];
$item2['comment'] = $_POST['orderDetailComment2'];
$payline->setItem($item2);

//PRIVATE DATA (optional)
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

// CARD INFO
$array['card']['number'] = $_POST['cardNumber'];
$array['card']['type'] = $_POST['cardType'];
$array['card']['expirationDate'] = $_POST['cardExpirationDate'];
$array['card']['cvx'] = $_POST['cardCrypto'];
$array['card']['ownerBirthdayDate'] = $_POST['cardOwnerBirthdayDate'];
$array['card']['password'] = $_POST['cardPassword'];

//AUTHENTICATION 3DSECURE
$array['3DSecure']['md'] = $_POST['3DSecureMd'];
$array['3DSecure']['pares'] = $_POST['3DSecurePares'];

//AUTHORIZATION
$array['authorization']['number'] = $_POST['authNumber'];
$array['authorization']['date'] = $_POST['authDate'];

//VERSION
$array['version'] = $_POST['version'];

// RESPONSE
$response = $payline->doDebit($array);

require('../demos/result/header.html');
echo '<H3>REQUEST</H3>';
//print_a($GLOBALS['response']);
print_a($array);
echo '<H3>RESPONSE</H3>';
print_a($response, 0, true);
require('../demos/result/footer.html');
?>