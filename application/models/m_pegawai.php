<?php 

class M_pegawai extends CI_Model{
	function getData(){
		return $this->db->get('tb_pegawai');
	}

	function input($data,$table){
		$this->db->insert($table,$data);
	}

	function del($id_pegawai){
		$this->db->where('id_pegawai', $id_pegawai);
		$this->db->delete('tb_pegawai');
	}

	function edit($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);

	}	
}

?>