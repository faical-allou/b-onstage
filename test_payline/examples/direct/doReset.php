<?php
// INITIALIZE
include "../../include.php";
$array = array();
$payline = new paylineSDK(MERCHANT_ID, ACCESS_KEY, PROXY_HOST, PROXY_PORT, PROXY_LOGIN, PROXY_PASSWORD, PRODUCTION);

$array['transactionID'] = $_POST['transactionID'];
$array['comment'] = $_POST['comment'];

//SWITCHER
$array['Switch']['Forced'] = isset($_POST['switcher']);
$array['Switch']['Choice'] = $_POST['choice']; 
// RESPONSE FORMAT
$response = $payline->doReset($array);
if(isset($response)){
    require('../demos/result/header.html');
    echo '<H3>RESPONSE</H3>';
    print_a($response, 0, true);
    require('../demos/result/footer.html');
}

?>

