<?php
	/*
	*ambil search_term melalui method GET dan check apakah kosong
	*/
	$search_term = isset($_GET["s"]) ? htmlspecialchars(strip_tags($_GET["s"])) : "";

	if(!empty($search_term))
	{
		/*
		*core pagination
		*/
		require_once 'config/core_pagination.php';

		/*
		*panggil config database dan claas prouduct, kategori
		*/
		require_once "config/database.php";
		require_once "function/product.php";
		require_once "function/category.php";
		
		/*
		*inisialisai dan instansiasi
		*/
		$database = new Database();
		$db       = $database->getConnection();
		$product  = new Product($db);
		$category = new Category($db);

		/*
		*include header
		*/
		$title = "Anda mencari data \"{$search_term}\"";
		include_once "template/header.php";

		/*
		*ambil data product yang akan ditampilkan 
		*function searchProduct diset berdasarkan search_term yang sudah di set
		*/
		$stmt = $product->searchProduct($search_term, $jumlah_record, $data_per_page);

		/*
		*url spesifik dari halaman ketika paginaton digunakan
		*/
		$page_url = "search.php?s={$search_term}&";

		/*
		*ambil total data untuk membuat pagination
		*/
		$total_baris = $product->getTotalDataBySearch($search_term);

		/*
		*include template main
		*/
		include_once "template/main.php";

		/*
		*include footer
		*/
		include_once "template/footer.php";
	}
	else
	{
		header("location: index.php");
	}
?>