<?php
	class Products extends MY_Controller {
		public function __construct() {
			parent::__construct();
		}

		public function index() {
			$data = $this->data;
			$data['title'] = 'Latest products';

			// echo "<pre>";
			// echo $data['currency'];
			// echo $data['current_price'] ? $data['current_price'] : 'hello';

			$this->load->view('templates/header', $data);
			$this->load->view('products/index', $data);
			$this->load->view('templates/footer');
		}

		public function create() {
			$data = $this->data;
			$data['title'] = 'Create a new product';

			// $this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'name', 'required');
			$this->form_validation->set_rules('price', 'price', 'required');
			$this->form_validation->set_rules('description', 'description', 'required');
			$this->form_validation->set_rules('category_id', 'category', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header', $data);
				$this->load->view('products/create', $data);
				$this->load->view('templates/footer');
			} else {
        $config['upload_path']          = './assets/images/products';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile-create')) {
          $error = array('error' => $this->upload->display_errors());
          $product_image = 'noimage.jpg';
        } else {
          $data = array('upload_data' => $this->upload->data());
					$product_image = $_FILES['userfile-create']['name'];
        }

				$this->product_model->create_product($product_image);
				redirect('products');
			}
		}

		public function view($id = NULL) {
			$data = $this->data;
			$data['product'] = $this->product_model->get_products($id);
			$data['comments'] = $this->comment_model->get_comments($id);

			if(empty($data['product'])) {
				show_404();
			}

			$data['title'] = $data['product']['name'];

			$this->load->view('templates/header', $data);
			$this->load->view('products/view', $data);
			$this->load->view('templates/footer');
		}

		public function delete($id) {
			$this->product_model->delete_product($id);
			redirect('products');
		}

		public function edit($id) {
			$data = $this->data;
			$data['product'] = $this->product_model->get_products($id);

			if (empty($data['product'])) {
				show_404();
			}

			$data['title'] = 'Edit product';

			$this->load->view('templates/header', $data);
			$this->load->view('products/edit', $data);
			$this->load->view('templates/footer');
		}

		public function update() {
			$data = $this->data;

			$this->form_validation->set_rules('name', 'name', 'required');
			$this->form_validation->set_rules('price', 'price', 'required');
			$this->form_validation->set_rules('description', 'description', 'required');
			$this->form_validation->set_rules('category_id', 'category', 'required');

			if ($this->form_validation->run() === FALSE) {
				$this->load->view('templates/header', $data);
				$this->load->view('products/edit', $data);
				$this->load->view('templates/footer');
			} else {
        $config['upload_path']          = './assets/images/products';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
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

		// function grab_image_name()
	}
