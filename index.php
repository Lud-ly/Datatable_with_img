<!DOCTYPE HTML>
<html>

<head>
	<title>Datatable_cars</title>
	<meta charset="utf-8">
	<meta name="description" content="TP FORMULAIRE">
	<!-- For Internet Explhorreur : to force css3 -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- Tablettes 'n' Mobiles -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- main css  -->
	<link rel="stylesheet" type="text/css" href="style/datatables.min.css">
	<link rel="stylesheet" type="text/css" href="style/styles.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript" src="Js/jquery_3_5_1.js"></script>
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
</head>

 <body class="conn">

	<div id="page" class="container">
		<header>
			<!-- Entête de la zone considérée -->
		</header>
		<!-- Nav. principale de la page -->
		<div class="header">
			<h1>Monster Garage</h1>
			<p>Connexion to check cars.</p>
		</div>

		<div id="navbar">
		<a class="active" href="javascript:void(0)">Home</a>
		<a href="javascript:void(0)">S'inscrire</a>
		<a href="javascript:void(0)">Déconnexion</a>
		</div>
		
		<aside>
			<!-- Les à-cotés de la page -->
		</aside>

		<!-- Contenu textuel de la page -->
		<section>
			<div class="row content">
				<div class="col-sm-12">
						<a class="butAdmin" href="admin/index.php">Connexion <svg xmlns="http://www.w3.org/2000/svg"
								width="36" height="36" fill="currentColor" class="bi bi-forward-fill" viewBox="0 0 16 16">
								<path
									d="M9.77 12.11l4.012-2.953a.647.647 0 0 0 0-1.114L9.771 5.09a.644.644 0 0 0-.971.557V6.65H2v3.9h6.8v1.003c0 .505.545.808.97.557z" />
							</svg>
						</a>
				</div>
				<br/>
				<br/>
				<div class="col-sm-12 text-center">
					<?php

					require 'admin/lister.php';

					foreach ($aOfcars as $car):?>
					    <div class="home_photos">
							<a href="admin/login.php"><img src=./images/<?= $car['image']?> alt="cars_img"></a>
							<h1><?= $car['modele'] ?></h1>
					    </div>
					<?php endforeach; ?>
					
				</div>
			</div>

		</section>
		<footer>
			<!-- Pied-de-page de la page -->
		</footer>
	</div>
	<!-- main js -->
	<script type="text/javascript" charset="utf8" src="Js/datatables.min.js"></script>
	<script type="text/javascript" charset="utf8" src="Js/my_datatable.js"></script>
</body>

</html>