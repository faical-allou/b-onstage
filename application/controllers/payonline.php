<?php
class Payonline extends CI_Controller {

	private $payline_config;

	function __construct(){
		parent::__construct();

		$this->config->load('payline', TRUE);
		$this->payline_config = $this->config->item('payline');
		foreach ($this->payline_config as $key => $value) {
			define($key, $value);
		}
		$this->load->model('transaction_model');
		$this->load->model('reservation_model');
		$this->load->library('payline');
		$this->payline->init(MERCHANT_ID, ACCESS_KEY, PROXY_HOST, PROXY_PORT, PROXY_LOGIN, PROXY_PASSWORD, PRODUCTION);
		$this->lang_counts = $this->config->item('lang_counts');
	}

	public function index($reservation_id,$event_id,$amount){
		
		//INIT ORDER REF
		$order_ref = date('Ymd').$reservation_id;
		
		/* INIT PAYMENT */
		$this->payline->returnURL = RETURN_URL;
		$this->payline->cancelURL = CANCEL_URL;
		$this->payline->notificationURL = NOTIFICATION_URL;
		//Determine lang iso code depending on lang loaded
		foreach($this->lang_counts as $key => $value){
			if($this->session->userdata('lang_loaded') == $value["name"]){
				$langiso = $value["isocode"];
			}
		}
		$this->payline->languageCode = $langiso;

		// PAYMENT
		$payline_data = array();
		$payline_data['payment']['amount'] = $amount * 100;//centimes
		$payline_data['payment']['action'] = PAYMENT_ACTION;
		$payline_data['payment']['mode'] = PAYMENT_MODE;
		$payline_data['payment']['currency'] = PAYMENT_CURRENCY;

		// ORDER
		$payline_data['order']['ref'] = $order_ref;
		$payline_data['order']['amount'] = $amount * 100;
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
			
			$data = array(
				'event_id'		=> $event_id,
				'token'			=> $result['token'],
				'code'			=> $result['result']['code'],
				'order_ref'		=> $order_ref,
				'date_created'	=> date('c')
			);
			//init transaction table
			$this->transaction_model->init($data);
			
			header("location:".$result['redirectURL']);
			exit();
		}
		elseif(isset($result)) {
			echo 'ERROR : '.$result['result']['code']. ' '.$result['result']['longMessage'].' <BR/>';
		}

	}

	public function thank_you(){
		
		//get token
		$token = $this->input->get('token');		
		
		$payline_data = array(
			'token' => $token,
			'version' => ''
		);
		
		//get transaction result
		$result = $this->payline->getWebPaymentDetails($payline_data);
		
		if($this->_valid($token, $result)){		
			$log = '********** '.date('Y-m-d H:i')." | token: $token **********\n".print_r($result, 1)."\n\n";
			file_put_contents('application/logs/payline.log', $log, FILE_APPEND);
			redirect('user/reservations', 'refresh');				
		}		
	}
	
	public function cancel(){

		$token = $this->input->get('token');
		$payline_data = array(
			'token' => $token,
			'version' => ''
		);
		$result = $this->payline->getWebPaymentDetails($payline_data);	
		
		//get event_id
		$transaction = $this->db->select('event_id')->from('transactions')->where('token', $token)->get()->row_array();
		
		if($this->transaction_model->cancel($transaction['event_id']))
			redirect('user/reservations', 'refresh');
	}

	public function notification(){

		//get token
		$token = $this->input->get('token');		
		
		$payline_data = array(
			'token' => $token,
			'version' => ''
		);
		
		//get transaction result
		$result = $this->payline->getWebPaymentDetails($payline_data);
		
		if($this->_valid($token, $result)){						
			$log = '********** '.date('Y-m-d H:i')." | token: $token **********\n".print_r($result, 1)."\n\n";
			file_put_contents('application/logs/payline.log', $log, FILE_APPEND);				
		}
	}
	
	private function _valid($token, $result){
		try{			
			$data = array(
				'token'			=> $token,	
				'data'			=> json_encode($result),
				'date_created'	=> date('c'),
				'code'			=> $result['result']['code'],
				'transaction_id'=> $result['transaction']['id']				
			);		
		
			//if transaaction error	
			if($data['code']!='00000')
				throw new Exception('TRANSACTION_ERROR');
			
			//transaction exist ?
			if($this->db->from('transactions')->where('transaction_id', $data['transaction_id'])->count_all_results() > 0)
				throw new Exception('TRANSACTION_EXIST');
			
			//update transaction
			if(!$this->transaction_model->update($data))
				throw new Exception('TRANSACTION_ERROR');
			
			//get event_id	
			$transaction = $this->db->select('event_id')->from('transactions')->where('transaction_id', $data['transaction_id'])->get()->row_array();
			$event_id = $transaction['event_id'];
			
			//close reservation
			if(!$this->reservation_model->close($event_id))
				throw new Exception('RESERVATION_ERROR');
			
			return true;
			
		} catch (Exception $e) {
			//traitemens des exceptions
			return false;
		}
	}
}
