<?php	$host = "localhost";	$root = "root";	$password = "root";	$db_name = "pasaribu_store";	    $koneksi = mysql_connect($host,$root,$password) or die (mysql_error() . "<br>Gagal koneksi ke server !!");	$database = mysql_select_db($db_name) or die(mysql_error() . "<br>Gagal memilih database !!");	?>