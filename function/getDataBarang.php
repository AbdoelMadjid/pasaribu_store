<?php 
	include("koneksi.php");
	include("validate_string.php");
	
	$receive = "NULL";
	
	$FILTER_FIELD_NAME 	= "nama_barang";
	$TABLE_BARANG 		= "barang";
	$LIMIT_DATA			= 50;
	$FIELD_ID_BARANG	= "id_barang";
	$FIELD_ID_USER		= "id_user";
	$FIELD_NAMA_BARANG	= "nama_barang";
	
	$header_data_size	= "DATA_SIZE";
	$header_barang		= "BARANG";
	$header_query		= "QUERY";
	$header_receive_data= "RECEIVE_DATA";
	
	if( isset( $_GET['q'] ) ) {
		//Mencari data barang
		$searchKey = $_GET['q'];
		
		$QUERY = sprintf("SELECT * FROM %s WHERE %s LIKE  '%%%s%%' LIMIT %s ", 
					  $TABLE_BARANG, 
					  $FILTER_FIELD_NAME,
					  $searchKey, 
					  $LIMIT_DATA );
		
	} else if( isset( $_POST['id_user'] ) ) {
		//Permintaan normal, mengambil data barang sesuai id_user aktif
		
		$id_user = $_POST['id_user'];
		
		$QUERY = sprintf("SELECT * FROM %s WHERE %s = %d LIMIT %d", 
					  $TABLE_BARANG, 
					  $FIELD_ID_USER, $id_user,
					  $LIMIT_DATA );
		
		$receive = mysql_escape_string( json_encode($_POST) );
	
	} else if( isset( $_POST['id_barang'] ) && isset( $_POST['id_user'] ) ) {
		//permintaan spesifik utk data barang dengan id_barang ini.
		
		$id_barang = $_POST['id_barang'];
		$id_user = $_POST['id_user'];
		
		$QUERY = sprintf("SELECT * FROM %s WHERE %s = %d AND %s = $d LIMIT %d", 
					  $TABLE_BARANG, 
					  $FIELD_ID_BARANG, $id_barang,
					  $FIELD_ID_USER, $id_user,
					  $LIMIT_DATA );
		
		$receive = mysql_escape_string( json_encode($_POST) );
	
	} else {
		//Utk keperluan percobaan, hapus utk produksi
		$QUERY = sprintf("SELECT * FROM %s LIMIT %d", $TABLE_BARANG, $LIMIT_DATA );
	}
	
	$dataTable = array();
	
	$q = mysql_query($QUERY);
	
	if(!$q) {
		$message = array("msg" => "Gagal $QUERY");
		json_encode($message, true);
		print_r(json_encode($message, true));		//Informasi yg dikirimkan kepada client
		return;
	}
	
	// Cara Simpel make mysql_fetch_object
	while($data = mysql_fetch_object($q)){
		$dataTable[] = $data; 
	}
	
	$data_size = sizeof($dataTable);
	
	header('Content-type: application/json');
	
	//Final data will send to client side
	$data = sprintf('
	{  
	"%s" : %s , 
	"%s" : %d , 
	"%s" : "%s", 
	"%s" : "%s" 
	} ', 				 
		$header_barang, json_encode($dataTable, true), 
		$header_data_size, $data_size, 
		$header_query, $QUERY, 
		$header_receive_data, $receive 
	);

	print_r($data);		//Informasi yg dikirimkan kepada client		

?>