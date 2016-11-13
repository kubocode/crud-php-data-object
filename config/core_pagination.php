<?php
	//membuat default page = 1
	$page = isset($_GET['page']) ? $_GET['page'] : 1; 
	
	//set data yg ditampilkan
	$data_per_page = 5;

	//batasan limit untuk query
	$jumlah_record = ($data_per_page * $page) - $data_per_page;
?>