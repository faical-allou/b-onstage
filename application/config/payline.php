<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Payline Config
* *
*/

/************ IDENTIFICATION *****************/

	//$config['MERCHANT_ID'] = '66472380657968'; // Merchant ID DEV
	$config['MERCHANT_ID'] = '42875061131973'; // Merchant ID PROD
	//$config['ACCESS_KEY'] = 'tjE3nOg5WwKhXikFEbYa'; // Certificate key DEV
	$config['ACCESS_KEY'] = 'r5NPpDbZIVdm2lROpEks'; // Certificate key PROD
	$config['PRODUCTION'] = TRUE; // Demonstration (FALSE) or production (TRUE) mode

	$config['PROXY_HOST'] = null; // Proxy URL (optional)
	$config['PROXY_PORT'] = null; // Proxy port number without 'quotes' (optional)
	$config['PROXY_LOGIN'] =  ''; // Proxy login (optional)
	$config['PROXY_PASSWORD'] = ''; // Proxy password (optional)

/************ OPTIONS *****************/
	$config['site_title']		   = "B-Onstage.com";
	$config['RETURN_URL'] = 'http://www.b-onstage.com/payonline/thank_you'; // Default return URL
	$config['CANCEL_URL'] = 'http://www.b-onstage.com/payonline/cancel'; // Default cancel URL
	$config['NOTIFICATION_URL'] = 'http://www.b-onstage.com/payonline/notification'; // Default notification URL

	$config['PAYMENT_CURRENCY'] = 978; // Default payment currency (ex: 978 = EURO
	$config['ORDER_CURRENCY'] = $config['PAYMENT_CURRENCY'];
	$config['SECURITY_MODE'] = ''; // Protocol (ex: SSL = HTTPS
	$config['LANGUAGE_CODE'] = ''; // Payline pages language
	$config['PAYMENT_ACTION'] = 101; // Default payment method
	$config['PAYMENT_MODE'] = 'CPT'; // Default payment mode
	$config['CUSTOM_PAYMENT_TEMPLATE_URL'] = ''; // Default payment template URL
	$config['CUSTOM_PAYMENT_PAGE_CODE'] = '';
	$config['CONTRACT_NUMBER'] = '8718886'; // Contract type default (ex: 001 = CB] = 003 = American Express...
	$config['CONTRACT_NUMBER_LIST'] = ''; // Contract type multiple values (separator: ;
	$config['SECOND_CONTRACT_NUMBER_LIST'] = ''; // Contract type multiple values (separator: ;

	// Durées du timeout d'appel des webservices
	$config['PRIMARY_CALL_TIMEOUT'] = 15;
	$config['SECONDARY_CALL_TIMEOUT'] = 15;

	// Nombres de tentatives sur les chaines primaire et secondaire par transaction
	$config['PRIMARY_MAX_FAIL_RETRY'] = 1;
	$config['SECONDARY_MAX_FAIL_RETRY'] = 2;

	// Durées d'attente avant le rejoue de la transaction
	$config['PRIMARY_REPLAY_TIMER'] = 15;
	$config['SECONDARY_REPLAY_TIMER'] = 15;

	$config['PAYLINE_ERR_CODE'] = '02101,02102,02103'; // Codes erreurs payline qui signifie l'échec de la transaction
	$config['PAYLINE_WS_SWITCH_ENABLE'] =  ''; // Nom des services web autorisés à basculer
	$config['PAYLINE_SWITCH_BACK_TIMER'] = 600; // Durées d'attente pour rebasculer en mode nominal
	$config['PRIMARY_TOKEN_PREFIX'] = '1'; // Préfixe du token sur le site primaire
	$config['SECONDARY_TOKEN_PREFIX'] = '2'; // Préfixe du token sur le site secondaire
	$config['INI_FILE' ] = 'application/config/HighDefinition.ini'; // Chemin du fichier ini
	$config['PAYLINE_ERR_TOKEN'] = '02317,02318'; // Préfixe du token sur le site primaire
/* End of file ion_auth.php */
/* Location: ./system/application/config/ion_auth.php */
