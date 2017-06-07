<?php
	class Comments extends MY_Controller {
		public function __construct() {
			parent::__construct();
		}

		public function create() {
			$data = $this->data;
			$id = $this->input->post('id');

			$data['product'] = $this->product_model->get_products($id);

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('comment', 'Comment', 'required');

			$data['title'] = $data['product']['name'];

			if ($this->form_validation->run() === FALSE) {
				$this->load->view('templates/header', $data);
				$this->load->view('products/view', $data);
				$this->load->view('templates/footer');
			} else {
				$this->comment_model->create_comment($id);
				$this->session->set_flashdata('created_comment', 'Thank you for your comment');
				redirect('products/'.$id);
			}
		}

		public function delete($comment_id) {
			$id = $this->input->post('product_id');
			$this->comment_model->delete_comment($comment_id);
			$this->session->set_flashdata('deleted_comment', 'Your comment is now deleted');
			redirect('products/'.$id);
		}

		public function edit($comment_id) {
			$data = $this->data;
			$data['comment'] = $this->comment_model->get_comment($comment_id);

			$data['title'] = 'Edit comment';

			$this->load->view('templates/header', $data);
			$this->load->view('comments/edit', $data);
			$this->load->view('templates/footer');
		}

		public function update() {
			$this->comment_model->update_comment();
			$this->session->set_flashdata('edited_comment', 'Your comment has been changed now');
			redirect('products/'.$this->input->post('product_id'));
		}
	}
