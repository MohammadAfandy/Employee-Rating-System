<?php 

class M_kriteria extends CI_Model{
	function getData(){
		return $this->db->get('tb_kriteria');
	}

	function edit($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
}
?>