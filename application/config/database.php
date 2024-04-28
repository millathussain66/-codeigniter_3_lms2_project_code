<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;
$db['database_two']['dsn'] = '';
$db['database_two']['hostname'] = '192.168.3.212';
$db['database_two']['port'] = '3306';
$db['database_two']['username'] = 'enayet';
$db['database_two']['password'] = 'enayet@123';
$db['database_two']['database'] = 'db_csms_brac';
$db['database_two']['dbdriver'] = 'mysqli';
$db['database_two']['dbprefix'] = '';
$db['database_two']['pconnect'] = TRUE;
$db['database_two']['db_debug'] = FALSE;
$db['database_two']['cache_on'] = FALSE;
$db['database_two']['cachedir'] = '';
$db['database_two']['char_set'] = 'utf8';
$db['database_two']['dbcollat'] = 'utf8_general_ci';
$db['database_two']['swap_pre'] = '';
$db['database_two']['autoinit'] = TRUE;
$db['database_two']['stricton'] = FALSE;
$db['default'] = array(
	 'dsn'	=> '',
	'hostname' => '192.168.3.225',
	'username' => 'mmtv',
	'password' => 'Mmtv@123',
	'port' => '3306',
	'database' => 'lms_bbl',
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

$db['oracle']['username'] = "LMS02";
$db['oracle']['password'] = "Lm$$#123s";
$db['oracle']['hostname'] = "(DESCRIPTION =(ADDRESS_LIST =(ADDRESS =(PROTOCOL = TCP)(HOST = 172.25.15.45)(PORT = 1522)))(CONNECT_DATA =(SID = bosprod)(SERVER = DEDICATED)))";
$db['oracle']['dbdriver'] = 'oci8';
$db['oracle']['dbprefix'] = '';
$db['oracle']['pconnect'] = TRUE;
$db['oracle']['db_debug'] = FALSE;
$db['oracle']['cache_on'] = FALSE;
$db['oracle']['cachedir'] = '';
$db['oracle']['char_set'] = 'utf8';
$db['oracle']['dbcollat'] = 'utf8_general_ci';
$db['oracle']['swap_pre'] = '';
$db['oracle']['autoinit'] = TRUE;
$db['oracle']['stricton'] = FALSE;


$db['oracle2']['username'] = "easypay";
$db['oracle2']['password'] = "easy123";
$db['oracle2']['hostname'] = "(DESCRIPTION =(ADDRESS_LIST =(ADDRESS =(PROTOCOL = TCP)(HOST = 192.168.3.213)(PORT = 1521)))(CONNECT_DATA =(SID = orceasypay)(SERVER = DEDICATED)))";
$db['oracle2']['dbdriver'] = 'oci8';
$db['oracle2']['dbprefix'] = '';
$db['oracle2']['pconnect'] = TRUE;
$db['oracle2']['db_debug'] = FALSE;
$db['oracle2']['cache_on'] = FALSE;
$db['oracle2']['cachedir'] = '';
$db['oracle2']['char_set'] = 'utf8';
$db['oracle2']['dbcollat'] = 'utf8_general_ci';
$db['oracle2']['swap_pre'] = '';
$db['oracle2']['autoinit'] = TRUE;
$db['oracle2']['stricton'] = FALSE;
