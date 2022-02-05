<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test2 extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_test2');
	}

	public function index() {
		$data['page'] 		= "";
		$data['judul'] 		= "";
		$data['deskripsi'] 	= "";

		
		$this->template->views('test2/home', $data);
	}

	public function simpan(){
		$data['tanggal'] = $this->input->post('tanggal');
		$data2 = date('Y', strtotime($data['tanggal']));
		$data3 = date('m', strtotime($data['tanggal']));
		$this->M_test2->simpan($data,$data2,$data3);
	}

	public function tampil() {
		$data['dataTest2'] = $this->M_test2->select_all();
		$this->load->view('test2/list_data', $data);
	}

}
