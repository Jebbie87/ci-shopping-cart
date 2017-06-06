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
	}
