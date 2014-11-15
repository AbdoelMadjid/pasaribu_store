<?php 
	include("koneksi.php");
	include("show_message.php");
	header('Content-type: application/json');
	

	$TABLE_PENJUAL 	= "penjual";
	$TABLE_MEREK		= "merek";
	$LIMIT_DATA		= 10;
	
	$header_returned_data_penjual = "SUPPLIER";
	$header_returned_data_merek = "BRAND";
	
	
	$QUERY_PENJUAL = sprintf("SELECT * FROM %s", $TABLE_PENJUAL); 
	$QUERY_MEREK = sprintf("SELECT * FROM %s", $TABLE_MEREK); 

		
	//Array utk menampung data dari database
	$data_penjual = array();
	$data_merek = array();
	
	$data_penjual = getMySQLData($QUERY_PENJUAL); //Fungsi getMySQLData mengembalikan Array
	$data_merek = getMySQLData($QUERY_MEREK);
	
	//Jika array yag dikembalikan salah satu data == null, tampilkan pesan error.
	if($data_penjual == null || $data_merek == null) {
		errorMassage();
		return;
	}

	//Final data will send to client side
	$data = sprintf(
		'{ 
		"%s" : %s , 
		"%s" : %s 
		} ', 
			$header_returned_data_penjual, json_encode($data_penjual, true), 
			$header_returned_data_merek, 	 json_encode($data_merek, true)
	);		

	print_r($data);		//Informasi yg dikirimkan kepada client	


	
	//Mengembalikan array data sesuai quaery yang di minta
	function getMySQLData($query_string) {
		
		//Array utk menampung data dari database
		$dataTable = array();

		$q = mysql_query($query_string);
		
		if($q) {
			
			// Cara Simpel make mysql_fetch_object
			while($data = mysql_fetch_object($q)){
				$dataTable[] = $data; 
			}
			
			return $dataTable;
			
		} else {
			return null;
		}			
		
	}	

?>