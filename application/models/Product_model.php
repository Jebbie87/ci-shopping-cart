<?php
	class Product_model extends CI_Model {
		public function __construct() {
			$this->load->database();
		}

		public function get_products($id = NULL, $category_id = NULL) {
			if ($category_id) {
				$query = $this->db->get_where('products', array('category_id' => $category_id));
				return $query->result_array();
			}

			if ($id === NULL) {
				$query = $this->db->get('products');
				return $query->result_array();
			}

			$query = $this->db->get_where('products', array('id' => $id));
			return $query->row_array();
		}

		public function create_product($product_image) {
			$data = array(
				'name' => $this->input->post('name'),
				'price' => $this->input->post('price'),
				'description' => $this->input->post('description'),
				'image_url' => $this->input->post('image_url'),
				'product_image' => $product_image,
				'quantity' => $this->input->post('quantity')
			);

			return $this->db->insert('products', $data);
		}

		public function delete_product($id) {
			$this->db->where('id', $id);
			$this->db->delete('products');

			return true;
		}

		public function update_product($qty = FALSE, $product_id = FALSE) {
			$data = array(
				'name' => $this->input->post('name'),
				'price' => $this->input->post('price'),
				'description' => $this->input->post('description'),
			);

			if ($qty and $product_id) {
				$data = array(
					'quantity' => $qty
				);
				$this->db->where('id', $product_id);
				return $this->db->update('products', $data);
			}

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('products', $data);
		}
	}
