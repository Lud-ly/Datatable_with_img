<?php
	require 'database.php';
	$db = Database::connect();

$pdoStat = $db-> prepare('SELECT * FROM items');

//Exècution de la requete
$executeIsOk = $pdoStat-> execute();

//Récupération des résultats

$aOfcars = $pdoStat->fetchAll();



?>
