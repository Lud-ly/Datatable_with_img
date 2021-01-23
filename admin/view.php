<?php
require 'database.php';

if(!empty($_GET['id'])){
    $id = checkInput($_GET['id']);
}

$db = Database::connect();

    $statement = $db->prepare('SELECT items.id, items.marque, items.modele, items.chevaux, items.vitesseMax, items.moteur, items.couple, items.de_0_100km_h, items.miseEnCirculation, items.prix, items.image, categories.name AS category FROM items LEFT JOIN categories ON items.category = categories.id  WHERE items.id = ?');
    $statement->execute(array($id));
    $item = $statement->fetch();
Database::disconnect();


//Nettoyage & Sécurité data
function checkInput($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
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

<body class="parking">
        <div class="container admin">
        <a class="ajout" href="index.php"><span > Retour</span></a>
            <a class="ajout" href="update.php?id=<?= $item['id'] ?>"><span > Modifier</span></a>
                        <br/>
              <div class="row">
                  <div class="col-sm-5">
                        <h1><strong><?= $item['category'] ?></strong></h1>
                        <br>
                        <form>
                            <div class="form-group">
                                <label>Modele : </label><?= $item['modele']; ?>
                            </div>
                            <div class="form-group">
                                <label>Chevaux : </label><?= $item['chevaux']; ?>
                            </div>
                            <div class="form-group">
                                <label>Vitesse max : </label><?= $item['vitesseMax'];?> km/h 
                            </div>
                            <div class="form-group">
                                <label>Moteur : </label><?= $item['moteur']; ?>
                            </div>
                            <div class="form-group">
                                <label>Couple : </label><?= $item['couple'];?>
                            </div>
                            <div class="form-group"> 
                                <label>De 0 à 100 KM/H : </label><?= $item['de_0_100km_h']; ?>
                            </div> 
                            <div class="form-group"> 
                                <label>Prix : </label><?= number_format($item['prix'], 2, '.','') . ' € ' ; ?>
                            </div> 
                        </form>
                        <br>
                  </div>
                  
                  
            <div class="col-sm-7">
                    <div class="thumbnail">
                        <img src="<?= '../images/' .  $item['image'] ; ?>" alt="...">
                        </div>
                    </div>
                    <div class="form-group">
                                <label>Mise en circulation : </label><?= $item['miseEnCirculation'];?>
                            </div>
                            <div class="form-group">
                                <label>Nom de l'image : </label><?= $item['image']; ?>
                    </div>
                </div>
         </div>
    
		<footer>
			<!-- Pied-de-page de la page -->
		</footer>
	
	<!-- main js -->
	<script type="text/javascript" charset="utf8" src="../Js/datatables.min.js"></script>
	<script type="text/javascript" charset="utf8" src="../Js/my_datatable.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"></script>
</body>

</html>