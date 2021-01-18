<?php
$message ="";
$servername = 'localhost';
$username = 'root';
$password = '';

	//Ouverture d'une connexion à la BDD
	$con = new PDO("mysql:host=$servername;dbname=mydatabase", $username, $password);


//Préparation de la requête d'insertion(SQL)

$pdoStat = $con-> prepare('INSERT INTO items VALUES (NULL, :marque, :modele, :moteur, :couple, :de_0_100km_h, :miseEnCirculation, :image)');



//On lie chaque marqueur à une valeur

$pdoStat-> bindValue(':marque', $_POST['brand'], PDO::PARAM_STR);
$pdoStat-> bindValue(':modele', $_POST['model'], PDO::PARAM_STR);
$pdoStat-> bindValue(':moteur', $_POST['engine'], PDO::PARAM_STR);
$pdoStat-> bindValue(':couple', $_POST['torque'], PDO::PARAM_STR);
$pdoStat-> bindValue(':de_0_100km_h', $_POST['acceleration'], PDO::PARAM_STR);
$pdoStat-> bindValue(':miseEnCirculation', $_POST['year'], PDO::PARAM_STR);
$pdoStat-> bindValue(':image', $_POST['photo'], PDO::PARAM_STR);


//Executer la requête préparé

$insertIsOk = $pdoStat->execute();


if($insertIsOk){
    $message = 'Le véhicule a bien été ajouté';
}else{
    $message = 'Echec de l\'insertion';
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ajout Véhicule</h1>
<h3><?php echo $message; ?></h3>
</body>
</html>