<?php
session_start();
error_reporting(0);
include "config.php";
include "../cms/koneksi.php";

if ($_SESSION["login"] != true) {
	include "flats_login.php";
} else {
	include "routing.php";
}
