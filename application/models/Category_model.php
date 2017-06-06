<?php
	class Category_model extends CI_Model {
		public function __construct() {
			$this->load->database();
		}

		public function get_categories($id = FALSE) {
			if ($id === FALSE) {
				$query = $this->db->get('categories');
				return $query->result_array();
			}

			$query = $this->db->get_where('categories', array('id' => $id));
			return $query->row_array();
		}
	}
