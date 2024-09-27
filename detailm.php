<?php
	include 'database.php';

	$query_select = 'select * from products where product_id = "'.$_GET['id'].'"';
	$run_query_select = mysqli_query($conn, $query_select);
	$d = mysqli_fetch_object($run_query_select);

	if(!$d){
		header('location:indexm.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Detail - Medical Shop</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;700&display=swap');
		* {
			padding:0;
			margin:0;
		}
		body {
			font-family: 'Nunito Sans', sans-serif;
			background-color: #d4f1f4;
		}
		a {
			color: inherit;
			text-decoration: none;
		}

		/* detail content */
		.container {
			width: 540px;
			margin-left: auto;
			margin-right: auto;
		}
		.produk_pilihan {
			background-color: #fff;
			position: relative;
			margin-bottom: 15px;
		}
		.produk_pilihan .btn-back {
			border:1px solid #ccc;
			padding: 10px 15px;
			display: inline-block;
			border-radius: 50%;
			background-color: #fff;
			position: absolute;
			top: 10px;
			left: 10px;
		}
		.produk_pilihan img {
			width: 100%;
		}
		.card-body {
			padding: 15px;
		}
		.card-body .product-name {
			font-size: 18px;
		}
		.card-body .product-description {
			font-size: 14px;
			color: #282828;
			margin-bottom:15px;
		}
		.card-body .product-price {
			font-weight: bold;
		}

		@media (max-width: 768px){
			.container {
				width: 100%;
			}
		}
	</style>
</head>
<body>

	<!-- detail content -->
	<div class="container">
		<div class="produk_pilihan">

			<a href="indexm.php" class="btn-back"><i class="fa fa-arrow-left"></i></a>

			<img src="uploads/<?= $d->foto ?>">

			<div class="card-body">
				<div class="product-name"><?= $d->product_name ?></div>
				<div class="product-description"><?= $d->product_desc ?></div>
				<div class="product-price">Rp<?= number_format($d->product_price, 0, ',', '.') ?></div>
			</div>
		</div>

	</div>

</body>
</html>