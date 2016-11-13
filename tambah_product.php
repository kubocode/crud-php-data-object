<?php
	/*
	*panggil config database dan lakukan instansiasi
	*/
	require_once "config/database.php";
	require_once "function/category.php";
	$database = new Database();
	$db       = $database->getConnection();
	$category = new Category($db);
	
	/*
	*include header
	*/
	$title = "Tambah Product";
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

	<!--alert message-->
	<?php
		$pesan = isset($_GET['message']) ? $_GET['message'] : '';

		$alert = "";
		if("gagal" == $pesan)
		{
			$alert = "<div class='alert alert-warning'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><p>Product Gagal Ditambah</p></div>";
		}
		else if("success" == $pesan)
		{
			$alert = "<div class='alert alert-success'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><p>Product Berhasil Ditambah</p></div>";
		}
		else
		{
			$alert = "";
		}

		echo $alert;
	?>
	<form action="action/action_tambah_product.php" method="POST">
		<table class="table table-hover table-responsive table-bordered">
			<tr>
				<td>Nama Product</td>
				<td><input type="text" name="nama" class="form-control" required="required" /></td>
			</tr>
			<tr>
				<td>Harga</td>
				<td><input type="text" name="harga" class="form-control" required="required" /></td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td><textarea name="keterangan" class="form-control" required="required"></textarea></td>
			</tr>
			<tr>
				<td>Category</td>
				<td>
				<?php
					$stmt = $category->getCategory();
				?>
					<select class="form-control" name="category_id">
						<option>Pilih category...</option>
						<?php
							while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC))
							{
								extract($row_category);
						?>
								<option value="<?php echo $id; ?>"><?php echo $nama; ?></option>
						<?php 
							} 
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="btnTambah" class="btn btn-primary" value="Tambah" />
				</td>
			</tr> 
		</table>
	</form>
<?php 
	/*
	*include footer
	*/
	include_once "template/footer.php";
?>