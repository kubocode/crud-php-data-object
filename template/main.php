	<!--form pencarian-->
	<form role="search" action="search.php">
		<div class="input-group col-md-3 pull-left" style="margin-right: 10px;">
		<?php 
			$search_value = isset($search_term) ? $search_term : ""; 
		?>
			<input type="text" class="form-control" placeholder="Masukan nama product atau keterangan..." name="s" id="srch-term" required value="<?php echo $search_value; ?>" />
			<div class="input-group-btn">
				<button class="btn btn-primary" type="submit" title="Cari Product">
					<i class="glyphicon glyphicon-search"></i>
				</button>
			</div>
			
		</div>
		
	</form>

	<!--button refresh-->
	<a href="index.php" class="btn btn-default pull-left" title="Refresh page">
		<i class="glyphicon glyphicon-refresh"></i>
	</a>	
	
	<!--button tambah product-->
	<div class="right-button-margin">
		<a href="tambah_product.php" class="btn btn-primary pull-right">
			<span class="glyphicon glyphicon-plus"></span>&nbsp;Tambah Product
		</a>
	</div>

<?php
	/*
	*jika data product didatabase lebih dari 0 munculkan data
	*/
	if($total_baris > 0) 
	{
		$no = $jumlah_record+1;
?>
		<table class="table table-hover table-responsive table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Product</th>
					<th>Harga</th>
					<th>Keterangan</th>
					<th>Category</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
	<?php 
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);
	?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $nama; ?></td>
				<td><?php echo $harga; ?></td>
				<td><?php echo $keterangan; ?></td>
				<td>
				<?php
					$category->setID($category_id);
					$category->setNama();
					echo $category->getNama();
				?>
				</td>
				<td>
					<!--tombol read-->
					<a href="lihat_product.php?id=<?php echo $id; ?>" class="btn btn-primary left-margin"><span class="glyphicon glyphicon-list"></span>&nbsp;Read</a>
					
					<!--tombol edit-->
					<a href="edit_product.php?id=<?php echo $id; ?>" class="btn btn-info left-margin"><span class="glyphicon glyphicon-edit"></span>&nbsp;Edit</a>
					
					<!--tombol hapus-->
					<a delete-id="<?php echo $id; ?>" class="btn btn-danger delete-object"><span class="glyphicon glyphicon-remove"></span>&nbsp;Delete</a></td>
			</tr>
	<?php 
		} 
	?>
			</tbody>
		</table>
	
	<?php
		/*
		*button pagination
		*/
		include_once 'library/paging.php';
	}
	else
	{
		/*
		*data product didatabase 0
		*/
		echo "<div class='alert alert-danger'>Maaf !! Tidak ada products yang ditemukan.</div>";
	}
?>