<?php
$harga = "Rp 1.000";
$harga_str = preg_replace("/[^0-9]/", "", $harga);
var_dump($harga_str);
$harga_int = (int) $harga_str;
var_dump($harga_int);
