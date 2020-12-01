<?php
session_start();
error_reporting(0);
include "config.php";
if ($_SESSION["login"] == '') {
	include "flats_login.php";
} else {
	include "flats_home.php";
}
