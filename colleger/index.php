<?php 
session_start();
error_reporting(0);
include "koneksi.php";
	if ($_SESSION["login"]==''){
		include "flats_login.php";
	}else{
		include "routing.php";
	}
?>