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
$array['payment']['differedActionDate'] = $_POST['paymentDifferedActionDate'] ;
$array['payment']['contractNumber'] =  $_POST['paymentContractNumber'];

// ORDER
$array['order']['ref'] = $_POST['orderRef'];
$array['order']['origin'] = $_POST['orderOrigin'];
$array['order']['country'] = $_POST['orderCountry'];
$array['order']['taxes'] = $_POST['orderTaxes'];
$array['order']['amount'] = $_POST['orderAmount'];
$array['order']['date'] = $_POST['orderDate'];
$array['order']['currency'] = $_POST['orderCurrency'];

// BUYER (optional)
$array['buyer']['lastName'] = $_POST['buyerLastName'];
$array['buyer']['firstName'] = $_POST['buyerFirstName'];
$array['buyer']['customerId'] = $_POST['buyerCustomerId'];
$array['buyer']['walletId'] = $_POST['buyerWalletId'];
$array['buyer']['walletDisplayed'] = $_POST['buyerWalletDisplayed'];
$array['buyer']['walletSecured'] = $_POST['buyerWalletSecured'];
$array['buyer']['walletCardInd'] = $_POST['buyerWalletCardInd'];
$array['buyer']['email'] = $_POST['buyerEmail'];
$array['buyer']['accountCreateDate'] = $_POST['buyerAccountCreateDate'];
$array['buyer']['accountAverageAmount'] = $_POST['buyerAverageAmount'];
$array['buyer']['accountOrderCount'] = $_POST['buyerOrderCount'];
$array['buyer']['ip'] = $_POST['buyerIp'];

// ADDRESS (optional)
$array['address']['name'] = $_POST['addressName'];
$array['address']['street1'] = $_POST['addressStreet1'];
$array['address']['street2'] = $_POST['addressStreet2'];
$array['address']['cityName'] = $_POST['addressCity'];
$array['address']['zipCode'] = $_POST['addressZipCode'];
$array['address']['country'] = $_POST['addressCountry'];
$array['address']['phone'] =  $_POST['addressPhone'];

// ORDER DETAILS (optional)
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

// TRANSACTION OPTIONS
if (isset($_POST['notificationURL'])) $array['notificationURL'] = $_POST['notificationURL'];
if (isset($_POST['returnURL'])) $array['returnURL'] = $_POST['returnURL'];
if (isset($_POST['cancelURL'])) $array['cancelURL'] = $_POST['cancelURL'];
if (isset($_POST['customPaymentTemplateURL'])) $array['customPaymentTemplateURL'] = $_POST['customPaymentTemplateURL'];
if (isset($_POST['languageCode'])) $array['languageCode'] = $_POST['languageCode'];
if (isset($_POST['securityMode'])) $array['securityMode'] = $_POST['securityMode'];
if (isset($_POST['customPaymentPageCode'])) $array['customPaymentPageCode'] = $_POST['customPaymentPageCode'];

// SELECTED CONTRACT LIST
if (isset($_POST['selectedContract'])){
	$contracts = explode(";",$_POST['selectedContract']);
	$array['contracts'] = $contracts;
}

// SELECTED CONTRACT LIST
if (isset($_POST['secondSelectedContract'])){
	$secondContracts = explode(";",$_POST['secondSelectedContract']);
	$array['secondContracts'] = $secondContracts;
}

// RECCURENT
if (isset($_POST['recurringFirstAmount']))$array['recurring']['firstAmount'] = $_POST['recurringFirstAmount'];
if (isset($_POST['recurringAmount'])) $array['recurring']['amount'] = $_POST['recurringAmount'];
if (isset($_POST['recurringBillingCycle'])) $array['recurring']['billingCycle'] = $_POST['recurringBillingCycle'];
if (isset($_POST['recurringBillingLeft'])) $array['recurring']['billingLeft'] = $_POST['recurringBillingLeft'];
if (isset($_POST['recurringBillingDay'])) $array['recurring']['billingDay'] = $_POST['recurringBillingDay'];
if (isset($_POST['recurringStartDate'])) $array['recurring']['startDate'] = $_POST['recurringStartDate'];

// EXECUTE
$result = $payline->doWebPayment($array);

// RESPONSE
if(isset($_POST['debug'])){
	require('../demos/result/header.html');
	echo '<H3>REQUEST</H3>';
	print_a($payline->do_webpayment($array,1), 0, true);
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