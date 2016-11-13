	<ul class="pagination">
<?php 
	/*
	*tampilkan button first page jika bukan dihalaman 1
	*/
	if($page > 1) 
	{ 
?>
		<li>
			<a href="<?php echo $page_url ?>" title="Halaman Pertama">First Page</a>
		</li>
<?php } ?>


<?php
	/*
	*jumlah semua data didatabase untuk dihitung menjadi total halaman
	*total_baris = 11, jumlah_record = 5
	*ceil pembulatan keatas $total_page = 3
	*/
	$total_page = ceil($total_baris / $data_per_page);

	/*
	*range dari link yang ditampilkan
	*/
	$range = 2;

	/*
	*jika posisi page = 1
	*/
	$nomor_aktif = $page - $range; //-1 
	$kondisi_limit_nomor = ($page + $range) + 1; //4

	for ($i = $nomor_aktif; $i < $kondisi_limit_nomor; $i++) 
	{
		/*
		*jika posisi halaman 1 maka button yang aktif halaman 1 bukan fisrt page
		*karena fist page bernilai -1 
		*sedangkan kondisinya $i harus lebih dari 0 
		*kalo $i = -1 maka first page tidaklah di set active
		*/
		if (($i > 0) && ($i <= $total_page))  //(1 < 0)  && (1 <= 3)
		{
			/*
			*cetak halaman
			*ada kondisi jika nilai $i misal 1 sama dengan 
			*page yaitu page yg aktiv saat ini maka set class active 
			*menjadi halaman berwarna biru
			*/
			if ($i == $page) 
			{
				echo "<li class='active'>
						<a href=\"#\">$i <span class=\"sr-only\">(current)</span></a>
					</li>";
			} 
			/*
			*cetak halaman
			*ada kondisi jika nilai $i misal 1 tidak sama dengan 
			*page yaitu page yg aktiv saat ini cetak halaman list biasa
			*/
			else 
			{
				echo "<li><a href=".$page_url."page=".$i.">$i</a></li>";
			}
		}
	}

	/*
	*kondisi jika page yang aktif saat ini kurang dari 3 maka 
	*cetak button last page
	*/
	if($page < $total_page)
	{
?>
		<li>
			<a href="<?php echo $page_url.'page='.$total_page; ?>" title="Halaman terakhir dari total halaman <?php echo $total_page; ?>">Last Page</a>
		</li>
<?php 
	}	
?>
	</ul>