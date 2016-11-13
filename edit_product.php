<?php
	/*
	*include header
	*/
	$title = "Edit Product";
	include_once "template/header.php";

	/*
	*button kembali
	*/
?>
	<div class="right-button-margin">
		<a href="index.php" class="btn btn-primary pull-right">
			<span class="glyphicon glyphicon-list"></span>&nbsp;Kembali ke Tabel Products
		</a>
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
		*set data roducy yang akan ditampilkan 
		*function setDetailsProduct diset berdasarkan ID yang sudah di set
		*/
		$product->setDetailsProduct();

		/*
		*panggil config database dan lakukan instansiasi
		*/
	}
	else
	{
		header("location: index.php");
	}
?>
	<!--alert message-->
	<?php
		$pesan = isset($_GET['message']) ? $_GET['message'] : '';

		$alert = "";
		if("gagal" == $pesan)
		{
			$alert = "<div class='alert alert-warning'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><p>Product Gagal Diubah</p></div>";
		}
		else if("success" == $pesan)
		{
			$alert = "<div class='alert alert-success'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><p>Product Berhasil Diubah</p></div>";
		}
		else
		{
			$alert = "";
		}

		echo $alert;
	?>

	<table class="table table-hover table-responsive table-bordered">
		<form action="action/action_edit_product.php" method="POST">
			<input type="hidden" name="id" value="<?php echo $product->getID(); ?>" />
			<tr>
				<td>Nama</td>
				<td><input type="text" name="nama" value="<?php echo $product->getNama(); ?>" class="form-control" required="required" /></td>
			</tr>
			<tr>
				<td>Harga</td>
				<td><input type="text" name="harga" value="<?php echo $product->getHarga(); ?>" class="form-control" required="required" /></td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td>
					<textarea name="keterangan" class="form-control" required="required"><?php echo $product->getKeterangan(); ?></textarea>
				</td>
			</tr>
			<tr>
				<td>Category</td>
				<td>
				<?php
					$stmt = $category->getCategory();
				?>
					<select class="form-control" name="category_id">
						<option>Silakan Pilih</option>
				<?php
					while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC))
					{

						extract($row_category);
					?>
						<option value="<?php echo $id ?>" <?php echo $product->getCategoryID() == $id ? "selected" : ""; ?>><?php echo $nama; ?></option>
				<?php 
					} 
				?>
					</select>
				</td>
			</tr>

			<tr>
				<td colspan="2">
					<input type="submit" name="btnEdit" class="btn btn-primary" value="Update">
				</td>
			</tr>
		</form>
	</table>
<?php 
	/*
	*include footer
	*/
	include_once "template/footer.php";
?>