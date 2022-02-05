<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test3 extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_test3');
	}

	public function index() {
		$data['page'] 		= "";
		$data['judul'] 		= "";
		$data['deskripsi'] 	= "";

		
		$this->template->views('test3/home', $data);
	}

	public function simpan(){
		$data['parent'] = $this->input->post('parent');
		$data['children'] = $this->input->post('children');
		
		$this->M_test3->simpan($data);
	}

	public function hapus(){
		$data['id'] = $this->input->post('id');
		$data2 = $this->M_test3->hapus($data);
		echo json_encode($data2);
	}

	public function tampil() {
		$data['elements'] = $this->M_test3->select_all();
		$this->load->view('test3/list_data', $data);
	}

	public function tampil_tree(){
		$data['elements'] = $this->M_test3->select();
		//$this->load->view('test3/test4', $data);
		echo json_encode($data);
	}
	

}
