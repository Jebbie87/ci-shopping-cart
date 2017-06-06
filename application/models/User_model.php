<?php
	class User_model extends CI_Model {
		public function __construct(){
			$this->load->database();
		}

		public function create_user() {
			$data = array(
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'username' => $this->input->post('username')
			);

			return $this->db->insert('users', $data);
		}

		public function login_user($email) {
			$this->db->where('email', $email);

			$result = $this->db->get('users');

			if($result->num_rows() == 1){
				return $result->row_array();
			} else {
				return false;
			}
		}

		public function check_username_exists($username) {
			$query = $this->db->get_where('users', array('username' => $username));

			if (empty($query->row_array())) {
				return true;
			}

			return false;
		}

		public function check_email_exists($email) {
			$query = $this->db->get_where('users', array('email' => $email));

			if (empty($query->row_array())) {
				return true;
			}

			return false;
		}
	}
