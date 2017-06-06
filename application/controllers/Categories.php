<?php
	class Categories extends CI_Controller {
		public function index($category = NULL) {
			$data['title'] = 'Categories';
			$data['categories'] = $this->category_model->get_categories();

			if ($this->input->post('category_id') == 1 or !$this->input->post('category_id')) {
				$data['products'] = $this->product_model->get_products();
				$data['type'] = 'All';
			} else {
				$data['products'] = $this->product_model->get_products(NULL, $this->input->post('category_id'));
				$data['type'] = $this->category_model->get_categories($this->input->post('category_id'))['name'];
			}

			$this->load->view('templates/header');
			$this->load->view('categories/index', $data);
			$this->load->view('templates/footer');
		}
	}
