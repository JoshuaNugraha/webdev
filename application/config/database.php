<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	
	// 'hostname' => 'booblestudio.com',
	// 'username' => 'u1507805_yusril',
	// 'password' => 'Boobleid.01',
	// 'database' => 'u1507805_ptk',

	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'u1507805_ptk',

	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
