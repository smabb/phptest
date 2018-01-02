<?php
/**
 * Run PHP Code
 * 
 * This script gives you the ability to quickly test snippets of PHP code locally.
 *
 * @copyright  Copyright 2011-2014, Website Duck LLC (http://www.websiteduck.com)
 * @link       http://github.com/websiteduck/Run-PHP-Code Run PHP Code
 * @license    MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
 
//This application is meant to be run locally and should not be made publicly accessible.
if (!in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) die();

define('NL', PHP_EOL);
function u(&$v, $default = null) { return isset($v) ? $v : $default; }
function ua($array, $key, $default = null) { return isset($array[$key]) ? $array[$key] : $default; }

if (isset($_POST['runphp_data'])) {
	$runphp = json_decode($_POST['runphp_data']);

	if ($runphp->action === 'download') {
		if (substr($runphp->filename, -4) !== '.php') $runphp->filename .= '.php';
		header('Content-Type: text/plain');
		header('Content-Disposition: attachment; filename=' . $runphp->filename);
		echo $runphp->code;
		die();
	}

	if ($runphp->action == 'run') {
		header('Expires: Mon, 16 Apr 2012 05:00:00 GMT');
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); 
		header('Cache-Control: no-store, no-cache, must-revalidate'); 
		header('Cache-Control: post-check=0, pre-check=0', false);
		header('Content-Type: text/html; charset=utf-8');
		header('Pragma: no-cache');
		header('X-XSS-Protection: 0');
		ini_set('display_errors', 1);
		switch ($runphp->settings->error_reporting)
		{
			case 'fatal': error_reporting(E_ERROR | E_PARSE | E_COMPILE_ERROR); break;
			case 'warning': error_reporting(E_ERROR | E_PARSE | E_COMPILE_ERROR | E_WARNING); break;
			case 'deprecated': error_reporting(E_ERROR | E_PARSE | E_COMPILE_ERROR | E_WARNING | E_DEPRECATED | E_USER_DEPRECATED); break;
			case 'notice': error_reporting(E_ERROR | E_PARSE | E_COMPILE_ERROR | E_WARNING | E_DEPRECATED | E_USER_DEPRECATED | E_NOTICE); break;
			case 'all': error_reporting(-1); break;
			case 'none': default: error_reporting(0); break;
		}
		$runphp->code = '?>' . ltrim($runphp->code);
		ob_start();
		eval($runphp->code);
		$runphp->html = ob_get_clean();
		if (u($runphp->settings->pre_wrap) === true) $runphp->html = '<pre>' . $runphp->html . '</pre>';
		if (u($runphp->settings->colorize) === true) $runphp->html = '
			<style>
			html {	width: 100%; background-color: ' . $runphp->bgcolor . ';	color: ' . $runphp->color . '; }
			.xdebug-error th { background-color: #' . $runphp->bgcolor . '; font-weight: normal; font-family: sans-serif; }
			.xdebug-error td { color: ' . $runphp->color . '; }
			.xdebug-error th span { background-color: ' . $runphp->bgcolor . ' !important; }
			</style>' . $runphp->html;
		echo $runphp->html;
		die();
	}
}
else {
	header('Content-Type: text/html; charset=utf-8');
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Run PHP Code</title>
		<link rel="shortcut icon" href="favicon.ico" >
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/run_php_code.css">
	</head>
	<body>	
		<div id="root"></div>
		<script type="text/javascript" src="js/ace/ace.js"></script>
		<script type="text/javascript" src="dist/run_php_code.js"></script>
	</body>
</html>