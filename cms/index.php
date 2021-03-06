<?php
session_start();
// error_reporting(0);
include "koneksi.php";
if ($_SESSION["loginAdmin"] == '') {
	include "login.php";
} else {
	include "content.php";
}
