<?php
	$servername = 'localhost';
    $username = 'root';
    $password = '';

	//Ouverture d'une connexion à la BDD
	$conn = new PDO("mysql:host=$servername;dbname=mydatabase", $username, $password);

	$pdoStat = $conn-> prepare('SELECT * FROM items');

	//Exècution de la requete
	$executeIsOk = $pdoStat-> execute();

	//Récupération des résultats

	$aOfcars = $pdoStat->fetchAll();
?>
