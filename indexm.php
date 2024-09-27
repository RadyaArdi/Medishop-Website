<?php
	include 'database.php';

	$where = '';

	if(isset($_GET['kategori'])){
		$where = ' where kategori = "'.$_GET['kategori'].'"';
	}

	$query_select = 'select * from products ' . $where;
	$run_query_select = mysqli_query($conn, $query_select);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home - Medical Shop</title>
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

		/* navbar */
		.navbar {
			padding: 0.5rem 1rem;
			background-color: #05445e;
			color: #fff;
			position: fixed;
			width: 100%;
			top:0;
			left:0;
			z-index: 99;
		}

		/*  sidebar */
		.sidebar {
			position: fixed;
			width: 250px;
			top:0;
			bottom:0;
			background-color: #05445e;
			padding-top: 40px;
			transition: all .5s;
			z-index: 98;
		}
		.sidebar-hide {
			left:-250px;
		}
		.sidebar-show {
			left:0;
		}
		.sidebar-body {
			padding:15px;
		}
		.sidebar-body h2 {
			margin-bottom: 8px;
		}
		.sidebar-body ul {
			list-style: none;
		}
		.sidebar-body ul li a {
			width: 100%;
			display: inline-block;
			padding: 7px 15px;
			box-sizing: border-box;
		}
		.sidebar-body ul li a:hover {
			background-color: #189ab4;
			color: #fff;
		}
		.sidebar-body ul li:not(:last-child) {
			border-bottom:1px solid #189ab4;
		}

		/* banner */
		.banner {
			border-bottom:1px solid #ccc;
			padding: 70px 15px 40px;
			background-image: url('img/home_backgr.png');
			background-size: cover;
			background-repeat: no-repeat;
			background-position: bottom;
			position: relative;
		}
		.banner:before {
			content:'';
			display: block;
			position: absolute;
			top:0;
			left:0;
			width:100%;
			height:100%;
			background-image: linear-gradient(to right, rgba(255,255,255,1), rgba(255,255,255,.5));
		}
		.banner-text {
			position: relative;
		}

		/* content */
		.content {
			padding: 25px 0;
		}
		.container {
			width: 540px;
			padding-left: 15px;
			padding-right: 15px;
			box-sizing: border-box;
			margin-left: auto;
			margin-right: auto;
		}
		.row {
			margin-left: -15px;
			margin-right: -15px;
			display: flex;
			flex-wrap: wrap;
		}
		.col-6 {
			flex: 0 0 50%;
			box-sizing: border-box;
			margin-bottom: 15px;
			padding-left: 15px;
			padding-right: 15px;
		}
		.produk_pilihan {
			border:1px solid #ccc;
			background-color: #fff;
			border-radius: 5px;
		}
		.produk_pilihan img {
			width: 100%;
			height: 150px;
			object-fit: cover;
			border-top-right-radius: 5px;
			border-top-left-radius: 5px;
		}
		.card-body {
			padding:8px;
		}
		.product-name {
			height: 45px;
			overflow: hidden;
			display: -webkit-box;
			text-overflow: ellipsis;
			-webkit-line-clamp: 2;
			-webkit-box-orient: vertical;
			margin-bottom: 8px;
		}
		.product-price {
			font-weight: bold;
			text-align: center;
		}

		@media (max-width: 768px){
			.container {
				width: 100%;
			}
		}
	</style>
</head>
<body>

	<!-- navbar -->
	<div class="navbar">
		<a href="#" id="btnBars">
			<i class="fa fa-bars"></i>
		</a>
	</div>

	<!-- sidebar -->
	<div class="sidebar sidebar-hide">
		<div class="sidebar-body">
			
			<h2>Kategori</h2>
			<ul>
				<li><a href="?kategori=Alat Kesehatan Rumah">Alat Kesehatan Rumah</a></li>
				<li><a href="?kategori=Alat Diagnostik">Alat Diagnostik</a></li>
                <li><a href="?kategori=Alat Bantu">Alat Bantu</a></li>
			</ul>

		</div>
	</div>

	<!-- banner -->
	<div class="banner">
		<div class="banner-text">
			
			<h1>Medical Shop</h1>
			<p>Temukan Berbagai Macam Kebutuhan Produk Kesehatan Anda</p>

		</div>
	</div>

	<!-- content -->
	<div class="content">
		<div class="container">
			
			<!-- list produk kesehatan -->
			<div class="row">

				<!-- pilihan item -->
				<?php
					if(mysqli_num_rows($run_query_select) > 0){
						while($row = mysqli_fetch_array($run_query_select)){
				?>
				<div class="col-6">

					<a href="detailm.php?id=<?= $row['product_id'] ?>">
						<div class="produk_pilihan">
							<img src="upload/<?= $row['product_img'] ?>">
                            <div class="card-body">
								<div class="product-name"><?= $row['product_name'] ?></div>
                                <div class="product-price">Rp<?= number_format($row['product_price'], 0, ',', '.') ?></div>

							</div>
						</div>
					</a>

				</div>
			<?php }}else{ ?>

				<div>Menu tidak tersedia</div>

			<?php } ?>

			</div>

		</div>
	</div>

	<script type="text/javascript">
		
		var btnBars = document.getElementById('btnBars')
		var sidebar = document.querySelector(".sidebar")

		btnBars.addEventListener('click', function(e){
			e.preventDefault();

			sidebar.classList.toggle('sidebar-show')

		})

	</script>

</body>
</html>