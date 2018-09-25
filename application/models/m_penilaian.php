<?php 

class M_penilaian extends CI_Model{

	function getDataPenilaian(){
		return $this->db->get('tb_penilaian');
	}

	function getDataKriteria(){
		return $this->db->get('tb_kriteria');
	}

	function getDataPegawai(){
		return $this->db->get('tb_pegawai');
	}

	function getDataPegawaiById($id_pegawai){
		$this->db->select('*');
		$this->db->where('id_pegawai',$id_pegawai);
		$result = $this->db->get('tb_pegawai')->result_array();
		return $result;
	}

	function getDataPegawaiPenilaian(){
		
		$this->db->from('tb_penilaian, tb_pegawai')
          ->where('tb_penilaian.id_pegawai = tb_pegawai.id_pegawai')
          ->group_by('tb_penilaian.id_pegawai')
          ->order_by('tb_penilaian.id_penilaian');

		$query = $this->db->get();
		return $query;
	}

	// function getDataPenilaianByIdPegawai($id_pegawai){
	// 	return $this->db->query("SELECT * FROM tb_penilaian where id_pegawai='$id_pegawai'" );
	// }

	function getDataNip(){
		return $this->db->query("SELECT * FROM tb_pegawai WHERE not EXISTS(SELECT id_pegawai FROM tb_penilaian WHERE tb_pegawai.id_pegawai = tb_penilaian.id_pegawai) ORDER BY NIP");
	}

	function input($data,$table){
		$this->db->insert($table,$data);
	}

	function del($id_pegawai){
		$this->db->where('id_pegawai', $id_pegawai);
		$this->db->delete('tb_penilaian');
	}

	function edit($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
}
?>