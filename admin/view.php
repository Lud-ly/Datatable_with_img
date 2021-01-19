<?php
require 'database.php';

if(!empty($_GET['id'])){
    $id = checkInput($_GET['id']);
}

$db = Database::connect();

$statement = $db->prepare('SELECT items.id, items.marque, items.modele, items.moteur, items.couple, items.de_0_100km_h, items.miseEnCirculation, categories.name AS category FROM items LEFT JOIN categories ON items.category = categories.id WHERE items.id = ?');
$statement->execute(array($id));
$item = $statement->fetch();
Database::disconnect();


//Sécurité input
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
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
</head>

<body style="background:url(../images/parking.jpg)no-repeat;background-size:cover,cover">

<h1 class="text-logo"><span class="glyphicon glyphicon-leaf"></span> Monster <span class="g">G</span>arage  <span class="glyphicon glyphicon-leaf"></span></h1>
            <div class="container admin">
              <div class="row">
                  <div class="col-sm-6">
                       <h1><strong>Voir un item </strong></h1>
                      <br>
                       <a class="btn btn-default" href="index.php"><span class="glyphicon glyphicon-arrow-left"> Retour</span></a>
                      <br/>
                      <form>
                        <div class="form-group">
                            <label>Nom : </label><?php echo '  ' . $item['marque']; ?>
                        </div>
                           <div class="form-group">
                            <label>Description : </label><?php echo '  ' . $item['modele']; ?>
                        </div>
                           <div class="form-group">
                            <label>Prix : </label><?php echo ' ' . number_format((float)$item['price'],2,'.','') . ' €'; ?>
                        </div>
                           <div class="form-group">
                            <label>Catégorie : </label><?php echo '  ' . $item['category']; ?>
                        </div>
                           <div class="form-group">
                            <label>Image : </label><?php echo '  ' . $item['couple']; ?>
                        </div>
                      </form>
                      <br>
                       <div class="form-actions">
                       </div>
                  </div>
                  
                  
            <div class="col-sm-6 site">
                    <div class="thumbnail">
                        <img src="<?php echo '../images/' .  $item['image'] ; ?>" alt="...">
                          <div class="price"><?php echo number_format((float)$item['price'],2,'.','') . ' €'; ?></div>
                            <div class="caption">
                                    <h4><?php echo $item['name']; ?></h4>
                                    <p><?php echo $item['description']; ?></p>
                                    <a href="http://www.lacentrale.fr" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Chercher</a>
                            </div>
                        </div>
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