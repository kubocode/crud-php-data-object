<?php
	if($_POST['btnTambah'])
	{
		/*
		*panggil config database dan class product lakukan instansiasi
		*/
		require_once "../config/database.php";
		require_once "../function/product.php";
		$database = new Database();
		$db       = $database->getConnection();
		$product  = new Product($db);

		/* 
		*check apakah inputan kosong
		*/
		$nama        = isset($_POST['nama']) ? htmlspecialchars(strip_tags($_POST['nama'])) : '';
		$harga       = isset($_POST['harga']) ? htmlspecialchars(strip_tags($_POST['harga'])) : '';
		$keterangan  = isset($_POST['keterangan']) ? htmlspecialchars(strip_tags($_POST['keterangan'])) : '';
		$category_id = isset($_POST['category_id']) ? htmlspecialchars(strip_tags($_POST['category_id'])) : '';

		if(!empty($nama) && !empty($harga) && !empty($keterangan) && !empty($category_id))
		{
			/* 
			*jika tidak kosong
			*set masing-masing property product
			*/
			$product->setNama($nama);
			$product->setHarga($harga);
			$product->setKeterangan($keterangan);
			$product->setCategoryID($category_id);

			/*
			*lakukan simpan data
			*/
			$simpan = $product->simpanProduct();

			if(TRUE === $simpan)
			{
				/*
				*jika berhasil munculkan alert
				*product berhasil ditambah
				*/
				header("location: ../tambah_product.php?message=success");
			}
			else
			{
				/*
				*jika gagal munculkan alert
				*product gagal ditambah
				*/
				header("location: ../tambah_product.php?message=gagal");
			}
		}
		else
		{
			/*
			*jika data ada yang kosong redirect ke tambah product
			*/
			header("location: ../tambah_product.php?message=gagal");
		}
	}
	else
	{
		/*
		*jika form diakses tanpa menekan tombol submit tambah redirect ke tambah product
		*/
		header("location: ../tambah_product.php");
	}
?>