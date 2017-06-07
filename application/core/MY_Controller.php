<?php
	class MY_Controller extends CI_Controller {
		public $data;

		public function __construct() {
			parent::__construct();

			$this->load->library('PHPRequests');

	    $request = json_decode(Requests::get('http://apilayer.net/api/list?access_key=39072871e57ebc5f04a4359b16193485')->body, true);
	    $this->data['currencies'] = $request['currencies'];

	    $this->data['products'] = $this->product_model->get_products();
	    $this->data['categories'] = $this->category_model->get_categories();
	    $this->data['current_price'] = 1;

	    // make two async requests here
	    // await for the first request of all currencies
		}

		public function get_currency() {
			$currency = $this->input->post('currency') ? $this->input->post('currency') : 'USD';

			$url = "http://apilayer.net/api/live?access_key=39072871e57ebc5f04a4359b16193485&currencies=$currency&format=1";
			$request = json_decode(Requests::get($url)->body, true);
			$this->data['current_price'] = $request['quotes']["USD$currency"];
		}
	}
