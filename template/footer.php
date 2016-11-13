		</div>
		<!--end container-->

		<!--load jQuery-->
		<script src="assets/js/jquery-1.12.4.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/holder.js"></script>
		<script src="assets/js/bootbox.min.js"></script>
		<!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		<script>
			//javascript event hapus
			$(document).on('click', '.delete-object', function()
			{
				var id = $(this).attr('delete-id');
				bootbox.confirm({
					message: "<h4>Yakin nih mau dihapus ?</h4>",
					buttons: {
						confirm: {
							label: '<span class="glyphicon glyphicon-ok"></span> Ya',
							className: 'btn-danger',
							name : 'btnHapus'
						},
						cancel: {
							label: '<span class="glyphicon glyphicon-remove"></span> Tidak',
							className: 'btn-primary'
						}
					},

					callback: function(result) 
					{
						if(true == result)
						{
							$.post('action/action_delete_product.php', 
							{
								object_id: id
							}, function(data)
							{
								location.reload();
							}).fail(function() 
							{
								alert('Gagal menghapus data.');
							});
						}
					}
				});

				return false;
			});

			function goBack()
			{
				window.history.back();
			}
		</script>
	</body>
</html>