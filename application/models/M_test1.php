<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_test1 extends CI_Model
{
	
	public function select_name(){
		$sql = "SELECT nama from m_name order by nama asc";
		$data = $this->db->query($sql);
		return $data->result();
	}
	
	public function alphabet(){
		$sql = "SELECT alpha from alphabet";
		$data = $this->db->query($sql);
		return $data->result();
	}


}
