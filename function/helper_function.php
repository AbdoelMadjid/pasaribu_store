<?php

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