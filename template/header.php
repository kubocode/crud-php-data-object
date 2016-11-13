<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--load css-->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<title><?php echo $title; ?></title>
		<!--style-->
		<style>
			.left-margin { margin:0 .5em 0 0; }
			.right-button-margin { margin: 0 0 1em 0; overflow: hidden; }
			/*modal*/
			.modal-body { padding: 20px 20px 0px 20px !important; text-align: center !important; }
			.modal-footer { text-align: center !important; }
		</style>
	</head>
	<body>
		<!--container-->
		<div class="container">
		<?php
			echo "<div class='page-header'>";
			echo "<h1>{$title}</h1>";
			echo "</div>";
		?>