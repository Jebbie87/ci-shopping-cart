<?php
	class Users extends CI_Controller {
		public function index() {
			$data['title'] = 'Latest products';

			$data['products'] = $this->product_model->get_products();

			$this->load->view('templates/header');
			$this->load->view('products/index', $data);
			$this->load->view('templates/footer');
		}

		public function register() {
			$data['title'] = 'Register page';

			$this->form_validation->set_rules('email', 'email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('password', 'password', 'required');
			$this->form_validation->set_rules('username', 'username', 'required|callback_check_username_exists');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/register', $data);
				$this->load->view('templates/footer');
			} else {
				$this->user_model->create_user();
				$this->session->set_flashdata('user_registered', 'You are now registered and can log in');
				redirect('products');
			}
		}

		public function login() {
			$data['title'] = 'Login page';

			$this->form_validation->set_rules('email', 'email', 'required');
			$this->form_validation->set_rules('password', 'password', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/login', $data);
				$this->load->view('templates/footer');
			} else {
				$email = $this->input->post('email');
				$password = $this->input->post('password');

				$user = $this->user_model->login_user($email);

				if (password_verify($password, $user['password'])) {
					$user_data = array(
						'username' => $user['username'],
						'user_id' => $user['id'],
						'logged_in' => true
					);

					$this->session->set_userdata($user_data);

					$this->session->set_flashdata('user_logged_in', 'You are now logged in');
					redirect('products');

				} else {
					$this->session->set_flashdata('login_failed', 'Login is invalid');
					redirect('users/login');

				}
			}
		}

		public function logout() {
			$this->session->sess_destroy();

			$this->cart->destroy();

			$this->session->set_flashdata('user_logged_out', 'You are now logged out');

			redirect('products');
		}

		public function check_username_exists($username) {
			$this->form_validation->set_message('check_username_exists', 'This username already exists');
			if ($this->user_model->check_username_exists($username)) {
				return true;
			}

			return false;
		}

		public function check_email_exists($email) {
			$this->form_validation->set_message('check_email_exists', 'This email already exists');
			if ($this->user_model->check_email_exists($email)) {
				return true;
			}

			return false;
		}
	}
