<?php
// Check Version
if (version_compare(phpversion(), '5.1.0', '<') == true) {
	exit('PHP5.1+ Required');
}
// Timezone
date_default_timezone_set('PRC');

// APP_PATH
define('APP_PATH', dirname(__FILE__));

// Environment
defined('APP_ENV')  || define('APP_ENV',  'development' );

// Error Reporting
if('development' == APP_ENV){	
	error_reporting(E_ALL);
}

// Register Globals
if (ini_get('register_globals')) {
	ini_set('session.use_cookies', 'On');
	ini_set('session.use_trans_sid', 'Off');
	
	session_start();
		
	$globals = array($_REQUEST, $_SESSION, $_SERVER, $_FILES);
		
	foreach ($globals as $global) {
		foreach(array_keys($global) as $key) {
			unset(${$key}); 
		}
	}
}

// Magic Quotes Fix
if (ini_get('magic_quotes_gpc')) {
 	function clean($data) {
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				$data[clean($key)] = clean($value);
			}
		} else {
			$data = stripslashes($data);
		}
		return $data;
	}
	
	$_GET = clean($_GET);
	$_POST = clean($_POST);
	$_REQUEST = clean($_REQUEST);
	$_COOKIE = clean($_COOKIE);
}

// Windows IIS Compatibility 
if (!isset($_SERVER['DOCUMENT_ROOT'])) { 
	if (isset($_SERVER['SCRIPT_FILENAME'])) {
		$_SERVER['DOCUMENT_ROOT'] = str_replace('\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0 - strlen($_SERVER['PHP_SELF'])));
	}
}

if (!isset($_SERVER['DOCUMENT_ROOT'])) {
	if (isset($_SERVER['PATH_TRANSLATED'])) {
		$_SERVER['DOCUMENT_ROOT'] = str_replace('\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0 - strlen($_SERVER['PHP_SELF'])));
	}
}

if (!isset($_SERVER['REQUEST_URI'])) { 
	$_SERVER['REQUEST_URI'] = substr($_SERVER['PHP_SELF'], 1); 
	
	if (isset($_SERVER['QUERY_STRING'])) { 
		$_SERVER['REQUEST_URI'] .= '?' . $_SERVER['QUERY_STRING']; 
	} 
}

if (!isset($_SERVER['HTTP_HOST'])) {
	$_SERVER['HTTP_HOST'] = getenv('HTTP_HOST');
}

// Bootstrap
require_once(APP_PATH . '/system/bootstrap.php');

$app = new Bootstrap();

// User
if(!empty($_COOKIE['remeber_username'])){
	$query = $app->db->query("SELECT * FROM `" . DB_PREFIX . "user` WHERE username = '".$app->db->escape($_COOKIE['remeber_username'])."' AND status = '1'"); 
	if($query->num_rows){
		$app->session->data['user_id'] = $query->row['user_id'];
	}
}
// Application Classes
require_once(DIR_SYSTEM . 'library/user.php');
$app->registry->set('user', new User($app->registry));
						
$app->run();
?>
