<?php 

class M_akun extends CI_Model{
	function getData(){
		return $this->db->get('tb_user');
	}

	function input($data,$table){
     	$this->db->insert($table,$data);
	}

	function del($id_user){
		$this->db->where('id_user', $id_user);
		$this->db->delete('tb_user');
	}

	function edit($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}	
}

?>