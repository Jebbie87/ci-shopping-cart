<?php
	class Pages extends MY_Controller {

		public function __construct() {
			parent::__construct();
		}

		public function view($page = 'home'){
			if (!file_exists(APPPATH.'views/pages/'.$page.'.php')){
				show_404();
			}
			$data = $this->data;
			$data['title'] = ucfirst($page);

			$this->load->view('templates/header', $data);
			$this->load->view('pages/'.$page, $data);
			$this->load->view('templates/footer');
		}
	}

