<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_penilaian');
		$this->load->model('m_laporan');
		$this->load->library('pdf');
		if($this->session->userdata('masuk') != TRUE){
            redirect('login');
        }
	}

	function index()
	{
		// model m_penilaian
		$data['penilaian'] = $this->m_penilaian->getDataPenilaian()->result();
		$data['kriteria'] = $this->m_penilaian->getDataKriteria()->result();
		$data['pegawai'] = $this->m_penilaian->getDataPegawai()->result();
		$data['pegawaipenilaian'] = $this->m_penilaian->getDataPegawaiPenilaian()->result();
		$data['ceknip'] = $this->m_penilaian->getDataNip()->result();
		$data['jumlahnip'] = count($data['ceknip']);

		// model m_laporan
		$this->load->view('v_header');
		$this->load->view('v_laporan', $data);
		$this->load->view('v_footer');


	}

	function pdfReport()
	{
		
        $pdf = new FPDF('l','mm','A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(190,7,'LAPORAN PENILAIAN PEGAWAI',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(20,6,'NIM',1,0);
        $pdf->Cell(85,6,'NAMA MAHASISWA',1,0);
        $pdf->Cell(27,6,'NO HP',1,0);
        $pdf->Cell(25,6,'TANGGAL LHR',1,1);
        $pdf->SetFont('Arial','',10);
        $mahasiswa = $this->db->get('mahasiswa')->result();
        foreach ($mahasiswa as $row){
            $pdf->Cell(20,6,$row->nim,1,0);
            $pdf->Cell(85,6,$row->nama_lengkap,1,0);
            $pdf->Cell(27,6,$row->no_hp,1,0);
            $pdf->Cell(25,6,$row->tanggal_lahir,1,1); 
        }
        $pdf->Output();
    }

}
