<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			{
				redirect('auth/login');
			}
		}
		$this->load->model('m_data');
	}

	function lap_rekap_nilai_setiap_mahasiswa(){
		$a['page'] 		= 'admin/laporan/lap_rekap_nilai_setiap_mahasiswa';
		$a['title'] 	= 'Laporan Rekap Nilai Setiap Mahasiswa';
		$a['title_nav_3'] = 'Admin';
		$a['title_nav_2'] = 'Laporan';
		$a['title_nav_1'] = 'Laporan Rekap Nilai Setiap Mahasiswa';
		$this->load->view('admin/index',$a);
	}

	function get_mhs_by_jenis(){
		$jenis = $this->input->post("jenis");
		$data = $this->db->get_where("mahasiswa",["jenis"=>$jenis]);
		$html = '<option value="">Pilih</option>';
		foreach ($data->result() as $d) {
			$html .= '<option value="'.$d->id.'">'.$d->nama .' - '.$d->np.'</option>';
		}
		echo $html;
	}

	function get_judul_by_mhs(){
		$id_mhs = $this->input->post("id_mhs");
		$data = $this->db->query("
			SELECT c.* FROM mahasiswa a JOIN users b ON a.email=b.email
			JOIN tbl_data_judul c ON b.id = c.diajukan_oleh
			WHERE a.id = '$id_mhs' AND c.status = 2
		");
		$html = '<option value="">Pilih</option>';
		foreach ($data->result() as $d) {
			$html .= '<option value="'.$d->id.'">'.$d->judul .'</option>';
		}
		echo $html;
	}

}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */