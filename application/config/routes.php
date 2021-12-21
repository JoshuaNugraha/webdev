<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'admin';
$route['get_token'] = 'admin/get_csrf';
$route['get_token_client'] = 'account/get_csrf';

$route['login'] = 'auth/login';
$route['dashboard'] = 'admin';
$route['profile'] = 'admin/profile';

// Master
$route['master-prodi'] = 'master/judul_seminar';
$route['master-ketua-prodi'] = 'master/ketua_prodi';
$route['master-loket'] = 'master/loket';
$route['master-mahasiswa'] = 'master/mahasiswa2';
$route['master-dosen'] = 'master/dosen';
$route['master-persyaratan-ujian'] = 'master/persyaratan_ujian';
$route['verifikasi-judul-mahasiswa'] = 'verifikasi/verifikasi_judul_mahasiswa';
$route['input-berkas'] = 'master/berkas';


$route['judul-yang-ditawarkan'] = 'input/judul_yang_ditawarkan';
$route['persyaratan-ujian'] = 'input/persyaratan_ujian';
$route['verifikasi-persyaratan'] = 'input/verifikasi_persyaratan';
$route['persuratan'] = 'input/persuratan';


$route['jadwal-seminar-semua-prodi'] = 'informasi/jadwal_seminar/all';
$route['jadwal-seminar-sendiri'] = 'informasi/jadwal_seminar/sendiri';
$route['judul-yg-diterima'] = 'informasi/judul_yang_diterima';
$route['nilai-seminar'] = 'informasi/nilai_seminar';
$route['daftar-berkas'] = 'informasi/berkas_list';

$route['rekap-nilai-mahasiswa'] = 'laporan/lap_rekap_nilai_setiap_mahasiswa';


$route['pendaftaran-seminar'] = 'pendaftaran/pendaftaran_seminar';

$route['input-nilai-seminar'] = 'input/input_nilai_seminar';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
