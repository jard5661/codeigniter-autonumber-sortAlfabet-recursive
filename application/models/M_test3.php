<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_test3 extends CI_Model
{

	public function select_all()
	{
		$sql = "WITH RECURSIVE test3_path (id, name,parent_id, path) AS
		(
		  SELECT id, name,parent_id, name as path
			FROM test3
			WHERE parent_id = 0
		  UNION ALL
		  SELECT c.id, c.name,c.parent_id, CONCAT(cp.path, ' / ', c.name)
			FROM test3_path AS cp JOIN test3 AS c
			  ON cp.id = c.parent_id
		)
		SELECT * FROM test3_path
		ORDER BY path;";
		$data = $this->db->query($sql);
		return $data->result();
	}

	public function simpan($data)
	{
		//jika parent kosong dan child diisi
		if ($data['parent'] == false && $data['children'] == true) {
			$sql = "INSERT INTO test3 (parent_id,name)
		 		 VALUES
				  ('0',
					  '{$data['children']}')";
			$this->db->query($sql);
			return $this->db->affected_rows();
		} else {
			// keduanya diisi
			$sql = "WITH RECURSIVE test3_path (id, name,parent_id, path) AS
					(
					SELECT id, name,parent_id, name as path
					FROM test3
					WHERE parent_id = 0
		  			UNION ALL
		  			SELECT c.id, c.name,c.parent_id, CONCAT(cp.path, ' / ', c.name)
					FROM test3_path AS cp JOIN test3 AS c
			  		ON cp.id = c.parent_id
					)
					SELECT id FROM test3_path
					WHERE path = '{$data['parent']}'
					ORDER BY path;";
			$query = $this->db->query($sql); // cari data 
			if ($query->num_rows() <> 0) {
				$parent = $query->row();
				$parent_id = intval($parent->id); //parsing untuk menemukan id
			}
			$sql2 = "INSERT INTO test3 (parent_id,name)
		 		 VALUES
				  ('$parent_id',
					  '{$data['children']}')";
			$this->db->query($sql2);
			return $this->db->affected_rows();
		}
	}

	public function hapus($data)
	{	// cari dan hapus parent id berdasarkan front
		$sql1 = "SELECT id from test3 where parent_id = '{$data['id']}'";
		$a = $this->db->query($sql1);
		$parent = $a->row();

		$delete_header = "DELETE from test3 where id = '{$data['id']}'";
		$this->db->query($delete_header);

		for ($x = 0; $x < 10; $x++) {
			//cari child dari parent dan hapus child
			$y = "SELECT id from test3 where parent_id = '{$parent->id}'";
			$c = $this->db->query($y)->row();

			$parent = $c;

			if ($c == '') {
				$sql = "DELETE FROM test3 
						WHERE parent_id = '{$data['id']}'";
				$this->db->query($sql);
				exit;
			} else {

				$this->db->query("DELETE from test3 where id = '{$parent->id}'");
			}
		} 
 
	}

	public function select(){
		$sql = "SELECT * FROM test3";
		$data = $this->db->query($sql);
		return $data->result();
	}


}
