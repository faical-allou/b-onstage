<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta name="generator" content="HTML Tidy, see www.w3.org" />
<meta http-equiv="Content-Type" content=
"text/html; charset=utf-8" />
<title>Payline demo</title>
<link rel="stylesheet" type="text/css" media="screen" href=
"css/reset.css" />
<link rel="stylesheet" type="text/css" media="screen" href=
"css/style.css" />
<link rel="stylesheet" type="text/css" media="screen" href=
"css/header.css" />
<link rel="stylesheet" type="text/css" media="screen" href=
"css/forms.css" />
<script type="text/javascript" src="scripts/mootools-1.11.js">
</script>

<script type="text/javascript" src="scripts/demos.js">
</script>
</head>
<body>
<?php
	include_once('scripts/geshi.php');
	include_once('../../lib/paylineSDK.php');
?>
<div id="header">
<div id="header-inside">
<div id="logo">
<h1><a href="http://www.payline.com"><span>payline</span></a></h1>
<p>by Monext</p>
</div>

<ul id="menu">
<li><a href="index.php" class="on">Install</a></li>

<li><a href="web.php">Web</a></li>

<li><a href="direct.php">Direct</a></li>

<li><a href="wallet.php">Wallet</a></li>

<li><a href="extended.php">Extended</a></li>
</ul>
</div>
</div>

<div id="wrapper">
<div id="container">
<div id="content" class="en">
<h3 align="right"><?php echo paylineSDK::KIT_VERSION ?></h3>
<h2>Installation and configuration</h2>

<ol>
<li><strong>Compatibility</strong><br />


<p>Examples have been tested with following configuration : APACHE
2.2.3, PHP Version 5.3.2<br />
 with following php extensions actived : php_curl, php_http,
php_openssl, php_soap.<br />
</p>

<br />
</li>

<li><strong>Installation and usage</strong><br />


<p>Upload the contents of the archive on your server.<br />
 Open and modify 'identification.php' file in 'configuration'
folder and change following vars :<br />
 MERCHANT_ID, ACCESS_KEY</p>

<br />


<p>If you're using a proxy to access the web, change following vars
in the same file :<br />
 PROXY_HOST, PROXY_PORT, PROXY_LOGIN, PROXY_PASSWORD</p>

<br />


<p>Do the same with the options.php file if you want change default
currencies, URL's, payment mode, or your contract number.</p>

<br />


<p>You can see html, php and css code by clicking on link available
on the top,<br />
 you can use this source code for your web payment page. For
documentation on all of the<br />
 parameters availables, refer to the payline's documentation</p>

<br />
</li>

<li><strong>Production</strong><br />


<p>When all test are approved, open and modify 'identification.php'
file in 'configuration' folder<br />
 and change the "PRODUCTION" value to TRUE.</p>
</li>
</ol>
</div>

<br />
<br />


<div id="content" class="fr">
<h2>Installation et configuration</h2>

<ol>
<li><strong>Compatibilit&eacute;</strong><br />


<p>Ces exemples ont &eacute;t&eacute;s test&eacute;s avec cette
configuration : APACHE 2.2.3, PHP Version 5.3.2<br />
 ainsi que ces extensions PHP activ&eacute;es : php_curl, php_http,
php_openssl, php_soap.<br />
</p>

<br />
</li>

<li><strong>Installation et utilisation</strong><br />


<p>Copiez le contenu de l'archive sur votre serveur web.<br />
 Modifiez le fichier 'identification.php' situ&eacute; dans le
dossier 'configuration' pour indiquer vos identifiants :<br />
 MERCHANT_ID, ACCESS_KEY</p>

<br />


<p>Si vous utilisez un proxy pour acc&eacute;der au web, indiquez
&eacute;galement les variables suivantes :<br />
 PROXY_HOST, PROXY_PORT, PROXY_LOGIN, PROXY_PASSWORD</p>

<br />


<p>D'autres param&egrave;tres peuvent &eacute;galement &ecirc;tre
indiqu&eacute;es dans le fichier 'options.php' dans le dossier
'configuration'.<br />
 Vous y trouverez comment changer la devise par d&eacute;faut, le
mode de paiement, ou votre num&eacute;ro de contrat par
exemple.</p>

<br />


<p>Naviguez ensuite dans nos pages d'exemples pour vous en inspirer
et cr&eacute;er vos propres pages de paiement.<br />
 Vous pouvez utiliser les boutons 'html', 'php', ou bien 'css' pour
consulter le code correspondant.<br />
 Pour une vision globale sur les possibilit&eacute;s offertes par
l'offre Payline, nous vous invitons &agrave;&nbsp; consulter notre
documentation.</p>

<br />
</li>

<li><strong>Production</strong><br />


<p>Lorsque vous avez v&eacute;rifi&eacute; le bon fonctionnement de
vos pages, modifiez le fichier 'identification.php' et changez la
variable<br />
 'PRODUCTION' &agrave; 'TRUE' au lieu de 'FALSE'.</p>
</li>
</ol>
</div>
</div>
</div>

<div id="footer">
<div id="footer-inside"><a href="http://www.monext.fr/" class=
"copy"></a>

<p>copyright &copy;2011 <a href=
"http://www.monext.fr/">Monext</a></p>
</div>
</div>
</body>
</html>

