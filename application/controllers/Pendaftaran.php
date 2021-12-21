<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

	function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			{
				redirect('auth/login');
			}
		}
		$this->load->model('m_data');
	}

	function pendaftaran_seminar(){
		if(isset($_GET["s"]) && ($_GET["s"] == "2" || $_GET["s"] == "3")){
			$a['page'] 		= 'admin/pendaftaran_seminar';
			$a['title'] 	= 'Pendaftaran Seminar S'.$_GET["s"];
			$a['title_nav_3'] = '';
			$a['title_nav_2'] = 'Admin';
			$a['title_nav_1'] = 'Pendaftaran Seminar S'.$_GET["s"];
			$this->load->view('admin/index',$a);
		} else {
			redirect('jadwal-seminar-semua-prodi');
		}
	}

	function update_status_persyaratan(){
		$id = $this->input->post('id',true);
		$date = $this->input->post('tanggal');	
		$data = $_POST;
		
		 
		if($this->m_data->hsave('jadwal_ujian',$data,$id,'2','id') == true){
			$judul = $this->db->get_where('jadwal_ujian', ['id' => $id])->row();
			$id_judul = $judul->id_judul;
			$jns_ujian = $judul->jenis_ujian;
			$stt = $judul->status;
			$this->db->insert('tbl_nilai_seminar', ["id_judul"=>$id_judul, "jenis_ujian"=>$jns_ujian, "status"=>$stt]);
			$return = array(
				'status'	=> true,
				'message'	=> 'Data berhasil tersimpan..',
			);	
		}else{
			$return = array(
				'status'	=> false,
				'message'	=> 'Terjadi kesalahan, gagal menyimpan data..',
			);
		}
		echo json_encode($return);
	}
 
	function detail_d(){
		$id = $this->input->post("id");
		$data["data"] = $this->db->get_where("tbl_data_judul",["id"=>$id])->row();
		$this->load->view('admin/detail_verifikasi2', $data);
		// echo json_decode($id);
	}

	function get_pendaftaran(){
		$user_id = $this->session->userdata('user_id'); 
		$group_id = $this->session->userdata('group_id');
		$as = "S".$_GET["s"];
		if ($group_id == "1"){
			$query = $this->db->select("a.*, c.jenis, c.nama as nm_mhs, c.np,c.nohp,c.prodi")->from('tbl_data_judul a ')
			->join("users b","a.diajukan_oleh=b.id","inner")->join("mahasiswa c","b.email=c.email","inner")
			->where("c.jenis",$as)
			->where("a.status >=",'2');
		} else {
			$dataku = $this->db->query("SELECT b.* FROM users a JOIN tbl_loket b ON a.email = b.email WHERE a.id = '$user_id' ");
			$query = $this->db->select("a.*, c.jenis, c.nama as nm_mhs, c.np,c.nohp,c.prodi")->from('tbl_data_judul a ')
			->join("users b","a.diajukan_oleh=b.id","inner")->join("mahasiswa c","b.email=c.email","inner")
			->where("c.jenis",$as)
			->where("c.prodi",$dataku->row("prodi"))
			->where("a.status >=",'2');
		}
		$column_order = array(); //set column field database for datatable orderable
		  $column_search = array('c.jenis','c.nama','c.np','c.nohp'); //set column field database for datatable searchable 
	      $order = array('a.id' => 'desc'); // default order

	      $list = $this->m_data->get_datatables($query, $column_order, $column_search, $order);
	      $data = array();
			$no = $_POST['start'];
			foreach ($list['result'] as $rowi) {
				$no++;
				$row = array();
				$row[] = $no;
				$row[] = 'Nama : <b>'.$rowi->nm_mhs.'</b><br>Nomor Pokok : '.$rowi->np."<br>Program Studi : ".$this->db->get_where("tbl_jdl_seminar",["id"=>$rowi->prodi])->row("judul");
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

}

/* End of file Pendaftaran.php */
/* Location: ./application/controllers/Pendaftaran.php */