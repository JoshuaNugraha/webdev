<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			{
				redirect('auth/login');
			}
		}
		$this->load->model('m_data');
	}
	public function get_csrf()
	{
		$error['csrf_token'] = $this->security->get_csrf_hash();
		echo json_encode($error);
		die();
	}
	function index()
	{
		$a['page'] 		= 'admin/main';
		$a['title'] 	= 'Dashboard'; 
		$a['title_nav_3'] = '';
		$a['title_nav_2'] = '';
		$a['title_nav_1'] = 'Dashboard';
		$this->load->view('admin/index',$a);
	}



	function profile()
	{	
		$uid = $this->session->userdata('user_id');		 
		$gid = $this->session->userdata('group_id');

		if($gid == 2){
			$nip = 'np';
			$table = 'mahasiswa';
		}elseif($gid == 6){
			$nip = 'nip';
			$table = 'tbl_dosen';
		}elseif($gid == 5){
			$nip ='nik';
			$table = 'tbl_loket'			;
		}elseif($gid == 4){
			$nip = 'nik';
			$table = 'tbl_ketua_prodi';
		}
		if($gid != 1){
			$r = $this->db->query("SELECT a.*,b.group_id, c.* FROM users as a INNER JOIN users_groups as b ON a.id=b.user_id
			INNER JOIN $table as c ON a.id=c.uid 
			WHERE a.id = $uid");		
			foreach($r->result() as $resulte){
				
				$a['data']  = array(
					'nm_depan'    => $resulte->first_name,
					'nm_belakang' => $resulte->last_name,
					'email' 	  => $resulte->email, 
					'telp' 		  => $resulte->phone,
					'username'    => $resulte->username, 
					'password'    => $resulte->pass_text,
					'nip' 		  => $resulte->$nip,
					'pass'		  => $resulte->pass_text,
					'alamat'	  => $resulte->address				
				);	
			} 
			
		}else{
			$r = $this->db->query("SELECT * FROM users WHERE id=$uid");
			foreach($r->result() as $resulte){
				
				$a['data']  = array(
					'nm_depan'    => $resulte->first_name,
					'nm_belakang' => $resulte->last_name,
					'email' 	  => $resulte->email, 
					'telp' 		  => $resulte->phone,
					'username'    => $resulte->username, 
					'password'    => $resulte->pass_text,
					
					'pass'		  => $resulte->pass_text,
					'alamat'	  => $resulte->address				
				);	
			} 
		}
		
		$a['gid'] = $gid;
		$a['page'] 		= 'admin/profile';
		$a['title'] 	= 'Profile';
		$a['title_nav_3'] = '';
		$a['title_nav_2'] = '';
		$a['title_nav_1'] = 'Profile';
		$this->load->view('admin/index',$a);

		
	}

	function hapus(){
		$value = $this->input->post('id');
		$tabel = $this->input->post('tabel');
		$field = $this->input->post('field');

		$file_field = $this->input->post('file_field');
		$folder_file = $this->input->post('folder_file');
		if($file_field != '' && $folder_file != '' && $tabel != 'penginapan'){
			$data_file = $this->db->query("SELECT $file_field FROM $tabel WHERE $field='$value'")->row($file_field);
				
				if($data_file != '' && $data_file != null){
					$cek_file = file_exists($folder_file.$data_file);
					if($cek_file == '1'){
						unlink($folder_file.$data_file);
					}
				}
		}

		$data = $this->m_data->hapus($tabel,$field,$value);
		if($data){
			if($tabel == 'emr_h'){
				$this->db->query("DELETE FROM riwayat_pengobatan WHERE id_emr='$value'");
			}
			$return = array(
				'status'	=> true,
				'message'	=> 'Data Berhasil Dihapus..',
			);
		}else{
			$return = array(
				'status'	=> false,
				'message'	=> 'Terjadi kesalahan..',
			);
		}
		echo json_encode($return);
	}

	function edit(){
		$primary = $this->input->post('primary');
		$id = $this->input->post('id');
		$table = $this->input->post('table');
		if($primary != '' && $primary != null){
			$data = $this->m_data->get_edit($id,$primary,$table);
		}else{
			$data = $this->m_data->get_edit($id,'id',$table);
		}
		
		echo json_encode($data);
	}

}