<!DOCTYPE html PUBLIC "-//IETF//DTD HTML 2.0//EN">
<?php
// INITIALIZE
include "../../include.php";
$array = array();
$payline = new paylineSDK(MERCHANT_ID, ACCESS_KEY, PROXY_HOST, PROXY_PORT, PROXY_LOGIN, PROXY_PASSWORD, PRODUCTION);

// CHEQUE
$array['cheque']['number'] = $_POST['ChequeNumber'];

//PAYMENT
$array['payment']['amount'] = $_POST['paymentAmount'];
$array['payment']['currency'] = $_POST['paymentCurrency'];
$array['payment']['action'] = $_POST['paymentFonction'];
$array['payment']['mode'] =  $_POST['paymentMode'];
$array['payment']['differedActionDate'] = $_POST['paymentDifferedActionDate'] ;
$array['payment']['contractNumber'] = $_POST['paymentContractNumber'];


//ORDER
$array['order']['ref'] = $_POST['orderRef'];
$array['order']['origin'] = $_POST['orderOrigin'];
$array['order']['country'] = $_POST['orderCountry'];
$array['order']['taxes'] = $_POST['orderTaxes'];
$array['order']['amount'] = $_POST['orderAmount'];
$array['order']['date'] = $_POST['orderDate'];
$array['order']['currency'] = $_POST['orderCurrency'];


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

//SWITCHER
$array['Switch']['Forced'] = isset($_POST['switcher']);
$array['Switch']['Choice'] = $_POST['choice']; 

// RESPONSE
$result = $payline->doScoringCheque($array);

// RESPONSE
require('../demos/result/header.html');
echo '<H3>REQUEST</H3>';
print_a($array);
echo '<H3>RESPONSE</H3>';
print_a($result, 0, true);
require('../demos/result/footer.html');
?>

