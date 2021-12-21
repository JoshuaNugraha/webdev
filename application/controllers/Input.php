<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Input extends CI_Controller {

	function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			{
				redirect('auth/login');
			}
		}
		$this->load->model('m_data');
		$this->load->model('m_berkas');
	}

	public function verifikasi_persyaratan(){
		$a['page'] 		= 'admin/input/verifikasi_persyaratan';
		$a['title'] 	= 'Verifikasi Persyaratan';
		$a['title_nav_3'] = '';
		$a['title_nav_2'] = 'Admin';
		$a['title_nav_1'] = 'Verifikasi Persyaratan';
		$this->load->view('admin/index',$a);
	}

	public function persyaratan_ujian(){
		$a['page'] 		= 'admin/input/persyaratan_ujian';
		$a['title'] 	= 'Persyaratan mengikuti ujian';
		$a['title_nav_3'] = 'Admin';
		$a['title_nav_2'] = 'Input';
		$a['title_nav_1'] = 'Persyaratan mengikuti ujian';
		$this->load->view('admin/index',$a);
	}

	public function input_nilai_seminar(){
	
		$a['page'] 		= 'admin/input/input_nilai_seminar';
		$a['title'] 	= 'Input Nilai Seminar';
		$a['title_nav_3'] = 'Admin';
		$a['title_nav_2'] = 'Input';
		$a['title_nav_1'] = 'Input Nilai Seminar';
 
		$this->load->view('admin/index',$a);
	}

	public function judul_yang_ditawarkan()
	{
		$a['page'] 		= 'admin/input/judul_yang_ditawarkan';
		$a['title'] 	= 'Judul yang ditawarkan';
		$a['title_nav_3'] = 'Admin';
		$a['title_nav_2'] = 'Input';
		$a['title_nav_1'] = 'Judul yang ditawarkan';
		$this->load->view('admin/index',$a);
	}

	function upload_persyaratan(){
		$id = $this->input->post("id");
		$tgl = date("Y-m-d H:i:s");
		$data = [
			"status" => 1,
			"tanggal" => $tgl
		];
		$ext = '';
		if (isset($_FILES["foto"]["tmp_name"])) {
			$fileTemp = $_FILES["foto"]["tmp_name"];
			$fileSize = $_FILES["foto"]["size"];
			$temp = explode(".", $_FILES["foto"]["name"]);
			$newfilename = $id."_".round(microtime(true)) . '.' . end($temp);

			$ext = end($temp);

			$file = $this->input->post('gambar_hide',true);
			if ($fileTemp != '') {
				if ($file != '' && $file != null) {
					$cek_file = file_exists("assets/images/$file");
					if($cek_file == '1'){
						unlink('assets/images/'.$file);
					}
				}
				@move_uploaded_file($fileTemp,'assets/images/'.$newfilename);
				$file = $newfilename;
			}
		} else {
			$file = $this->input->post('gambar_hide',true);
		}
		$data["persyaratan"] = $file;
		$this->m_data->hsave("jadwal_ujian",$data,$id,'2',"id");

		$return = array(
				'status'	=> true,
				'message'	=> 'Persyaratan Berhasil dikirim..',
		);

		echo json_encode($return);
	}

	function set_nilai(){
		$id = $this->input->post("id");
		$sebagai = $this->input->post("sebagai");
		$nilai = $this->input->post("nilai");
		$user_id = $this->session->userdata('user_id'); 
		$dataku = $this->db->query("SELECT b.* FROM users a JOIN tbl_dosen b ON a.email = b.email WHERE a.id = '$user_id' ");
		$this->m_data->hsave("jadwal_ujian",["nilai_".$sebagai => $dataku->row("id")."-".$nilai],$id,'2',"id");
		$return = array(
				'status'	=> true,
				'message'	=> 'Nilai berhasil disimpan..',
		);

		echo json_encode($return);
	}

	function input_nilai(){
			$id = $this->input->post("id");
			$uid =  $this->session->userdata('user_id');
			$where = array(
				'uid' => $uid
			);
			$data['uid'] = $this->m_data->get_role('tbl_dosen',$where)->row()->id;
			$data['role'] = $this->m_data->i_nilai($data['uid']);
			$data['nilai'] = $this->m_data->get_role('tbl_nilai_seminar',['id_judul'=> $id])->result();
			$cek = $this->m_data->get_role('tbl_data_judul',['id'=> $id])->result();
			$arr = array();
			$arr = ['pembimbing1_rata','pembimbing2_rata','penguji1_rata','penguji2_rata','penguji3_rata'];
			$arr2 = array();
			$arr2 = ['pembimbing1', 'pembimbing2', 'penguji1', 'penguji2', 'penguji3'];
			$i =0;
			// for($u = 0; $u < count($arr); $u++){
			// 	if($cek[0]->$arr2[$u]==$data['uid']){
			// 		if($this->m_data->get_role('tbl_nilai_seminar',['id'=>$id])->row($arr[$i])!==null){
			// 			$data['cek_nilai'][0] = 0;
			// 		}else{
			// 			echo $arr[$i]. " ini";
			// 		}
			// 	}
			// 	echo $cek[0]->$arr2[$u];
			// }
			
			
			// foreach($cek as $c){
			// 	if($c->pembimbing1==$data['uid']){
			// 		if($this->m_data->get_role('tbl_nilai_seminar',['id'=>$id])->row($arr[$i])!==null){
			// 			$data['cek_nilai'][0] = 0;
			// 		}else{
			// 			echo $arr[$i]. " ini";
			// 		}
			// 	}
			// }
			// print_r($cek[0]->pembimbing1);

				
			 
		 
			$data["data"] = $this->db->get_where("tbl_data_judul",["id"=>$id])->row();
			$this->load->view('admin/input/input_nilai', $data);
	}

	function update_status_persyaratan(){
		$user_id = $this->session->userdata('user_id'); 
		$last_update = date("Y-m-d H:i:s");
		$id = $this->input->post('id',true);
		$data = $_POST;
		$data["last_user"] = $user_id;
		if($this->m_data->hsave('tbl_data_judul',$data,$id,'2','id') == true){
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

	function simpan_data_judul(){
		$user_id = $this->session->userdata('user_id'); 
		$last_update = date("Y-m-d H:i:s");
		$aksi = $this->input->post('aksi',true);
		if($aksi == '1'){
			$id = $this->db->query("SELECT IFNULL(MAX(id)+1,1) AS max_id FROM tbl_data_judul")->row('max_id');
		}else{
			$id = $this->input->post('kode',true);
		}

		$data = $_POST;
		unset($data["aksi"]);
		unset($data["kode"]);
		$data["last_user"] = $user_id;
		$data["id"] = $id;

		if ($aksi == '1'){
			$data["diajukan_oleh"] = $user_id;
			$data["created_by"] = $user_id;
		}

		if($this->m_data->hsave('tbl_data_judul',$data,$id,$aksi,'id') == true){
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


	function upload_v2(){
		$id = $this->input->post("id");
		$data["data2"] = $this->db->get_where("jadwal_ujian",["id"=>$id])->row();
		$data["data"] = $this->db->get_where("tbl_data_judul",["id"=>$data["data2"]->id_judul])->row();
		$this->load->view('admin/input/upload2', $data);
	}

	function upload_v(){
		$id = $this->input->post("id");
		$data["data"] = $this->db->get_where("tbl_data_judul",["id"=>$id])->row();
		$this->load->view('admin/input/upload', $data);
	}

	function persyaratan_s(){
		$id = $this->input->post("id");
		$data["data"] = $this->db->get_where("tbl_data_judul",["id"=>$id])->row();
		$this->load->view('admin/input/up_persyaratan', $data);
	}

	function detail(){
		$id = $this->input->post("id");
		$data["data"] = $this->db->get_where("tbl_data_judul",["id"=>$id])->row();
		$this->load->view('admin/input/detail', $data);
	}

	function get_data_dosen_insert_nilai(){
		$user_id = $this->session->userdata('user_id'); 
		$group_id = $this->session->userdata('group_id');
		$as = "S".$_GET["s"];
		if ($group_id == "1"){
			$query = $this->db->select("a.*, c.jenis, c.nama as nm_mhs, c.np,c.nohp,c.prodi")->from('tbl_data_judul a ')
			->join("users b","a.diajukan_oleh=b.id","inner")->join("mahasiswa c","b.email=c.email","inner")
			->where("c.jenis",$as)
			->where("a.status >=",'2');
		} else {
			$dataku = $this->db->query("SELECT b.* FROM users a JOIN tbl_dosen b ON a.email = b.email WHERE a.id = '$user_id' ");
			$query = $this->db->select("a.*, c.jenis, c.nama as nm_mhs, c.np,c.nohp,c.prodi")->from('tbl_data_judul a ')
			->join("users b","a.diajukan_oleh=b.id","inner")->join("mahasiswa c","b.email=c.email","inner")
			->where("c.jenis = '$as' AND (a.pembimbing1 = '".$dataku->row("id")."' OR a.pembimbing2 = '".$dataku->row("id")."' OR a.penguji1 = '".$dataku->row("id")."' OR a.penguji2 = '".$dataku->row("id")."' OR a.penguji3 = '".$dataku->row("id")."') AND a.status >= 2");
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


	function get_judul_up_persyaratan(){
		$user_id = $this->session->userdata('user_id'); 
		$group_id = $this->session->userdata('group_id');
		if ($group_id == "1"){
			$query = $this->db->select("a.*, c.jenis, c.nama as nm_mhs, c.np,c.nohp,c.prodi")->from('tbl_data_judul a ')
			->join("users b","a.diajukan_oleh=b.id","inner")->join("mahasiswa c","b.email=c.email","inner")
			->where("a.status >=",'2');
		} else {
			$dataku = $this->db->query("SELECT b.* FROM users a JOIN tbl_loket b ON a.email = b.email WHERE a.id = '$user_id' ");
			$query = $this->db->select("a.*, c.jenis, c.nama as nm_mhs, c.np,c.nohp,c.prodi")->from('tbl_data_judul a ')
			->join("users b","a.diajukan_oleh=b.id","inner")->join("mahasiswa c","b.email=c.email","inner")
			->where("c.prodi",$dataku->row("prodi"))
			->where("a.status >=",'2');
		}

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
				$row[] = 'Mahasiswa <b>'.$rowi->jenis.'</b><br>Nama : <b>'.$rowi->nm_mhs.'</b><br>Nomor Pokok : '.$rowi->np;
				$row[] = $this->db->get_where("tbl_jdl_seminar",["id"=>$rowi->prodi])->row("judul");
				if ($rowi->status == 0){
					$status = '<span class="badge badge-warning">Menunggu Verifikasi</span>';
				} else if ($rowi->status == 1){
					$status = '<span class="badge badge-danger">ditolak</span>';
				} else if ($rowi->status == 2){
					$status = '<span class="badge badge-primary">terverifikasi</span>';
				} else if ($rowi->status == 3){
					$status = '<span class="badge badge-warning">Menunggu Verifikasi Persyaratan</span>';
				}  else if ($rowi->status == 4){
					$status = '<span class="badge badge-danger">Persyaratan ditolak</span>';
				} else if ($rowi->status == 5){
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

	function cek_data(){
		$user_id = $this->session->userdata('user_id'); 
		$group_id = $this->session->userdata('group_id');
		$query = $this->db->select("*")->from('tbl_data_judul');
		if ($group_id != '1'){
			$query->where("created_by",$user_id);
		}
		if (isset($_GET["status"])){
			$query->where("status",$_GET["status"]);
		} else {
			$query->where("status <",2);
		}
		$d = $query->get();
		if ($d->num_rows() > 0){
			echo "ok";
		} else {
			echo "gagal";
		}
	}
	

	function get_judul_yg_ditawarkan(){
		$user_id = $this->session->userdata('user_id'); 
		$group_id = $this->session->userdata('group_id');
		$query = $this->db->select("*")->from('tbl_data_judul');
		if ($group_id != '1'){
			$query->where("created_by",$user_id);
		}
		if (isset($_GET["status"])){
			$query->where("status",$_GET["status"]);
		} else {
			$query->where("status <",2);
		}


	      $column_order = array(null,'created_at'); //set column field database for datatable orderable
		  $column_search = array('judul1','judul2','judul3'); //set column field database for datatable searchable 
	      $order = array('id' => 'desc'); // default order

	      $list = $this->m_data->get_datatables($query, $column_order, $column_search, $order);
	      $data = array();
			$no = $_POST['start'];
			foreach ($list['result'] as $rowi) {
				$no++;
				$row = array();
				$row[] = $no;
				$row[] = $rowi->created_at ;
				if ($rowi->status == 2 && isset($_GET["status"])){
					$row[] = $rowi->judul;
				} else {
					$row[] = $rowi->judul1.'<hr>'.$rowi->judul2.'<hr>'.$rowi->judul3 ;
				}
				$status = "";
				$lanjut = "";
				if ($rowi->status == 0){
					$status = '<span class="badge badge-warning">Menunggu Verifikasi</span>';
					$lanjut = '<button class="mt-2 btn btn-sm btn-danger" title="Hapus" onclick="hapus(\''.$rowi->id.'\',\'tbl_data_judul\')"><i class="fa fa-trash"></i></button>';
				} else if ($rowi->status == 1){
					$status = '<span class="badge badge-danger">ditolak</span><br>'.$rowi->alasan_tolak;
					$lanjut = '<button class="mt-2 btn btn-sm btn-danger" title="Hapus" onclick="hapus(\''.$rowi->id.'\',\'tbl_data_judul\')"><i class="fa fa-trash"></i></button>';
				} else if ($rowi->status == 2){
					$status = '<span class="badge badge-primary">terverifikasi</span>';
				} else if ($rowi->status == 3){
					$status = '<span class="badge badge-primary">selesai</span>';
				}
				$row[] = $status;
				if (isset($_GET["status"])){
					$row[] = '#';
				} else {
				$row[] = '
					<button class="btn btn-sm btn-success" title="Detail" onclick="detail(\''.$rowi->id.'\')"><i class="fa fa-eye"></i></button> <br>
					
				'.$lanjut;

				}
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

	public function persuratan(){
		$a['table'] = $this->m_berkas->getTable()->result();
		$a['page'] 		= 'admin/input/input_berkas';
		$a['title'] 	= 'Persuratan';
		$a['title_nav_3'] = 'Admin';
		$a['title_nav_2'] = 'Master';
		$a['title_nav_1'] = 'Pesuratan';
		$this->load->view('admin/index',$a);
	}

	public function get_mahsiswa_seminar(){
		
	}

}

/* End of file Input.php */
/* Location: ./application/controllers/Input.php */