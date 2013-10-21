<?php
class Testpayline extends CI_Controller {

	private $payline_config;

	function __construct(){
		parent::__construct();

		$this->config->load('payline', TRUE);
		$this->payline_config = $this->config->item('payline');
		foreach ($this->payline_config as $key => $value) {
			define($key, $value);
		}

		$this->load->library('payline');
		$this->payline->init(MERCHANT_ID, ACCESS_KEY, PROXY_HOST, PROXY_PORT, PROXY_LOGIN, PROXY_PASSWORD, PRODUCTION);


		$this->header['title'] = 'Test Payline';
		$this->header['description'] = 'Description';
		$this->header['search'] = FALSE;
		$this->footer['scripts'] = array();
	}

	public function index(){
		/* INIT PAYMENT */
		$this->payline->returnURL = RETURN_URL;
		$this->payline->cancelURL = CANCEL_URL;
		$this->payline->notificationURL = NOTIFICATION_URL;

		// PAYMENT
		$payline_data = array();
		$payline_data['payment']['amount'] = 10000; // En centimes, 100 = 1 euro
		$payline_data['payment']['action'] = PAYMENT_ACTION;
		$payline_data['payment']['mode'] = PAYMENT_MODE;
		$payline_data['payment']['currency'] = PAYMENT_CURRENCY;

		// ORDER
		$payline_data['order']['ref'] = '20130403010';
		$payline_data['order']['amount'] = 100;
		$payline_data['order']['currency'] = PAYMENT_CURRENCY;

		// CONTRACT NUMBERS
		$payline_data['payment']['contractNumber'] = CONTRACT_NUMBER;
		$contracts = explode(";",CONTRACT_NUMBER_LIST);
		$payline_data['contracts'] = $contracts;
		$secondContracts = explode(";",SECOND_CONTRACT_NUMBER_LIST);
		$payline_data['secondContracts'] = $secondContracts;

		// EXECUTE
		//$result = $payline->do_webpayment($array);
		$result = $this->payline->doWebPayment($payline_data);


		if(isset($result) && $result['result']['code'] == '00000'){
			header("location:".$result['redirectURL']);
			exit();
		}
		elseif(isset($result)) {
			echo 'ERROR : '.$result['result']['code']. ' '.$result['result']['longMessage'].' <BR/>';
		}

	}

	public function thank_you(){

		$token = $this->input->get('token');
		$payline_data = array(
			'token' => $token,
			'version' => ''
		);
		$result = $this->payline->getWebPaymentDetails($payline_data);

		$data = array(
			'result' => $result,
		);

		//TODO: page de remerciement

		$this->load->view('_header', $this->header);
		$this->load->view('test_payline', $data);
		$this->load->view('_footer', $this->footer);
	}
	public function cancel(){

		$token = $this->input->get('token');
		$payline_data = array(
			'token' => $token,
			'version' => ''
		);
		$result = $this->payline->getWebPaymentDetails($payline_data);

		$data = array(
			'result' => $result,
		);

		//TODO: page d'annlation
		$this->load->view('_header', $this->header);
		$this->load->view('test_payline', $data);
		$this->load->view('_footer', $this->footer);
	}

	public function notification(){

		$token = $this->input->get('token');
		$payline_data = array(
			'token' => $token,
			'version' => ''
		);
		$result = $this->payline->getWebPaymentDetails($payline_data);

		// Mettre a jour les tables transaction et concert
		// Enregistrer
		$log = '********** '.date('Y-m-d')." **********\n".print_r($result, 1)."\n\n";
		file_put_contents('application/logs/payline.log', $log);
	}

}
