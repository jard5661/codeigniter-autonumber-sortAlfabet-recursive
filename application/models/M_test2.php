<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_test2 extends CI_Model
{

	public function select_all()
	{
		$sql = "SELECT kode,tanggal from test2";
		$data = $this->db->query($sql);
		return $data->result();
	}

	public function autonumber($data2,$data3)
	{	 
		//cek apakah ada data dalam database
		$sql = "SELECT right(kode,4) AS kode
				FROM test2
				WHERE YEAR(tanggal) = '$data2' AND MONTH(tanggal) = '$data3'
	 			ORDER BY kode desc
	 			LIMIT 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() <> 0) { 
			// jika ada ditambah 1 dari angka terakhir
			$data = $query->row();
			$kode = intval($data->kode) + 1; 
		} else {
			// jika tidak dimulai dari 1
			$kode = 1;
		}
		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); 
		$kodejadi = "MSK/". date('y', strtotime($data2)). $data3 ."/".$kodemax;
		return $kodejadi;
	}

	public function simpan($data,$data2,$data3)
	{
		$autonumber = $this->M_test2->autonumber($data2,$data3);

		$sql = "INSERT INTO test2 
				(kode,tanggal)
				VALUES
				('$autonumber',
					'{$data['tanggal']}')";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
}
