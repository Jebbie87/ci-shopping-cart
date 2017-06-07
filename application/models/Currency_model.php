<?php
	class Currency_model extends CI_Model {
		public function get_currencies() {
			$this->load->library('PHPRequests');
	    $request = json_decode(Requests::get('http://apilayer.net/api/list?access_key=39072871e57ebc5f04a4359b16193485')->body, true);
	    $currencies = $request['currencies'];

	    return $currencies;
		}
	}
