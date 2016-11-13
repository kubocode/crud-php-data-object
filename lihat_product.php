<?php
	/*
	*include header
	*/
	$title = "Lihat Product";
	include_once "template/header.php";

	/*
	*button kembali
	*/
?>
	<div class="right-button-margin">
		<button onClick="goBack()" class="btn btn-primary pull-right">
			<span class="glyphicon glyphicon-list"></span>&nbsp;Kembali ke Tabel Products
		</button>
	</div>

<?php
	/*
	*ambil ID melalui method GET dan check apakah kosong
	*/
	$id = isset($_GET["id"]) ? htmlspecialchars(strip_tags($_GET["id"])) : "";
	
	if(!empty($id))
	{
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
		*set variabel ID berdasarkan ID yang diambil melalui method GET
		*/
		$product->setID($id);

		/*
		*set data product yang akan ditampilkan 
		*function setDetailsProduct diset berdasarkan ID yang sudah di set
		*/
		$product->setDetailsProduct();
	}
	else
	{
		header("location: index.php");
	}

?>
	<table class="table table-hover table-responsive table-bordered">
		<tr>
			<td>Nama</td>
			<td><?php echo $product->getNama(); ?></td>
		</tr>
		<tr>
			<td>Harga</td>
			<td><?php echo "&#36;".$product->getHarga(); ?></td>
		</tr>
		<tr>
			<td>Keterangan</td>
			<td><?php echo $product->getKeterangan(); ?></td>
		</tr>
		<tr>
			<td>Category</td>
			<td>
			<?php
				$category->setID($product->getCategoryID());
				$category->setNama();
				echo $category->getNama();
			?>
			</td>
		</tr>
	</table>
<?php 
	/*
	*include footer
	*/
	include_once "template/footer.php";
?>