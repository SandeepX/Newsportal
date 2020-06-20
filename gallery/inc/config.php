<?php

/**
 * @Author: Sandesh Bhattarai
 * @Date:   2018-06-04 07:20:16
 * @Last Modified by:   Sandesh Bhattarai
 * @Last Modified time: 2018-06-04 07:58:50
 */
ob_start();

if($_SERVER['SERVER_ADDR'] == '127.0.0.1' || $_SERVER['SERVER_ADDR'] == '::1'){
	define('ENVIRONMENT','DEVELOPEMENT');
} else {
	define('ENVIRONMENT', 'PRODUCTION');
}

if(ENVIRONMENT == 'DEVELOPEMENT'){
	define('SITE_URL', 'http://newsportal.mor/');


	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'newsportal');

} else {
	error_reporting(0);
	define('SITE_URL', 'http://mynews.com/');

	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'newsportal');

}

//define('NEWSPORTAL_URL', SITE_URL.'newsportal/');

define('ADMIN_URL',SITE_URL.'admin/');
define('ASSETS_URL', SITE_URL.'assets/');
define('CSS_URL', ASSETS_URL.'css/');
define('JS_URL', ASSETS_URL.'js/');
define('FONT_AWESOME_URL', ASSETS_URL.'fonts/font-awesome/');
define('BOOTSTRAP_URL', ASSETS_URL.'fonts/bootstrap/');



define('ALLOWED_EXTENSION', array('jpg','jpeg','png', 'gif'));

define("UPLOAD_DIR", $_SERVER['DOCUMENT_ROOT'].'upload/');
define('UPLOAD_URL', SITE_URL.'upload/');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die('Error establishing database connection.');
mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));
mysqli_query($conn, "SET NAMES utf8");	//For Unicode character