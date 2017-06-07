<?php
	class Parent extends CI_Controller {
		var $currency = 'test';

		function construct() {
			parent::construct();
			$this->load->library('PHPRequests');
			$this->data['currency'] = Requests::get('http://apilayer.net/api/list?access_key=39072871e57ebc5f04a4359b16193485');
			// $this->load->vars($data);
		}
	}
