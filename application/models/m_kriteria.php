<?php 

class M_kriteria extends CI_Model{

	function input($data,$table){
     	$this->db->insert($table,$data);
	}

	function del($id_kriteria){
		$this->db->where('id_kriteria', $id_kriteria);
		$this->db->delete('tb_kriteria');
	}

	function getData(){
		return $this->db->get('tb_kriteria');
	}

	function edit($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

}
?>