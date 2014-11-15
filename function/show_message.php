<?php

	function errorMassage() {		
		$message = array("msg" => "Gagal");
		json_encode($message, true);
		print_r(json_encode($message, true));		//Informasi yg dikirimkan kepada client
	}

?>