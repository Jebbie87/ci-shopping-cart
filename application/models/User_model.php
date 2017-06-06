<?php
	class User_model extends CI_Model {
		public function __construct(){
			$this->load->database();
		}

		public function create_user() {
			$data = array(
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password'),
				'username' => $this->input->post('username')
			);

			return $this->db->insert('users', $data);
		}

		public function login_user($email, $password) {
			$this->db->where('email', $email);
			$this->db->where('password', $password);

			$result = $this->db->get('users');

			if($result->num_rows() == 1){
				return $result->row_array();
			} else {
				return false;
			}
		}
	}
