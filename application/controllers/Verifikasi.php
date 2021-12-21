<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifikasi extends CI_Controller {

	function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			{
				redirect('auth/login');
			}
		}
		$this->load->model('m_data');
	}

	function detail_d(){
		$id = $this->input->post("id");
		$data["data"] = $this->db->get_where("tbl_data_judul",["id"=>$id])->row();
		$this->load->view('admin/detail_verifikasi', $data);
	}

	function verifikasi_judul_mahasiswa(){
		$a['page'] 		= 'admin/verifikasi_judul_mahasiswa';
		$a['title'] 	= 'Judul Mahasiswa';
		$a['title_nav_3'] = 'Admin';
		$a['title_nav_2'] = 'Input';
		$a['title_nav_1'] = 'Verifikasi';
		$this->load->view('admin/index',$a);
	}

	function get_form_verifikasi(){
		$data["id"] = $this->input->post("id");
		$data["data"] = $this->db->get_where("tbl_data_judul",["id"=>$data["id"]])->row();
		$this->load->view('admin/input/form_verify', $data);
	}

	function verifkasi_judul(){
		$user_id = $this->session->userdata('user_id'); 
		$last_update = date("Y-m-d H:i:s");
			$id = $this->input->post('id',true);

		$data = $_POST;
		$data["last_user"] = $user_id;

		if($this->m_data->hsave('tbl_data_judul',$data,$id,'2','id') == true){
			$mhs = $this->db->query("SELECT a.* FROM tbl_data_judul b LEFT JOIN users c ON b.diajukan_oleh = c.id 
			LEFT JOIN mahasiswa a ON c.email = a.email
			WHERE b.id = '$id'");
			if ($mhs->row("jenis") == "S2") {
				$this->db->insert("jadwal_ujian",["jenis_ujian"=>"Seminar Proposal","status"=>0,"id_judul"=>$id]);
				$this->db->insert("jadwal_ujian",["jenis_ujian"=>"Seminar Hasil","status"=>0,"id_judul"=>$id]);
				$this->db->insert("jadwal_ujian",["jenis_ujian"=>"Ujian Tutup","status"=>0,"id_judul"=>$id]);
				// $this->db->insert("tbl_nilai_seminar", ["id_judul"=> $id ]);
			} else {
				$this->db->insert("jadwal_ujian",["jenis_ujian"=>"Pendaftaran Prelium","status"=>0,"id_judul"=>$id]);
				$this->db->insert("jadwal_ujian",["jenis_ujian"=>"Gagasan Awal","status"=>0,"id_judul"=>$id]);
				$this->db->insert("jadwal_ujian",["jenis_ujian"=>"Seminar Proposal","status"=>0,"id_judul"=>$id]);
				$this->db->insert("jadwal_ujian",["jenis_ujian"=>"Seminar Hasil","status"=>0,"id_judul"=>$id]);
				$this->db->insert("jadwal_ujian",["jenis_ujian"=>"Ujian Tutup","status"=>0,"id_judul"=>$id]);
				$this->db->insert("jadwal_ujian",["jenis_ujian"=>"Promosi","status"=>0,"id_judul"=>$id]);
			}
			$return = array(
				'status'	=> true,
				'message'	=> 'Data terverifikasi..',
			);	
		}else{
			$return = array(
				'status'	=> false,
				'message'	=> 'Terjadi kesalahan, gagal menyimpan data..',
			);
		}
		echo json_encode($return);
	}

	function tolak_judul(){
		$id = $this->input->post("id");
		$alasan = $this->input->post("alasan");
		if($this->m_data->hsave('tbl_data_judul',["alasan_tolak"=>$alasan,"status"=>1],$id,'2','id') == true){
			$return = array(
				'status'	=> true,
				'message'	=> 'Berhasil..',
			);	
		}else{
			$return = array(
				'status'	=> false,
				'message'	=> 'Terjadi kesalahan, gagal menyimpan data..',
			);
		}
		echo json_encode($return);
	}

	function get_judul_terverifikasi(){
		$user_id = $this->session->userdata('user_id'); 
		$query = $this->db->select("a.*")->from("tbl_data_judul a")->where("status > 1");
		$group_id = $this->session->userdata('group_id');
		if ($group_id != "1"){
			$query->where("diajukan_oleh",$user_id);
		}
		 $column_order = array(null,'a.created_at'); //set column field database for datatable orderable
		  $column_search = array('judul','created_at'); //set column field database for datatable searchable 
	      $order = array('a.id' => 'desc'); // default order

	      $list = $this->m_data->get_datatables($query, $column_order, $column_search, $order);
	      $data = array();
			$no = $_POST['start'];
			foreach ($list['result'] as $rowi) {
				$no++;
				$row = array();
				$row[] = $no;
				$row[] = $rowi->created_at ;
				$row[] = $rowi->judul;
				$row[] = '
					<button class="btn btn-sm btn-primary" title="Detail" onclick="detail(\''.$rowi->id.'\')">Detail</button> <br>
				';
				$data[] = $row;
			}

	      $output = array(
	        "draw" => $_POST['draw'],
	        "recordsTotal" => $this->m_data->count_all($query),
	        "recordsFiltered" => $list['count_filtered'],
	        "data" => $data
	      );
	      echo json_encode($output);
	}

	function get_judul(){
		$user_id = $this->session->userdata('user_id'); 
		$group_id = $this->session->userdata('group_id');
		if ($group_id == "1"){
			$query = $this->db->select("a.*, c.jenis, c.nama as nm_mhs, c.np,c.nohp,c.prodi")->from('tbl_data_judul a ')
			->join("users b","a.diajukan_oleh=b.id","inner")->join("mahasiswa c","b.email=c.email","inner");
		} else {
			$dataku = $this->db->query("SELECT b.* FROM users a JOIN tbl_ketua_prodi b ON a.email = b.email WHERE a.id = '$user_id' ");
			$query = $this->db->select("a.*, c.jenis, c.nama as nm_mhs, c.np,c.nohp,c.prodi")->from('tbl_data_judul a ')
			->join("users b","a.diajukan_oleh=b.id","inner")->join("mahasiswa c","b.email=c.email","inner")
			->where("c.prodi",$dataku->row("prodi"));
		}
		$query->where("a.status <",3);

	      $column_order = array(null,'a.created_at'); //set column field database for datatable orderable
		  $column_search = array('c.jenis','c.nama','c.np','c.nohp'); //set column field database for datatable searchable 
	      $order = array('a.id' => 'desc'); // default order

	      $list = $this->m_data->get_datatables($query, $column_order, $column_search, $order);
	      $data = array();
			$no = $_POST['start'];
			foreach ($list['result'] as $rowi) {
				$no++;
				$row = array();
				$row[] = $no;
				$row[] = $rowi->created_at ;
				$row[] = 'Mahasiswa <b>'.$rowi->jenis.'</b><br>Nama : <b>'.$rowi->nm_mhs.'</b><br>Prodi : '.($this->db->get_where("tbl_jdl_seminar",["id"=>$rowi->prodi])->row("judul"));
				$row[] = $rowi->np;
				$row[] = $rowi->nohp;
				$status = "";
				if ($rowi->status == 0){
					$status = '<span class="badge badge-warning">Menunggu Verifikasi</span>';
				} else if ($rowi->status == 1){
					$status = '<span class="badge badge-danger">ditolak</span>';
				} else if ($rowi->status == 2){
					$status = '<span class="badge badge-primary">terverifikasi</span>';
				} else {
					$status = '<span class="badge badge-success">selesai</span>';
				}
				$row[] = $status;
				$row[] = '
					<button class="btn btn-sm btn-primary" title="Detail" onclick="detail(\''.$rowi->id.'\')">Detail</button> <br>
				';
				$data[] = $row;
			}

	      $output = array(
	        "draw" => $_POST['draw'],
	        "recordsTotal" => $this->m_data->count_all($query),
	        "recordsFiltered" => $list['count_filtered'],
	        "data" => $data
	      );
	      echo json_encode($output);
	}

}

/* End of file Verifikasi.php */
/* Location: ./application/controllers/Verifikasi.php */