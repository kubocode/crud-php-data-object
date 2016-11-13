<?php
	/*
	*core pagination
	*/
	require_once 'config/core_pagination.php';

	/*
	*panggil config database dan claas prouduct, kategori
	*/
	require_once 'config/database.php';
	require_once 'function/product.php';
	require_once 'function/category.php';

	/*
	*instansiasi
	*/
	$database = new Database();
	$db 	  = $database->getConnection();
	$product  = new Product($db);
	$category = new Category($db);

	/*
	*include header
	*/
	$title = "Tabel Barang";
	include_once "template/header.php";

	/*
	*ambil data product
	*/
	$stmt = $product->getAllData($jumlah_record, $data_per_page);

	/*
	*query string untuk pagination
	*/
	$page_url = "index.php?";

	/*
	*ambil total data untuk membuat pagination
	*/
	$total_baris = $product->getTotalData();

	/*
	*include template main
	*/
	include_once "template/main.php";

	/*
	*include footer
	*/
	include_once "template/footer.php";
?>