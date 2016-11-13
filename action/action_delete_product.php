<?php
	if($_POST)
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
		*check apakah variabel kosong
		*/
		$id = isset($_POST['object_id']) ? htmlspecialchars(strip_tags($_POST['object_id'])) : '';
		
		if(!empty($id))
		{
			/* 
			*jika tidak kosong
			*set property id product
			*/
			$product->setID($id);

			/*
			*lakukan penghapusan data
			*/
			$hapus = $product->hapusProduct();
			if(TRUE === $hapus)
			{
				/*
				*jika berhasil munculkan redirect ke index awal
				*/
				header("location: ../index.php");
			}
			else
			{
				header("location: ../index.php");
			}
		}
		else
		{
			/*
			*jika data id kosong redirect ke index awal
			*/
			header("location: ../index.php");		
		}
	}
	else
	{
		/*
		*jika form diakses tanpa menekan tombol submit hapus redirect ke index awal
		*/
		header("location: ../index.php");
	}
?>