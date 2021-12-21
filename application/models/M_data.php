<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	function _get_datatables_query($query, $column_order, $column_search, $order) {
    
    // $this->db->from($query);

	    $i = 0;
	 
	    foreach ($column_search as $item) // loop column 
	    {
	        if(isset($_POST['search']['value'])) {
	             
	            if ($i===0) {
	                $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
	                $this->db->like($item, $_POST['search']['value']);
	            } else {
	                $this->db->or_like($item, $_POST['search']['value']);
	            }

	            if(count($column_search) - 1 == $i) //last loop
	                $this->db->group_end(); //close bracket
	        }
	        $i++;
	    }
	     
	    if(isset($_POST['order'])) {
	        $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	    } else if (isset($order)) {
	        $this->db->order_by(key($order), $order[key($order)]);
	    }
	  }
	function get_datatables($query, $column_order, $column_search, $order) {
      $this->_get_datatables_query($query, $column_order, $column_search, $order);
      if($_POST['length'] != -1)
      $clone = clone $query;
      $this->db->limit($_POST['length'], $_POST['start']);
      $data['result'] = $query->get()->result();
      $data['count_filtered'] = $clone->get()->num_rows();
      return $data;
	}
	function get_datatables_no_limit($query, $column_order, $column_search, $order) {
      $this->_get_datatables_query($query, $column_order, $column_search, $order);
      
      $clone = clone $query;
      $data['result'] = $query->get()->result();
      $data['count_filtered'] = $clone->get()->num_rows();
      return $data;
	}
	public function count_all($query)
    {
      return $query->count_all_results();
    }

	function hsave($table,$data,$kode,$status,$pk){
		if($status=='2'){
			$this->db->where($pk, $kode);
			$this->db->update($table, $data);
			return true;
		}else{
			$this->db->insert($table, $data);
			return true;
		}
	}
	function hsave2($table,$data,$kode,$status,$pk,$pk2,$kode2){
		if($status=='2'){
			$this->db->where($pk, $kode);
			$this->db->where($pk2, $kode2);
			$this->db->update($table, $data);
			return true;
		}else{
			$this->db->insert($table, $data);
			return true;
		}
	}
	function hsave3($table,$data,$kode,$status,$pk,$pk2,$kode2,$pk3,$kode3){
		if($status=='2'){
			$this->db->where($pk, $kode);
			$this->db->where($pk2, $kode2);
			$this->db->where($pk3, $kode3);
			$this->db->update($table, $data);
			return true;
		}else{
			$this->db->insert($table, $data);
			return true;
		}
	}
	function get_edit($id,$pk,$table){
        $q = $this->db->query("select * from $table where $pk = '$id'");
		return $q->row_array();
	}

	function hapus($tabel,$field,$value){
        $del_item = $this->db->query("delete from $tabel where $field='$value'");
        return '1';
  	}
  	function load_pengaturan($field){
  		$user_id = $this->session->userdata('user_id');
  		$fid = $this->db->query("SELECT fid FROM users WHERE id='$user_id'")->row('fid');
	    $last_user = $this->db->query("SELECT last_user FROM pengguna WHERE id='$fid'")->row('last_user');

  		$data = $this->db->query("SELECT $field FROM pengaturan WHERE last_user='$last_user'")->row($field);
  		return $data;
  	}
  	function rev_date_ins($tgl){
		$t=explode("/",$tgl);
		$tanggal  =  $t[0];
		$bulan    =  $t[1];
		$tahun    =  $t[2];
		return  $tahun.'-'.$bulan.'-'.$tanggal;
	}
  	function rev_date_indo($tgl){
		if($tgl != '' && $tgl != '0000-00-00'){
			$t=explode("-",$tgl);
			$tanggal  =  $t[2];
			$bulan    =  $t[1];
			$tahun    =  $t[0];
			return  $tanggal.'/'.$bulan.'/'.$tahun;
		}else{
			return '';
		}	
	}
	function rev_date_time($tgl){
		if($tgl == '0000-00-00 00:00:00' || $tgl == null){
			return '';
		}else{
			$rev = explode(' ', $tgl);
			$t=explode("-",$rev[0]);
			$tanggal  =  $t[2];
			$bulan    =  $t[1];
			$tahun    =  $t[0];
			return  $tanggal.'/'.$bulan.'/'.$tahun.' '.$rev[1];
		}
	}
	function angka($num){
		$rev = str_replace('.', '', $num);
		return $rev;
	}
	function  tanggal_format_indonesia($tgl){   
        $tanggal  = explode('-',$tgl); 
        $bulan  = $this->getBulan2($tanggal[1]);
        $tahun  =  $tanggal[0];
        return  $tanggal[2].' '.$bulan.' '.$tahun;
    }
    function  getBulan($bln){
        switch  ($bln){
	        case  1:
	        return  "Januari";
	        break;
	        case  2:
	        return  "Februari";
	        break;
	        case  3:
	        return  "Maret";
	        break;
	        case  4:
	        return  "April";
	        break;
	        case  5:
	        return  "Mei";
	        break;
	        case  6:
	        return  "Juni";
	        break;
	        case  7:
	        return  "Juli";
	        break;
	        case  8:
	        return  "Agustus";
	        break;
	        case  9:
	        return  "September";
	        break;
	        case  10:
	        return  "Oktober";
	        break;
	        case  11:
	        return  "November";
	        break;
	        case  12:
	        return  "Desember";
	        break;
	    }
    }
    function getBulan2($bln){
        switch ($bln){
            case  1:
            return  "Jan";
            break;
            case  2:
            return  "Feb";
            break;
            case  3:
            return  "Mar";
            break;
            case  4:
            return  "Apr";
            break;
            case  5:
            return  "Mei";
            break;
            case  6:
            return  "Jun";
            break;
            case  7:
            return  "Jul";
            break;
            case  8:
            return  "Agt";
            break;
            case  9:
            return  "Sep";
            break;
            case  10:
            return  "Okt";
            break;
            case  11:
            return  "Nov";
            break;
            case  12:
            return  "Des";
            break;
        }
    }
    function hari_ini(){
		$hari = date ("D");
	 
		switch($hari){
			case 'Sun':
				$hari_ini = "Minggu";
			break;
	 
			case 'Mon':			
				$hari_ini = "Senin";
			break;
	 
			case 'Tue':
				$hari_ini = "Selasa";
			break;
	 
			case 'Wed':
				$hari_ini = "Rabu";
			break;
	 
			case 'Thu':
				$hari_ini = "Kamis";
			break;
	 
			case 'Fri':
				$hari_ini = "Jumat";
			break;
	 
			case 'Sat':
				$hari_ini = "Sabtu";
			break;
			
			default:
				$hari_ini = "Tidak di ketahui";		
			break;
		}
	 
		return $hari_ini;
	}

	function simpan_user($id="",$aksi="",$username="",$password="",$email="",$id_g="",$nm_depan="",$nm_belakang="",$no_hp="",$status="",$fid=""){
		$user_id = $this->session->userdata('user_id'); 
		$last_update = date("Y-m-d H:i:s");

		$additional_data = array(
			'first_name' => $nm_depan,
			'pass_text'  => $password,
			'last_name'  => $nm_belakang,
			'phone'		 => $no_hp,
			'last_user'	 => $user_id,
			'last_update'=> $last_update,
			'active' => $status,
			'fid' => $fid
		);

		$group = array($id_g);

		if($aksi=='1'){
			$query = $this->ion_auth->register($username, $password, $email, $additional_data, $group);
			if($query){
				if($status == '0'){
					$id_user = $this->db->query("SELECT id FROM users WHERE email='$email'")->row('id');
					$data = array(
						  'active' 		=> $status,
					);
					$query = $this->ion_auth->update($id_user, $data);
				}
				return true;
			}else{
				return false;
			}
		}else{
			$id_user = $this->db->query("SELECT id FROM users WHERE fid='$fid'")->row('id');
			if($password == ''){
				$data = array(
					  'username'	=> $username,
					  'first_name'	=> $nm_depan,
					  'last_name' 	=> $nm_belakang,
					  'email'		=> $email,
					  'phone'		=> $no_hp,
					  'active' 		=> $status,
					  'last_user'	 => $user_id,
					  'last_update'=> $last_update,
				);
			}else{
				$data = array(
					  'username'	=> $username,
					  'pass_text'	=> $password,	
					  'first_name'	=> $nm_depan,
					  'last_name' 	=> $nm_belakang,
					  'email'		=> $email,
					  'phone'		=> $no_hp,
					  'password'	=> $password,
					  'active' 		=> $status,
					  'last_user'	 => $user_id,
					  'last_update'=> $last_update,
				);
			}
			if($id_g != ''){
				$this->db->query("UPDATE users_groups SET group_id='$id_g' WHERE user_id='$id_user'");	
			}
			$query = $this->ion_auth->update($id_user, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}

	function send_mail($sender,$name_sender,$email,$subject,$message){

		$body = '
	    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta name="viewport" content="width=device-width" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>'.$subject.'</title>
		</head>
		<body style="margin:0px; background: #f8f8f8; ">
		<div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
		  <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
		    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
		      <tbody>
		        <tr>
		          <td style="vertical-align: top; padding-bottom:30px;" align="center">
		          	<a href="'.base_url().'" target="_blank"> 
		          		<h1 style="color: #276daa;text-decoration: none;line-height: 1.3;">BUMDES <br> Desa Bira Bulukumba</h1>
		          	</a>
		          </td>
		        </tr>
		      </tbody>
		    </table>
		    <div style="padding: 40px; background: #fff;">
		      <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
		        <tbody>
			      
			      <tr>
			        <td>' . $message . '<td>
			      </tr>
		          
		        </tbody>
		      </table>
		    </div>
		    <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
		      <p><a href="'.base_url().'" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0;">'.$name_sender.'</a></p>
		    </div>
		  </div>
		</div>
		</body>
		</html>
		';

	    $result = $this->email
	        ->from($sender,$name_sender)
	        ->reply_to($sender)
	        ->to($email)
	        ->subject($subject)
	        ->message($body)
	        ->send();
	    //echo $this->email->print_debugger();
	}
	function load_persen($progress){
   		if($progress < 50){
   			$html = ' <label class="badge badge-info">'.$progress.'%</label> ';
   		}elseif($progress > 50 && $progress < 80){
   			$html = ' <label class="badge badge-warning">'.$progress.'%</label> ';
   		}else{
   			$html = ' <label class="badge badge-success">'.$progress.'%</label> ';
   		}
   		return $html;
   	}

   	public function upload_gambar_base64($gambar,$dir){
	  $arrGbr = [];
	  if ($gambar){
	   $img = explode('|', $gambar);
	      for ($i = 0; $i < count($img) - 1; $i++) {
	       if (strpos($img[$i], 'data:image/jpeg;base64,') === 0) {
	       $img[$i] = str_replace('data:image/jpeg;base64,', '', $img[$i]);  
	       $ext = '.jpg';
	       }
	       if (strpos($img[$i], 'data:image/png;base64,') === 0) { 
	       $img[$i] = str_replace('data:image/png;base64,', '', $img[$i]); 
	       $ext = '.png';
	       }
	       if (strpos($img[$i], '[removed]') === 0){
	       $img[$i] = str_replace('[removed]', '', $img[$i]); 
	       $ext = '.jpg';
	      }
	      $name = 'IMG'.date("YmdHis").$ext;
	      $img[$i] = str_replace(' ', '+', $img[$i]);
	      $dimg = base64_decode($img[$i]);
	      $file = $dir.$name;
	      if (file_put_contents($file, $dimg)) {
	       $arrGbr[] = $name;
	      }
	     }
	    }

	  $filedGambar = $this->arr_to_str($arrGbr);

	  return $filedGambar;
	}

	public function arr_to_str($arr) {
	  $str = "";
	  $i=0;
	  while ( $i < count($arr)) { 
	   if ($arr[$i] != ""){

	    $str .= $arr[$i];
	     $i++;
	    if ($i < count($arr)){
	     $str .= ",";
	    }
	   } else {
	    $i++;
	   }
	  }
	  return $str;
	}

	function save_log($data,$tabel,$id_data,$ref,$aksi){
		$user_id = $this->session->userdata('user_id'); 
		$last_update = date("Y-m-d H:i:s");

		$cdata = array(
			'tgl'=> $last_update,
			'id_user' => $user_id,

			'data' => $data,
			'tabel' => $tabel,
			'id_data' => $id_data,
			'ref' => $ref,
			'aksi' => $aksi
		);
		$this->db->insert('log_users', $cdata);
		return true;
	}

	function get_noref($tabel,$kode,$tgl){
		$bln = date("m",strtotime($tgl));
		$thn = date("y",strtotime($tgl));
		$cthn = date("Y",strtotime($tgl));
		$max = $this->db->query("SELECT lpad(IFNULL(MAX(RIGHT(noref,5))+1,1),5,0) AS noref FROM $tabel
			WHERE month(tgl)='$bln' and year(tgl)='$cthn'")->row('noref');
		
		return $kode.'/'.$bln.'/'.$thn.'/'.$max;
	}

	function get_max_tiket($nm_tiket){
		$hari_ini = date('Y-m-d');
		$max = $this->db->query("SELECT lpad(ifnull(MAX(noref),0)+1,4,0) AS noref 
			FROM tiket_jual
			WHERE date(tgl)='$hari_ini' and nm_tiket='$nm_tiket'")->row('noref');
		
		return $max;
	}

	function cek_token($token){
		$data = $this->db->query("SELECT id_user FROM token WHERE token='$token'");
		if($data->num_rows() == 0){
			return false;
		}else{
			return $data->row('id_user');
		}
	}

	function get_pengguna($user_id){
		$pengguna = $this->db->query("SELECT a.* FROM pengguna a
            LEFT JOIN users b on a.id=b.fid
            WHERE b.id='$user_id'")->row();
		return $pengguna;
	}

	function get_user_data($table, $where){
		return $this->db->get_where($table,$where);
	}
	
	function update_users_data($data, $where){
	
		$this->db->where($where);
		$this->db->update('users', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
		
	 		

	}
	function update_users_data_tbl($data2, $where, $table){
		$uid = array( 'uid' => $where['id']);
		// update users table
		$this->db->where($uid);
		$this->db->update($table, $data2);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
		
	 
	}

	function get_role($table , $where){
		return $q = $this->db->get_where($table, $where);
		
	}	
	function i_nilai($q){
	    $w =  "pembimbing1='$q' OR pembimbing2='$q' OR penguji1='$q' OR penguji2='$q' OR penguji3='$q'";
		return $this->db->get_where('tbl_data_judul', $w)->result();
	}
	
} 	