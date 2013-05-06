<?php
session_start();

$exceptions = array('register', 'login');

$page = substr(end(explode('/',$_SERVER['SCRIPT_NAME'])), 0, -4);

if(in_array($page, $exceptions) === false) {
	if(isset($_SESSION['username']) === false) {
		header('Location: login.php');
		die();

	}
}
mysql_connect('127.0.0.1','root', 'iloveyou') or die("Cannot connect to Mysql.");
mysql_select_db('user_system') or die ("Could not chosen data base");

$path = dirname(__FILE__);

include("{$path}/inc/user.inc.php");
?>
