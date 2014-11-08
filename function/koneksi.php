<?php
	$HOST = "localhost";
	$ROOT = "root";
	$PASSWORD = "root";
	$DB_NAME = "pasaribu_store";
	
    $koneksi = mysql_connect($HOST,$ROOT,$PASSWORD) or die (mysql_error() . "<br>Gagal koneksi ke server !!");
	$database = mysql_select_db($DB_NAME) or die(mysql_error() . "<br>Gagal memilih database !!");
	
?>
