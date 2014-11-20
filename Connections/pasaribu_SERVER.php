<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_pasaribu_SERVER = "localhost";
$database_pasaribu_SERVER = "pasaribu_store";
$username_pasaribu_SERVER = "root";
$password_pasaribu_SERVER = "root";
$pasaribu_SERVER = mysql_pconnect($hostname_pasaribu_SERVER, $username_pasaribu_SERVER, $password_pasaribu_SERVER) or trigger_error(mysql_error(),E_USER_ERROR); 
?>