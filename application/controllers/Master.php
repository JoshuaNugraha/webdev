<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

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

	function dosen(){
		$a['page'] 		= 'admin/master/dosen';
		$a['title'] 	= 'Dosen';
		$a['title_nav_3'] = 'Admin';
		$a['title_nav_2'] = 'Master';
		$a['title_nav_1'] = 'Dosen';
		$this->load->view('admin/index',$a);
	}

	function judul_seminar(){
		$a['page'] 		= 'admin/master/judul_seminar';
		$a['title'] 	= 'Program Study';
		$a['title_nav_3'] = 'Admin';
		$a['title_nav_2'] = 'Master';
		$a['title_nav_1'] = 'Program Study';
		$this->load->view('admin/index',$a);
	}

	function jurusan(){
		$a['page'] 		= 'admin/master/jurusan';
		$a['title'] 	= 'Data Jurusan';
		$a['title_nav_3'] = 'Admin';
		$a['title_nav_2'] = 'Master';
		$a['title_nav_1'] = 'Data Jurusan';
		$this->load->view('admin/index',$a);
	}

	function persyaratan_ujian(){

		$ext = '';
		if (isset($_FILES["pdf"]["tmp_name"])) {
			$fild = $this->input->post("fild");
			$fileTemp = $_FILES["pdf"]["tmp_name"];
			$fileSize = $_FILES["pdf"]["size"];
			$temp = explode(".", $_FILES["pdf"]["name"]);
			$newfilename = strtoupper($fild)."_".round(microtime(true)) . '.' . end($temp);

			$ext = end($temp);

			$file = $this->db->get("pengaturan")->row($fild);
			if ($fileTemp != '') {
				if ($file != '' && $file != null) {
					$cek_file = file_exists("assets/$file");
					if($cek_file == '1'){
						unlink('assets/'.$file);
					}
				}
				@move_uploaded_file($fileTemp,'assets/'.$newfilename);
				$file = $newfilename;
				$this->db->where("id",'1');
				$this->db->update("pengaturan",[$fild=>$file]);
				echo "<script>alert('Berhasil diupload')</script>";
				redirect('master-persyaratan-ujian','refresh');
			}
		}
 
		$a['page'] 		= 'admin/master/persyaratan_ujian';
		$a['title'] 	= 'Persyaratan Ujian';
		$a['title_nav_3'] = 'Admin';
		$a['title_nav_2'] = 'Master';
		$a['title_nav_1'] = 'Persyaratan Ujian';
		$this->load->view('admin/index',$a);
	}

	function mahasiswa2(){
		if( isset($_GET['key']) && ($_GET["key"] == '2' ||  $_GET["key"] == '3') ){
			$a['page'] 		= 'admin/master/mahasiswa2';
			$a['title'] 	= 'Data Mahasiswa S'.$_GET["key"];
			$a['title_nav_3'] = 'Admin';
			$a['title_nav_2'] = 'Master';
			$a['title_nav_1'] = 'Data Mahasiswa S'.$_GET["key"];
			$this->load->view('admin/index',$a);
		} else {
			echo "<script>
			alert('Url tidak Valid');
			document.location.href = '".base_url()."'
			</script>";
		}
	}

	function ketua_prodi(){
		$a['page'] 		= 'admin/master/ketua_prodi';
		$a['title'] 	= 'Data Ketua Program Study';
		$a['title_nav_3'] = 'Admin';
		$a['title_nav_2'] = 'Master';
		$a['title_nav_1'] = 'Data Ketua Program Study';
		$this->load->view('admin/index',$a);
	}

	function loket(){
		$a['page'] 		= 'admin/master/loket';
		$a['title'] 	= 'Data Loket / Operator';
		$a['title_nav_3'] = 'Admin';
		$a['title_nav_2'] = 'Master';
		$a['title_nav_1'] = 'Data Loket / Operator';
		$this->load->view('admin/index',$a);
	}

	// ========================================================

	public function get_mahasiswa() {
		$query = $this->db->select("a.*, ifnull(b.judul,'') as nm_prodi")->from('mahasiswa a')->join("tbl_jdl_seminar b","a.prodi=b.id","left")->where('jenis','S'.$_GET["jenis"]);
      $column_order = array('a.nama','a.np','a.email','a.nohp'); //set column field database for datatable orderable
	  $column_search = array('b.judul','a.nama','a.nohp','a.email','a.np'); //set column field database for datatable searchable 
      $order = array('a.id' => 'desc'); // default order

      $list = $this->m_data->get_datatables($query, $column_order, $column_search, $order);
      $data = array();
		$no = $_POST['start'];
		foreach ($list['result'] as $rowi) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $rowi->nama ;
			$row[] = $rowi->np ;
			$row[] = $rowi->email ;
			$row[] = $rowi->nohp ;
			$row[] = $rowi->nm_prodi ;

			$row[] = '
				<button class="btn btn-sm btn-warning" title="Edit" onclick="edit(\''.$rowi->id.'\',\'mahasiswa\')"><i class="fa fa-edit"></i></button>
				<button class="btn btn-sm btn-danger" title="Hapus" onclick="hapus(\''.$rowi->id.'\',\'mahasiswa\')"><i class="fa fa-trash"></i></button>
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

	public function get_ketua_prodi() {
		$query = $this->db->select("a.*, ifnull(b.judul,'') as nm_prodi")->from('tbl_ketua_prodi a')->join("tbl_jdl_seminar b","a.prodi=b.id","left");
      $column_order = array('a.nama','a.nik','a.email','a.nohp'); //set column field database for datatable orderable
	  $column_search = array('b.judul','a.nama','a.nohp','a.email','a.nik'); //set column field database for datatable searchable 
      $order = array('a.id' => 'desc'); // default order

      $list = $this->m_data->get_datatables($query, $column_order, $column_search, $order);
      $data = array();
		$no = $_POST['start'];
		foreach ($list['result'] as $rowi) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $rowi->nama ;
			$row[] = $rowi->nik ;
			$row[] = $rowi->email ;
			$row[] = $rowi->nohp ;
			$row[] = $rowi->nm_prodi ;

			$row[] = '
				<button class="btn btn-sm btn-warning" title="Edit" onclick="edit(\''.$rowi->id.'\',\'tbl_ketua_prodi\')"><i class="fa fa-edit"></i></button>
				<button class="btn btn-sm btn-danger" title="Hapus" onclick="hapus(\''.$rowi->id.'\',\'tbl_ketua_prodi\')"><i class="fa fa-trash"></i></button>
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

	public function get_dosen() {
		$query = $this->db->select("a.*")->from('tbl_dosen a');
      $column_order = array('a.nama','a.nip','a.email','a.nohp'); //set column field database for datatable orderable
	  $column_search = array('a.nama','a.nohp','a.email','a.nip'); //set column field database for datatable searchable 
      $order = array('a.id' => 'desc'); // default order

      $list = $this->m_data->get_datatables($query, $column_order, $column_search, $order);
      $data = array();
		$no = $_POST['start'];
		foreach ($list['result'] as $rowi) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $rowi->nama ;
			$row[] = $rowi->nip ;
			$row[] = $rowi->email ;
			$row[] = $rowi->nohp ;

			$row[] = '
				<button class="btn btn-sm btn-warning" title="Edit" onclick="edit(\''.$rowi->id.'\',\'tbl_dosen\')"><i class="fa fa-edit"></i></button>
				<button class="btn btn-sm btn-danger" title="Hapus" onclick="hapus(\''.$rowi->id.'\',\'tbl_dosen\')"><i class="fa fa-trash"></i></button>
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

	public function get_loket() {
		$query = $this->db->select("a.*, ifnull(b.judul,'') as nm_prodi")->from('tbl_loket a')->join("tbl_jdl_seminar b","a.prodi=b.id","left");
      $column_order = array('a.nama','a.nik','a.email','a.nohp'); //set column field database for datatable orderable
	  $column_search = array('b.judul','a.nama','a.nohp','a.email','a.nik'); //set column field database for datatable searchable 
      $order = array('a.id' => 'desc'); // default order

      $list = $this->m_data->get_datatables($query, $column_order, $column_search, $order);
      $data = array();
		$no = $_POST['start'];
		foreach ($list['result'] as $rowi) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $rowi->nama ;
			$row[] = $rowi->nik ;
			$row[] = $rowi->email ;
			$row[] = $rowi->nohp ;
			$row[] = $rowi->nm_prodi ;

			$row[] = '
				<button class="btn btn-sm btn-warning" title="Edit" onclick="edit(\''.$rowi->id.'\',\'tbl_loket\')"><i class="fa fa-edit"></i></button>
				<button class="btn btn-sm btn-danger" title="Hapus" onclick="hapus(\''.$rowi->id.'\',\'tbl_loket\')"><i class="fa fa-trash"></i></button>
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

	public function get_judul_seminar() {

      $query = $this->db->select("*")->from('tbl_jdl_seminar');
      $column_order = array(); //set column field database for datatable orderable
	  $column_search = array('judul','jns'); //set column field database for datatable searchable 
      $order = array('id' => 'desc'); // default order

      $list = $this->m_data->get_datatables($query, $column_order, $column_search, $order);
      $data = array();
		$no = $_POST['start'];
		foreach ($list['result'] as $rowi) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $rowi->judul ;
			$row[] = $rowi->jns ;

			$row[] = '
				<button class="btn btn-sm btn-warning" title="Edit" onclick="edit(\''.$rowi->id.'\',\'tbl_jdl_seminar\')"><i class="fa fa-edit"></i></button>
				<button class="btn btn-sm btn-danger" title="Hapus" onclick="hapus(\''.$rowi->id.'\',\'tbl_jdl_seminar\')"><i class="fa fa-trash"></i></button>
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

   	public function get_jurusan() {

      $query = $this->db->select("*")->from('tbl_jurusan');
      $column_order = array(); //set column field database for datatable orderable
	  $column_search = array('nama','singkatan'); //set column field database for datatable searchable 
      $order = array('id' => 'desc'); // default order

      $list = $this->m_data->get_datatables($query, $column_order, $column_search, $order);
      $data = array();
		$no = $_POST['start'];
		foreach ($list['result'] as $rowi) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $rowi->nama ;
			$row[] = $rowi->singkatan ;

			$row[] = '
				<button class="btn btn-sm btn-warning" title="Edit" onclick="edit(\''.$rowi->id.'\',\'tbl_jurusan\')"><i class="fa fa-edit"></i></button>
				<button class="btn btn-sm btn-danger" title="Hapus" onclick="hapus(\''.$rowi->id.'\',\'tbl_jurusan\')"><i class="fa fa-trash"></i></button>
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

   	function simpan_dosen(){
   		$user_id = $this->session->userdata('user_id'); 
		$last_update = date("Y-m-d H:i:s");
		$aksi = $this->input->post('aksi',true);
		$email = $this->input->post('email',true);

		// cek email
		if ($aksi == '1'){
		if ($this->db->get_where("users",["email"=>$email])->num_rows() > 0){
			$return = array(
				'status'	=> false,
				'message'	=> 'Maaf Email sudah digunakan',
			); 
			echo json_encode($return);
			die();
		}}

		if($aksi == '1'){
			$id = $this->db->query("SELECT IFNULL(MAX(id)+1,1) AS max_id FROM tbl_dosen")->row('max_id');
		}else{
			$id = $this->input->post('kode',true);
		}

		$password = $this->input->post('password',true);

		$data = $_POST;
		unset($data["aksi"]);
		unset($data["kode"]);
		unset($data["password"]);
		$data["last_user"] = $user_id;
		$data["id"] = $id;

		if ($aksi == '1'){
			$data["created_by"] = $user_id;
		}

		if($this->m_data->hsave('tbl_dosen',$data,$id,$aksi,'id') == true){
			$this->m_data->simpan_user($id,$aksi,$email,$password,$email,'6',$_POST["nama"],'',$_POST["nohp"],'1',$id);
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

   	function simpan_ketua_prodi(){
   		$user_id = $this->session->userdata('user_id'); 
		$last_update = date("Y-m-d H:i:s");
		$aksi = $this->input->post('aksi',true);
		$email = $this->input->post('email',true);

		// cek email
		if ($aksi == '1'){
		if ($this->db->get_where("users",["email"=>$email])->num_rows() > 0){
			$return = array(
				'status'	=> false,
				'message'	=> 'Maaf Email sudah digunakan',
			); 
			echo json_encode($return);
			die();
		}}

		if($aksi == '1'){
			$id = $this->db->query("SELECT IFNULL(MAX(id)+1,1) AS max_id FROM tbl_ketua_prodi")->row('max_id');
		}else{
			$id = $this->input->post('kode',true);
		}

		$password = $this->input->post('password',true);

		$data = $_POST;
		unset($data["aksi"]);
		unset($data["kode"]);
		unset($data["password"]);
		$data["last_user"] = $user_id;
		$data["id"] = $id;

		if ($aksi == '1'){
			$data["created_by"] = $user_id;
		}

		if($this->m_data->hsave('tbl_ketua_prodi',$data,$id,$aksi,'id') == true){
			$this->m_data->simpan_user($id,$aksi,$email,$password,$email,'4',$_POST["nama"],'',$_POST["nohp"],'1',$id);
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

   	function simpan_mahasiswa(){
   		$user_id = $this->session->userdata('user_id'); 
		$last_update = date("Y-m-d H:i:s");
		$aksi = $this->input->post('aksi',true);
		$email = $this->input->post('email',true);

		// cek email
		if ($aksi == '1'){
			if ($this->db->get_where("users",["email"=>$email])->num_rows() > 0){
				$return = array(
					'status'	=> false,
					'message'	=> 'Maaf Email sudah digunakan',
				); 
				echo json_encode($return);
				die();
			}


			if ($this->db->get_where("mahasiswa",["np"=>$_POST['np']])->num_rows() > 0){
				$return = array(
					'status'	=> false,
					'message'	=> 'Maaf Nomor Pokok sudah digunakan',
				); 
				echo json_encode($return);
				die();
			}
		}
		

		if($aksi == '1'){
			$id = $this->db->query("SELECT IFNULL(MAX(id)+1,1) AS max_id FROM mahasiswa")->row('max_id');
		}else{
			$id = $this->input->post('kode',true);
		}

		$password = $this->input->post('password',true);

		$data = $_POST;
		unset($data["aksi"]);
		unset($data["kode"]);
		unset($data["password"]);
		$data["last_user"] = $user_id;
		$data["id"] = $id;

		if ($aksi == '1'){
			$data["created_by"] = $user_id;
		}

		if($this->m_data->hsave('mahasiswa',$data,$id,$aksi,'id') == true){
			$this->m_data->simpan_user($id,$aksi,$email,$password,$email,'2',$_POST["nama"],'',$_POST["nohp"],'1',$id);
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

   	function simpan_loket(){
   		$user_id = $this->session->userdata('user_id'); 
		$last_update = date("Y-m-d H:i:s");
		$aksi = $this->input->post('aksi',true);
		$email = $this->input->post('email',true);

		// cek email
		if ($aksi == '1'){
		if ($this->db->get_where("users",["email"=>$email])->num_rows() > 0){
			$return = array(
				'status'	=> false,
				'message'	=> 'Maaf Email sudah digunakan',
			); 
			echo json_encode($return);
			die();
		}
		}

		if($aksi == '1'){
			$id = $this->db->query("SELECT IFNULL(MAX(id)+1,1) AS max_id FROM tbl_loket")->row('max_id');
		}else{
			$id = $this->input->post('kode',true);
		}

		$password = $this->input->post('password',true);

		$data = $_POST;
		unset($data["aksi"]);
		unset($data["kode"]);
		unset($data["password"]);
		$data["last_user"] = $user_id;
		$data["id"] = $id;

		if ($aksi == '1'){
			$data["created_by"] = $user_id;
		}

		if($this->m_data->hsave('tbl_loket',$data,$id,$aksi,'id') == true){
			$this->m_data->simpan_user($id,$aksi,$email,$password,$email,'5',$_POST["nama"],'',$_POST["nohp"],'1',$id);
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

   	function simpan_jurusan(){
   		$user_id = $this->session->userdata('user_id'); 
		$last_update = date("Y-m-d H:i:s");
		$aksi = $this->input->post('aksi',true);
		if($aksi == '1'){
			$id = $this->db->query("SELECT IFNULL(MAX(id)+1,1) AS max_id FROM tbl_jurusan")->row('max_id');
		}else{
			$id = $this->input->post('kode',true);
		}

		$data = $_POST;
		unset($data["aksi"]);
		unset($data["kode"]);
		$data["last_user"] = $user_id;
		$data["id"] = $id;

		if($this->m_data->hsave('tbl_jurusan',$data,$id,$aksi,'id') == true){
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

   	function simpan_judul_seminar(){
   		$user_id = $this->session->userdata('user_id'); 
		$last_update = date("Y-m-d H:i:s");
		$aksi = $this->input->post('aksi',true);
		if($aksi == '1'){
			$id = $this->db->query("SELECT IFNULL(MAX(id)+1,1) AS max_id FROM tbl_jdl_seminar")->row('max_id');
		}else{
			$id = $this->input->post('kode',true);
		}

		$data = $_POST;
		unset($data["aksi"]);
		unset($data["kode"]);
		$data["last_user"] = $user_id;
		$data["id"] = $id;

		if($this->m_data->hsave('tbl_jdl_seminar',$data,$id,$aksi,'id') == true){
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

	public function berkas(){

		$a['table'] = $this->m_berkas->getTable()->result();
		$a['page'] 		= 'admin/master/input_berkas';
		$a['title'] 	= 'Input Berkas';
		$a['title_nav_3'] = 'Admin';
		$a['title_nav_2'] = 'Master';
		$a['title_nav_1'] = 'Input Berkas';
		$this->load->view('admin/index',$a);
	}

	public function berkas_upload(){
		
		if(!empty($_FILES['berkas'])){
				$fild = $this->input->post('fild');
				$dir = 'b_'.$fild.'/';
				$config['upload_path'] = './assets/berkas/'.$dir;
				$config['allowed_types'] = 'doc|docx|pdf';
				$this->upload->initialize($config);
				if($this->upload->do_upload('berkas')){
				
				// $this->load->library('upload', $config);
				
				$berkas = $this->upload->data();
				$sender = $this->session->userdata('username');
				$tanggal = date('Y-m-d H:i:s');
				
				$nama_berkas = $berkas['file_name'];

				$data = array(
					'nama_file' => $nama_berkas,
					'tanggal_upload' => $tanggal,
					'pengirim' =>  $sender
				);

				$table = 'b_'.$fild;
				$response_array['status'] = 'sukses';
				 echo 'sukses';
				$this->m_berkas->berkas_upload($data, $table);
			}else{
				echo 'gagal';
			}
			
		}	


	}
}
/* End of file Master.php */
/* Location: ./application/controllers/Master.php */