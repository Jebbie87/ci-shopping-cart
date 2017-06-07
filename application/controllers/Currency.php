<?php
	class Currency extends MY_Controller {
		public function __construct() {
			parent::__construct();
		}

		public function get_currency() {
			parent::get_currency();
			// echo "<pre>";
			// echo parent::$this->data;
			// redirect('products');
		}
	}
