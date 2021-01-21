<?php
	require 'lister.php';
?> 
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
	<link rel="stylesheet" type="text/css" href="../style/datatables.min.css">
	<!-- main css -->
	<link rel="stylesheet" type="text/css" href="../style/styles.css">
	<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript" src="../Js/jquery_3_5_1.js"></script>
	<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
</head>

<body class="myTable">

	<div id="page" class="container" >
		<header>
			<!-- Entête de la zone considérée -->
		</header>

		<nav>
			<!-- Nav. principale de la page -->
		</nav>

		<aside>
			<!-- Les à-cotés de la page -->
		</aside>
		
		<!-- Contenu textuel de la page -->
		<section>
			<div class="row">
				<div class="col-sm-12 text-center">
					<button id="btToggleDisplay"class="button">Toggle Datatable Cars</button>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2">
					<select class="nav" id="tags">
						<option value="">All</option>
					</select>
					<a href="insert.php" class="ajout"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
						</svg> Ajouter</a>
					<ul class="nav" id="tags2">
						<li><a href="#" data-value="" class="all">ALL</a></li>
					</ul>
				</div>
				<div class="col-sm-10">
					<table id="example" class="table display cards" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="th_photo">Voir</th>
								<th class="th_name">Modèle</th>
								<th>Moteur</th>
								<th>Marque</th>
								<th>0-100km/h</th>
								<th>Couple</th>
								<th>Année</th>
								<th>Edit</th>
								<th>Supp</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($aOfcars as $car):?>
							<tr>
								<td>
									<div class="hbox-column photo">
										<a href="view.php?id=<?= $car['id'] ?>"><img src=../images/<?= $car['image']?> alt="cars_img"title="Voir"></a></div>
								</td>	
								<td><?= $car['modele']?></td>
								<td><?= $car['moteur']?></td>
								<td><?= $car['marque']?></td>
								<td><?= $car['de_0_100km_h']?></td>
								<td><?= $car['couple']?></td>	
								<td><?= $car['miseEnCirculation']?></td>
								<td><a href ="update.php?id=<?= $car['id'] ?>"><img src="../images/edit_pencil.png"/></a></td>
								<td><a href="delete.php?id=<?= $car['id'] ?>"><img src="../images/trash.png"/></a></td>
							</tr>
							<?php endforeach; ?>
							
						</tbody>
					</table>
				</div>
			</div>

		</section>
		<footer>
			<!-- Pied-de-page de la page -->
		</footer>
	</div>
		<!-- CREATION MODAL ENREGISTREMENT EN COURS -->
		<div class="modalChanged" id="divModalSaving">
	</div>
	<!-- main js -->
	<script type="text/javascript" charset="utf8" src="../Js/datatables.min.js"></script>
	<script type="text/javascript" charset="utf8" src="../Js/my_datatable.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"></script>
</body>

</html>