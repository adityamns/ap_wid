<?php
ini_set('date.timezone', 'Asia/jakarta');

// Use an autoloader
define('CORE', 'siak_libraries/');
require CORE.'Siak_bootstrap.php';
require CORE.'Siak_controller.php';
require CORE.'Siak_view.php';
require CORE.'Siak_model.php';
require CORE.'Siak_database.php';
require CORE.'Siak_session.php';
require CORE.'Siak_js.php';
require CORE.'Siak_validation.php';
require CORE.'Siak_paginator.php';
require CORE.'Siak_breadcrumbs.php';
require CORE.'Siak_uri.php';
require CORE.'Siak_Encode.php';
require CORE.'passwordLib.php';
require CORE.'PHPExcel.php';
require CORE.'PHPMailerAutoload.php';
require CORE.'Siak_Encryption.php';
// require CORE.'Siak_datatable.php';

// Libraries
define('CONFIG', 'siak_config/');
require CONFIG.'siak_database.php';
require CONFIG.'siak_paths.php';

$system_path = 'siak_libraries';
if (realpath($system_path) !== FALSE)
{
	$system_path = realpath($system_path).'/';
}

// ensure there's a trailing slash
$system_path = rtrim($system_path, '/').'/';

// Is the siak_system path correct?
if ( ! is_dir($system_path))
{
	exit("Your system folder path does not appear to be set correctly. Please open the following file and correct this: ".pathinfo(__FILE__, PATHINFO_BASENAME));
}

// Path to the siak_system folder
define('SIAK_SYSTEM', str_replace("\\", "/", $system_path));
// echo str_replace("\\", "/", $system_path);

$siak_app = new Siak_bootstrap();


?>