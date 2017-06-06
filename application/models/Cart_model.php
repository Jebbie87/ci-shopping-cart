<?php
	class Cart_model extends CI_Model {
		public function __construct() {
			$this->load->database();
		}

		public function insert_order($item) {
			$data = array(
				'product_id' => $item['id'],
				'user_id' => $this->session->userdata('user_id'),
				'product_subtotal' => $item['subtotal']
			);

			return $this->db->insert('orders', $data);
		}

		public function send_email() {
			$this->load->library('email');

			$this->email->from('jeffreycj.chang@gmail.com', 'Jeffrey Chang');
			$this->email->to('jeffreycj.chang@gmail.com');

			$this->email->subject('Email test');
			$this->email->message('Testing email class 3');
		  if (!$this->email->send()) {
		  	echo "<pre>";
		    print_r(show_error($this->email->print_debugger()));
		  } else {
		    echo 'Your e-mail has been sent!';
		  }
		}
	}
