<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			{
				redirect('auth/login');
			}
		}
		$this->load->model('m_data');
	}
	
	function index()
	{
		$a['page'] 		= 'admin/users';
		$a['title'] 	= 'Users';
		$a['title_nav_3'] = '';
		$a['title_nav_2'] = 'Admin';
		$a['title_nav_1'] = 'Users';
		$a['otori'] = '1';
		$this->load->view('admin/index',$a);
	}
	function apoteker()
	{
		$a['page'] 		= 'admin/users';
		$a['title'] 	= 'Apoteker';
		$a['title_nav_3'] = '';
		$a['title_nav_2'] = 'Users';
		$a['title_nav_1'] = 'Apoteker';
		$a['otori'] = '2';
		$this->load->view('admin/index',$a);
	}
	function pasien()
	{
		$a['page'] 		= 'admin/users';
		$a['title'] 	= 'Pasien';
		$a['title_nav_3'] = '';
		$a['title_nav_2'] = 'Users';
		$a['title_nav_1'] = 'Pasien';
		$a['otori'] = '3';
		$this->load->view('admin/index',$a);
	}


	/* ---------- CRUD DAFTAR PENGGUNA ------------ */
	public function get_pengguna() {

      $query = $this->db->select(array('a.id','a.first_name','a.last_name','c.name','a.username','a.pass_text','a.email','a.phone','a.active','c.description as group'))->from('users a')
      ->join("users_groups b","a.id=b.user_id","left")
      ->join("groups c","b.group_id=c.id","left");

      $column_order = array(null, 'a.first_name','c.id','a.username','a.pass_text','a.email','c.description','a.active'); //set column field database for datatable orderable
	  $column_search = array('a.first_name','a.last_name','a.username','a.pass_text','a.email','a.phone'); //set column field database for datatable searchable 
      $order = array('a.id' => 'desc'); // default order

      $list = $this->m_data->get_datatables($query, $column_order, $column_search, $order);
      $data = array();
		$no = $_POST['start'];
		foreach ($list['result'] as $rowi) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $rowi->first_name . ' '.$rowi->last_name ;
			$row[] = $rowi->name;
			$row[] = $rowi->username;
			$row[] = $rowi->pass_text;
			
			$kontak = '<i class="fa fa-envelope"></i> '.$rowi->email;
			if($rowi->phone != '' && $rowi->phone != null){
				$kontak .= '<br><i class="fa fa-phone"></i> '.$rowi->phone;
			}

			$row[] = $kontak;

			if($rowi->active == '1'){
				$row[] = '<select class="form-control" onchange="update_status(\''.$rowi->id.'\');return false;" id="status_user_'.$rowi->id.'"  style="width:120px;">
							<option selected value="1">Aktif</option>
							<option value="0">Non Aktif</option>
						  </select>';
			}else{
				$row[] = '<select class="form-control" onchange="update_status(\''.$rowi->id.'\');return false;" id="status_user_'.$rowi->id.'"  style="width:120px;">
							<option value="1">Aktif</option>
							<option selected value="0">Non Aktif</option>
						  </select>';
			}
			
			$row[] = '
				<a class="text-warning btn-fa" style="color:white" title="Edit" onclick="edit(\''.$rowi->id.'\')"><i class="fa fa-edit"></i></a>
				<a class="text-danger btn-fa" style="color:white" title="Hapus" onclick="hapus(\''.$rowi->id.'\',\'users\')"><i class="fa fa-trash"></i></a>
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
   	function edit_pengguna(){
		$id = $this->input->post('id');
		// $id = '21';
		$r = $this->db->query("SELECT a.*,b.group_id
			FROM users a
			LEFT JOIN users_groups b on a.id=b.user_id
			WHERE a.id='$id'");
		
		$data = array();
        foreach($r->result() as $resulte){
            $data  = array(     
				'nm_depan'    => $resulte->first_name,
				'nm_belakang' => $resulte->last_name,
				'email' 	  => $resulte->email, 
				'telp' 		  => $resulte->phone,
				'username'    => $resulte->username, 
			);
        }
		echo json_encode($data);
	
	}
	function simpan_pengguna(){
		$user_id = $this->session->userdata('user_id'); 
		$group_id = $this->session->userdata('group_id');
		$last_update = date("Y-m-d H:i:s");

		$aksi 			 = $this->input->post('aksi',true);
		$nm_depan	     = $this->input->post('nm_depan',true);
		$nm_belakang     = $this->input->post('nm_belakang',true);
		$no_hp			 = $this->input->post('telp',true);
		$username	     = $this->input->post('username',true);
		$password	     = $this->input->post('password',true);
		$id_g			 = $this->input->post('group_id',true);
		$email			 = $this->input->post('email',true);
		$status			 = $this->input->post('status',true);

		if($aksi == '1'){
			$id = $this->db->query("SELECT IFNULL(MAX(id)+1,1) AS max_id FROM users")->row('max_id');
		}else{
			$id = $this->input->post('kode',true);
		}
			
		$where_cek1 = '';
		$where_cek2 = '';
		$fid = $id;
		if($aksi == '2'){
			$data_old = $this->db->query("SELECT fid, username, email FROM users WHERE id='$id'")->row();
			$username_old = $data_old->username;
			$email_old = $data_old->email;
			$where_cek1 = "AND username<>'$username_old'";
			$where_cek2 = "AND email<>'$email_old'";
			$fid = $data_old->fid;
		}

		$cek_email = $this->db->query("SELECT count(id) as jum FROM users WHERE email='$email' $where_cek2")->row('jum');
		if($cek_email == '0'){  
			$this->m_data->simpan_user($id,$aksi,$username,$password,$email,$id_g,$nm_depan,$nm_belakang,$no_hp,$status,$id);
			$return = array(
				'status'	=> true,
				'message'	=> 'Data berhasil tersimpan..',
			);	
		}else{
			$return = array(
				'status'	=> false,
				'message'	=> 'Email sudah digunakan..',
			);
		}	
		echo json_encode($return);
	}
	function update_status_user(){
		$id = $this->input->post('id');
		$status_user = $this->input->post('status_user');
		$this->db->query("UPDATE users SET active='$status_user' WHERE id='$id'");
		echo '1';
	}
	function edit_users(){
		if($this->input->post('aksi')){
			$id = $this->session->userdata('user_id');
			$gid = $this->session->userdata('group_id');
			$uname = $this->session->userdata('username');
			$nm_depan = $this->input->post('nm_depan');
			$nm_belakang = $this->input->post('nm_belakang');
			$nm_lengkap = $nm_depan.' '.$nm_belakang;
			$alamat = $this->input->post('alamat');
			$email = $this->input->post('email');
			$nohp = $this->input->post('no_hp');
			$lp = date("Y-m-d H:i:s");
			
			
			if($gid == '2'){ // mahasiswa
			$np = 'np';
			$nip = $this->input->post('nip');
			$table = 'mahasiswa';
			}elseif($gid == '4'){ // kprodi
				$np = 'nik';
				$nip = $this->input->post('nip');
				$table = 'tbl_ketua_prodi';
			}elseif($gid == '5'){// loket
				$np = 'nik';
				$nip = $this->input->post('nip');
				$table = 'tbl_loket';
			}
			elseif($gid=='6'){ //dosen
				$np = 'nip';
				$table = 'tbl_dosen';
				$nip = $this->input->post('nip');
			}
			
			$data = array(
				'first_name' 	=> $nm_depan,
				'last_name' 	=> $nm_belakang,
				'address'		=> $alamat,			
				'phone'			=> $nohp,
				'last_update'	=> $lp	 

			);
				
		$where = array(
					'id' => $id		
		);
		if($this->input->post('password')){  //jika mengubah password
		 
			$passold = $this->input->post('passold');
			$passnew = $this->input->post('password2');
			if($this->ion_auth_model->change_password($uname, $passold, $passnew)==false){
				$respon = false;
			}else{				
				$datapass = array(
					'pass_text' => $passnew
				);
				if($this->m_data->update_users_data($data, $where)){
					$this->m_data->update_users_data($datapass, $where);
					$respon = true;
				}else{
					$respon = false;
				}
				if($gid !== '1'){
					$data2 = array(
						'nama' => $nm_lengkap,
						'nohp' => $nohp,
						 $np => $nip,
						'alamat'=> $alamat,
						'last_update'	=> $lp
					);
					$this->m_data->update_users_data_tbl($data2, $where, $table);
					$respon = true;
				}				
			}
		}else{
			if($this->m_data->update_users_data($data, $where)){
				$respon = true;
			}else{
				$respon=false;
			}
			if($gid !== '1'){
				$data2 = array(
					'nama' => $nm_lengkap,
					'nohp' => $nohp,
					 $np => $nip,
					'alamat'=> $alamat,
					'last_update'	=> $lp
				);
				if($this->m_data->update_users_data_tbl($data2, $where, $table)){
					$respon = true;
				}else{
					$respon = false;
				}
	
			}	
		}
			
		
		echo json_encode($respon);
		// print_r($respon);

		}
	}

	/* ---------- END CRUD DAFTAR PENGGUNA ------------ */


}