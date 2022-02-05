<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test1 extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_test1');
	}

	public function index() {
		$data['page'] 		= "";
		$data['judul'] 		= "";
		$data['deskripsi'] 	= "";

		
		$this->template->views('test1/home', $data);
	}

	public function alphabet(){
		$data['karakter'] = $this->M_test1->alphabet();
		echo json_encode($data);
	}
	
	public function nama(){
		$data = $this->M_test1->select_name();
		echo json_encode($data);
	}

	public function tampil() {
		$data['dataNama'] = $this->M_test1->select_name();
		$this->load->view('test1/list_data', $data);
	}

}
