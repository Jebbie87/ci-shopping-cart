<?php
	class Comment_model extends CI_Model {
		public function __construct() {
			$this->load->database();
		}

		public function create_comment($product_id) {
			$data = array(
				'user_id' => $this->session->userdata('user_id'),
				'product_id' => $product_id,
				'name' => $this->input->post('name'),
				'comment' => $this->input->post('comment')
			);

			return $this->db->insert('comments', $data);
		}

		public function get_comments($product_id) {
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get_where('comments', array('product_id' => $product_id));
			return $query->result_array();
		}

		public function get_comment($comment_id) {
			$query = $this->db->get_where('comments', array('id' => $comment_id));
			return $query->row_array();
		}

		public function  delete_comment($comment_id) {
			$this->db->where('id', $comment_id);
			$this->db->delete('comments');

			return true;
		}

		public function update_comment() {
			$data = array(
				'comment' => $this->input->post('comment'),
			);

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('comments', $data);
		}
	}
