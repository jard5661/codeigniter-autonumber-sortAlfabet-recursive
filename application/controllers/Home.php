<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
	
	}

	public function index() {

		$data['page'] 			= "";
		$data['judul'] 			= "";
		$data['deskripsi'] 		= "";
		$this->template->views('home', $data);
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */