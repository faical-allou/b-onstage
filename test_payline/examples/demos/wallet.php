<?php
	include_once('../../lib/paylineSDK.php');
	$array = array(
		'createWallet',
		'updateWallet',
		'getWallet',
		'createWebWallet',
    	'updateWebWallet',
    	'getWebWallet',
		'disableWallet',
		'enableWallet',
		'doImmediateWalletPayment',
		'doScheduledWalletPayment',
		'doRecurrentWalletPayment',
		'getPaymentRecord',
		'disablePaymentRecord',
		'getCards'
	);
	$selected = isset( $_GET['e'] ) ? $_GET['e'] : $array[0];
	if ( !in_array($selected, $array) ) $selected = $array[0];

	$links = '<h3>';
	foreach( $array as $v )
		$links .= ( $v==$selected ) ? "$v - " : "<a href='?e=$v'>$v</a> - ";
	$links = substr( $links, 0, -2 ).'</h3>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Payline demo</title>
		<link rel="stylesheet" type="text/css" media="screen" href="css/reset.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="css/header.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/forms.css" />
        <script type="text/javascript" src="scripts/mootools-1.11.js"></script>
        <script type="text/javascript" src="scripts/demos.js"></script>
	</head>

	<body onLoad="passGenerator()">
		<?php include_once('scripts/geshi.php'); ?>

		<div id="header">
			<div id="header-inside">
				<div id="logo">
					<h1><a href="http://www.payline.com"><span>payline</span></a></h1>
					<p>by Monext</p>
				</div>
				<ul id="menu">
					<li><a href="index.php">Install</a></li>
					<li><a href="web.php">Web</a></li>
					<li><a href="direct.php">Direct</a></li>
					<li><a href="wallet.php" class="on">Wallet</a></li>
					<li><a href="extended.php">Extended</a></li>
				</ul>
		  </div>
		</div>

		<div id="wrapper">
			<div id="container">
				<div id="content">
					<h3 align="right"><?php echo paylineSDK::KIT_VERSION ?></h3>
					<h2>Wallet</h2>
					<?php echo $links; ?>
                    <p id="info">Demo that shows the usage of Payline classes for web payments.</p>
                    <p id="sourcelinks">
						<a href="#" id="exampleonly">display example only</a>
						<a href="#" id="htmlcode">html code</a> | <a href="#" id="phpcode">php code</a> | <a href="#" id="csscode">css code</a>
					</p>

					<div id="source">

						<div class="code" id="php">
							<?php
                            $filename = "../wallet/{$selected}.php";
                            $handle = fopen( $filename , 'r' );
                            $source =  fread ($handle, filesize ($filename));
                            $geshi = new GeSHi($source, 'php');
                            echo $geshi->parse_code();
                            ?>
						</div>

						<div class="code" id="html">
							<?php
                            $filename = "../wallet/{$selected}Form.html";
                            $handle = fopen( $filename , 'r' );
                            $source =  fread ($handle, filesize ($filename));
							$geshi = new GeSHi($source, 'html4strict');
                            $geshi->enable_keyword_links(false);
							echo $geshi->parse_code();
                            ?>
						</div>

						<div class="code" id="css">
							<?php
                            $filename = 'css/forms.css';
                            $handle = fopen( $filename , 'r' );
                            $source =  fread ($handle, filesize ($filename));
                            $geshi = new GeSHi($source, 'css');
                            echo $geshi->parse_code();
                            ?>
						</div>

						<div id="demo">
							<?php
							include("../wallet/{$selected}Form.html");
							?>
						</div>

					</div>
				</div>
				<span class="clr"></span>
			</div>
		</div>

		<div id="footer">
			<div id="footer-inside">
				<a href="http://www.monext.fr/" class="copy"></a>
				<p>copyright &copy;2011 <a href="http://www.monext.fr/">Monext</a></p>
			</div>
		</div>

	</body>
</html>