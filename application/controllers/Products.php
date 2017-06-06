<?php
	class Products extends CI_Controller {
		public function index() {
			$data['title'] = 'Latest products';

			$data['products'] = $this->product_model->get_products();

			$this->load->view('templates/header');
			$this->load->view('products/index', $data);
			$this->load->view('templates/footer');
		}

		public function create() {
			$data['title'] = 'Create a new product';
			$data['categories'] = $this->category_model->get_categories();

			// $this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'name', 'required');
			$this->form_validation->set_rules('price', 'price', 'required');
			$this->form_validation->set_rules('description', 'description', 'required');
			$this->form_validation->set_rules('category_id', 'category', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('products/create', $data);
				$this->load->view('templates/footer');
			} else {
        $config['upload_path']          = './assets/images/products';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2048;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
          $error = array('error' => $this->upload->display_errors());
          $product_image = 'noimage.jpg';
        } else {
          $data = array('upload_data' => $this->upload->data());
					$product_image = $_FILES['userfile']['name'];
        }

				$this->product_model->create_product($product_image);
				redirect('products');
			}
		}

		public function view($id = NULL) {
			$data['product'] = $this->product_model->get_products($id);
			$data['comments'] = $this->comment_model->get_comments($id);

			if(empty($data['product'])) {
				show_404();
			}

			$data['title'] = $data['product']['name'];

			$this->load->view('templates/header');
			$this->load->view('products/view', $data);
			$this->load->view('templates/footer');
		}

		public function delete($id) {
			$this->product_model->delete_product($id);
			redirect('products');
		}

		public function edit($id) {
			$data['product'] = $this->product_model->get_products($id);
			$data['categories'] = $this->category_model->get_categories();

			if (empty($data['product'])) {
				show_404();
			}

			$data['title'] = 'Edit product';

			$this->load->view('templates/header');
			$this->load->view('products/edit', $data);
			$this->load->view('templates/footer');
		}

		public function update() {

			$this->form_validation->set_rules('name', 'name', 'required');
			$this->form_validation->set_rules('price', 'price', 'required');
			$this->form_validation->set_rules('description', 'description', 'required');
			$this->form_validation->set_rules('category_id', 'category', 'required');

			if ($this->form_validation->run() === FALSE) {
				$this->load->view('templates/header');
				$this->load->view('products/edit', $data);
				$this->load->view('templates/footer');
			} else {
        $config['upload_path']          = './assets/images/products';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2048;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
          $error = array('error' => $this->upload->display_errors());
          $product_image = 'noimage.jpg';
        } else {
          $data = array('upload_data' => $this->upload->data());
					$product_image = $_FILES['userfile']['name'];
        }

				$this->product_model->update_product(NULL, NULL, $product_image);

				redirect('products');
			}
		}

		public function add_product_to_cart() {
			$data = array(
				'id' => $this->input->post('id'),
				'qty' => 1,
				'price' => $this->input->post('price'),
				'name' => $this->input->post('name'),
				'description' => $this->input->post('description'),
			);

			$this->cart->insert($data);

			redirect('products');
		}
	}
