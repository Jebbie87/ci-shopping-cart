<?php
	class Carts extends CI_Controller {
		public function index() {
			$data['title'] = 'Your current order';


			$this->load->view('templates/header');
			$this->load->view('carts/index', $data);
			$this->load->view('templates/footer');
		}

		public function update() {
			$cart_info = $_POST;
			$i = 1;

			foreach ($cart_info as $cart) {
				$rowid = $cart['rowid'];
				$qty = $cart['qty'];

				$data = array(
					'rowid' => $rowid,
					'qty' => $qty
				);

				$i++;
				$this->cart->update($data);
			}
			redirect('carts/index');
		}

		public function delete() {
			$this->cart->destroy();
			redirect('products');
		}

		public function remove($rowid) {
			$this->cart->remove($rowid);
			redirect('carts');
		}

		public function save_order() {
			$items = $this->cart->contents();

			foreach ($items as $item) {
				$product = $this->product_model->get_products($item['id']);
				$qty = $product['quantity'] - $item['qty'];

				$this->product_model->update_product($qty, $product['id']);

				$this->cart_model->insert_order($item);
			}
			$this->session->set_flashdata('order_submitted', 'Thank you for your order!');
			$this->cart->destroy();
			redirect('products');
		}
	}
