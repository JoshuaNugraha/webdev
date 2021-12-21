<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi extends CI_Controller {

	function __construct(){
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			{
				redirect('auth/login');
			}
		}
		$this->load->model('m_data');
	}
public function nilai_seminar(){
		$a['page'] 		= 'admin/informasi/nilai_seminar_mhs';
		$a['title'] 	= 'Nilai Seminar';
		$a['title_nav_3'] = 'Admin';
		$a['title_nav_2'] = 'Informasi';
		$a['title_nav_1'] = 'Nilai Seminar';
		$this->load->view('admin/index',$a);
}


	public function judul_yang_diterima(){
		$a['page'] 		= 'admin/informasi/judul_yang_diterima';
		$a['title'] 	= 'Judul yang diterima';
		$a['title_nav_3'] = 'Admin';
		$a['title_nav_2'] = 'Informasi';
		$a['title_nav_1'] = 'Judul yang diterima';
		$this->load->view('admin/index',$a);
	}

	public function jadwal_seminar($jenis){
		if ($jenis == "all"){
			$a['page'] 		= 'admin/informasi/jadwal_seminar_all';
			$a['title'] 	= 'Jadwal Seminar Semua Program Studi';
			$a['title_nav_3'] = 'Admin';
			$a['title_nav_2'] = 'Informasi';
			$a['title_nav_1'] = 'Jadwal Seminar Semua Program Studi';
			$a['sendiri'] = false;
		} else if ($jenis == "sendiri"){
			$a['page'] 		= 'admin/informasi/jadwal_seminar_all';
			$a['title'] 	= 'Jadwal Seminar Sendiri';
			$a['title_nav_3'] = 'Admin';
			$a['title_nav_2'] = 'Informasi';
			$a['title_nav_1'] = 'Jadwal Seminar Sendiri';
			$a['sendiri'] = true;
		}
		$this->load->view('admin/index',$a);
	}

	function nilai_mhs(){
		$user_id = $this->session->userdata('user_id'); 
		$group_id = $this->session->userdata('group_id');
		$query = $this->db->select("*")->from('tbl_data_judul')
		->where("created_by",$user_id)
		->where("status >=",2);


	      $column_order = array(); //set column field database for datatable orderable
		  $column_search = array('judul'); //set column field database for datatable searchable 
	      $order = array('id' => 'desc'); // default order

	      $list = $this->m_data->get_datatables($query, $column_order, $column_search, $order);
	      $data = array();
			$no = $_POST['start'];
			foreach ($list['result'] as $rowi) {
				$no++;
				$row = array();
				$row[] = $no;
				$row[] = $rowi->judul;
				
				$row[] = '
					<button class="btn btn-sm btn-success" title="Detail" onclick="detail(\''.$rowi->id.'\')"><i class="fa fa-eye"></i></button> <br>
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

	function nilai(){
		$id = $this->input->post("id");
		$data["data"] = $this->db->get_where("tbl_data_judul",["id"=>$id])->row();
		$this->load->view('admin/input/input_nilai2', $data);
	}

	public function berkas_list(){
		$a['page'] 		= 'admin/informasi/berkas_list';
		$a['title'] 	= 'Program Study';
		$a['title_nav_3'] = 'Admin';
		$a['title_nav_2'] = 'Master';
		$a['title_nav_1'] = 'Program Study';
		$this->load->view('admin/index',$a);
	}

	public function daftar_berkas(){
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

}

/* End of file Informasi.php */
/* Location: ./application/controllers/Informasi.php */