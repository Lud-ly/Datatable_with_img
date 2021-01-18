<?php
	require 'connBdd.php';
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
	<!-- main css and js -->

	<script type="text/javascript" src="Js/jquery_3_5_1.js"></script>
	<link rel="stylesheet" type="text/css" href="datatables.min.css">
	<!-- main css and js -->
	<link rel="stylesheet" type="text/css" href="style/styles.css">
	<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">
	<script type="text/javascript" charset="utf8" src="Js/datatables.min.js"></script>
	<script type="text/javascript" charset="utf8" src="Js/my_datatable.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"></script>
</head>

<body style="background:url(images/pilepneus.png)no-repeat;background-size:cover,cover">

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
					<button id="btToggleDisplay"class="button">Toggle table and card view</button>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2">
					<select class="nav" id="tags">
						<option value="">All</option>
					</select>
					<ul class="nav" id="tags2">
						<li><a href="#" data-value="">ALL</a></li>
					</ul>
				</div>
				<div class="col-sm-10">
					<table id="example" class="table display cards" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="th_photo">Photo</th>
								<th class="th_name">Modèle</th>
								<th>Moteur</th>
								<th>Marque</th>
								<th>0-100km/h</th>
								<th>Couple</th>
								<th>Mise En Circulation</th>
								<th>Edit</th>
								<th>Supp</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Photo</th>
								<th>Modèle</th>
								<th>Moteur</th>
								<th>Marque</th>
								<th>De-0-100km/h<</th>
								<th>Couple</th>
								<th>Mise En Circulation</th>
								<th>Edit</th>
								<th>Supp</th>
							</tr>
						</tfoot>
						<tbody>
							<?php
							foreach ($aOfcars as $car):?>
							<tr>
								<td>
									<div class="hbox-column photo">
										<img src=images/<?= $car['image']?> alt="cars_img"></div>
								</td>	
								<td><?= $car['modele']?></td>
								<td><?= $car['moteur']?></td>
								<td><?= $car['marque']?></td>
								<td><?= $car['de_0_100km_h']?></td>
								<td><?= $car['couple']?></td>	
								<td><?= $car['miseEnCirculation']?></td>
								<td><img src="images/edit_pencil.png"/></td>
								<td><img src="images/trash.png"/></td>
							</tr>
							<?php endforeach; ?>
							
						</tbody>
					</table>
				</div>
			</div>

		</section>
		<section>
			<button class="button" onclick="show_form()">Ajouter un Véhicule</button>

			<form action="insertion.php" method="post">
				
				<p>
					<label for="marque">Marque</label>
					<input id="marque" type="text" name="brand" placeholder="Ex Bmw">
				</p>
				<p>
					<label for="modele">Modèle</label>
					<input id="modele" type="text" name="model" placeholder="Ex M3">
				</p>
				<p>
					<label for="moteur">Moteur</label>
					<input id="moteur" type="text" name="engine" placeholder="Ex 3.0L V6 24s">
				</p>
				<p>
					<label for="couple">Couple</label>
					<input id="couple" type="text" name="torque" placeholder="Ex 530Nm">
				</p>
				<p>
					<label for="de_0_100km-h">de-0-100kmh</label>
					<input id="de_0_100km_h" type="text" name="acceleration" placeholder="Ex 6.9 secondes">
				</p>
				<p>
					<label for="miseEnCirculation">Mise en circulation</label>
					<input id="miseEnCirculation" type="text" name="year" placeholder="Ex 1998-07-12">
				</p>
				<p>
					<label for="image">Photo</label>
					<input id="image" type="text" name="photo" placeholder="Ex M3.png">
				</p>
				<p><input type="submit" value="Enregistrer"></p>
			</form>
		
		</section>
		<footer>
			<!-- Pied-de-page de la page -->
		</footer>
	</div>

</body>

</html>