<?php 
	include("koneksi.php"); 
	include("show_message.php");
	header('Content-type: application/json');
	
	$receive = "NULL";
	$last_id = 0;
	
	$TABLE_BARANG 		= "barang";
	$QUERY_INSERT_BARANG ="";
	
	$header_last_inserted_id = "LAST_INSERTED_ID";
	$header_data_size	= "DATA_BARANG_SIZE";
	$header_query		= "QUERY";
	$header_receive_data= "RECEIVE_DATA";
	
	if( isset( $_POST['id_user'] ) || isset( $_POST['id_penjual'] ) || isset( $_POST['id_gambar'] ) ) {
		
		$receive = mysql_escape_string( json_encode($_POST) );
		
		$id_user = mysql_escape_string($_POST['id_user']);
		$id_merek = mysql_escape_string($_POST['id_merek']);
		$id_penjual = mysql_escape_string($_POST['id_penjual']);
		$id_gambar = mysql_escape_string($_POST['id_gambar']);
		$nama_barang = mysql_escape_string($_POST['nama_barang']);
		$stok_barang = mysql_escape_string($_POST['stok_barang']);
		$satuan_barang = mysql_escape_string($_POST['satuan_barang']);
		$harga_barang = mysql_escape_string($_POST['harga_barang']);
		$tgl_harga_stok_barang = mysql_escape_string($_POST['tgl_harga_stok_barang']);
		$kode_barang = mysql_escape_string($_POST['kode_barang']);
		$lokasi_barang = mysql_escape_string($_POST['lokasi_barang']);
		$kategori_barang = mysql_escape_string($_POST['kategori_barang']);
		$deskripsi_barang = mysql_escape_string($_POST['deskripsi_barang']);
		$favorite = mysql_escape_string($_POST['favorite']);			
		
		$QUERY_INSERT_BARANG = sprintf("INSERT INTO %s (`id_barang`, `id_user`, `id_merek`, `id_penjual`, `id_gambar`, `nama_barang`, `stok_barang`, `satuan_barang`, `harga_barang`, `tgl_harga_stok_barang`, `kode_barang`, `lokasi_barang`, `kategori_barang`, `deskripsi_barang`, `favorite`) VALUES (NULL, '%d', '%d', '%d', '%d', '%s', '%d', '%s', '$d', '%s', '%s', '%s', '%s', '%s', '%d')", 
								 $TABLE_BARANG,
								 $id_user, 
								 $id_merek, 
								 $id_penjual, 
								 $id_gambar, 
								 $nama_barang, 
								 $stok_barang, 
								 $satuan_barang,
								 $harga_barang,
								 $tgl_harga_stok_barang,
								 $kode_barang,
								 $lokasi_barang,
								 $kategori_barang,
								 $deskripsi_barang,
								 $favorite								 
								);
		
		$q_insert = mysql_query($QUERY_INSERT_BARANG);
		
		$last_id = mysql_insert_id();
		
		if(!$q_insert) {
			errorMassage();
			return;
		}
		
	
	} else {
		errorMassage();
		return;
	}
	
	
	//Final data will send to client side
	$data = sprintf(
	'{  
	"%s" : "%s", 
	"%s" : "%s", 
	"%s" : %d 
	}', 
		$header_query, $QUERY_INSERT_BARANG, 
		$header_receive_data, $receive, 
		$header_last_inserted_id, $last_id 
	);		

	print_r($data);		//Informasi yg dikirimkan kepada client	
	
?>