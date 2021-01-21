<?php
//  session_start();
//   if(!isset($_SESSION['email'])){
    
//     header("Location: login.php");
// }

require 'database.php';

   
    $marqueError = $modeleError = $moteurError = $coupleError = $de_0_100km_hError = $miseEnCirculationError = $prixError = $categoryError= $imageError  = $marque = $modele = $moteur = $couple = $de_0_100km_h = $miseEnCirculation = $prix =  $category = $image ="";
  if(!empty($_POST)){
      
      $marque           = checkInput($_POST['marque']);
      $modele           = checkInput($_POST['modele']);
      $moteur           = checkInput($_POST['moteur']);
      $couple           = checkInput($_POST['couple']);
      $de_0_100km_h     = checkInput($_POST['de_0_100km_h']);
      $miseEnCirculation= checkInput($_POST['miseEnCirculation']);
      $prix             = checkInput($_POST['prix']);
      $category         = checkInput($_POST['category']);

      $image            = checkInput($_FILES['image']['name']);
      $imagePath        = '../images/'  . basename($image);
      $imageExtension   = pathinfo($imagePath,PATHINFO_EXTENSION);
      $isSuccess        = true; 
      $isUploadSuccess  = false;
      
      if(empty($marque)){
          $marqueError = 'Ce champ ne  peut être vide';
          $isSuccess = false;
      }
      if(empty($modele)){
          $modeleError = 'Ce champ ne  peut être vide';
          $isSuccess = false;
      }
      if(empty($moteur)){
          $moteurError = 'Ce champ ne  peut être vide';
          $isSuccess = false;
      }
      if(empty($couple )){
          $coupleError = 'Ce champ ne  peut être vide';
          $isSuccess = false;
      }
      if(empty($de_0_100km_h )){
          $de_0_100km_hError = 'Ce champ ne  peut être vide';
          $isSuccess = false;
      }
      if(empty($miseEnCirculation )){
        $miseEnCirculationError = 'Ce champ ne  peut être vide';
        $isSuccess = false;
      }
      if(empty($prix )){
        $priceError = 'Ce champ ne  peut être vide';
        $isSuccess = false;
      }
      if(empty($category )){
        $categoryError = 'Ce champ ne  peut être vide';
        $isSuccess = false;
      }
      if(empty($image )){
        $imageError = 'Ce champ ne  peut être vide';
        $isSuccess = false;
      }
      else{
          $isUploadSuccess = true;
          if($imageExtension !="jpg" && $imageExtension !="png" && $imageExtension !="jpeg" && $imageExtension !="gif"){
              
               $imageError = "les fichiers autorisés sont: .jpg, .jpeg, .png, .gif";
               $isUploadSuccess = false;
          }
          if(file_exists($imagePath)){
              
               $imageError = "Le fichier existe déjà .";
               $isUploadSuccess = false;
          }
          if($_FILES["image"]["size"] > 500000){
              
               $imageError = "Le fichier de doit pas dépasser les 500KB";
               $isUploadSuccess = false;
          }
          if($isUploadSuccess){
              if(!move_uploaded_file($_FILES["image"]["tmp_name"],$imagePath)){
                  
                  $imageError = "Il y a eu une erreur pendant l'upload";
                  $isUploadSuccess = false;
              }
          }
      }
      if($isSuccess && $isUploadSuccess){
          $db = Database::connect();
          $statement = $db->prepare("INSERT INTO items (marque,modele,moteur,couple,de_0_100km_h, miseEnCirculation, prix,`image`, category) values(?,?,?,?,?,?,?,?,?)");
          $statement->execute(array( $marque,$modele,$moteur,$couple,$de_0_100km_h,$miseEnCirculation,$prix,$image,$category));
          Database::disconnect();
        header("Location: index.php");
      }
  }


function checkInput($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}




?>

<!DOCTYPE html>
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
    
    
    
    <body class="ajoutParking">
            <div class="container admin">
              <div class="row">
              <div class="col-sm-12">
                  <a class="ajout" href="index.php">Retour</a>
                <h1><strong>Ajouter une Voiture </strong></h1>
                      <br>
                  
                      <form class="form" role="form" action="insert.php" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                              <label for="marque">Marque : </label>
                              <input type="text"  id="marque" name="marque" placeholder="Bmw.." value="<?= $marque; ?>">
                              <span class="help-inline"><?= $marqueError; ?></span>
                           </div>
                           <div class="form-group">
                              <label for="modele">Modele : </label>
                              <input type="text" id="modele" name="modele" placeholder="M3" value="<?= $modele; ?>">
                              <span class="help-inline"><?= $modeleError; ?></span>
                            </div>
                            <div class="form-group">
                              <label for="moteur">Moteur : </label>
                              <input type="text"  id="moteur" name="moteur" placeholder="3.0L V6 24s" value="<?= $moteur; ?>">
                              <span class="help-inline"><?= $moteurError; ?></span>
                            </div>
                            <div class="form-group">
                              <label for="couple">Couple : </label>
                              <input type="text" id="couple" name="couple" placeholder="539Nm" value="<?php echo $couple; ?>">
                              <span class="help-inline"><?= $coupleError; ?></span>
                            </div>
                            <div class="form-group">
                              <label for="de_0_100km_h">Accelération de 0 à 100 km/h : </label>
                              <input type="text"  id="de_0_100km_h" name="de_0_100km_h" placeholder="3.5s" value="<?= $de_0_100km_h; ?>">
                              <span class="help-inline"><?= $de_0_100km_hError; ?></span>
                            </div>
                            <div class="form-group">
                              <label for="miseEnCirculation">Mise en Circulation : </label>
                              <input type="text" id="miseEnCirculation" name="miseEnCirculation" placeholder="2020-05-14" value="<?= $miseEnCirculation; ?>">
                              <span class="help-inline"><?= $miseEnCirculationError; ?></span>
                            </div>
                           <div class="form-group">
                              <label for="prix">Prix:  (en €)</label>
                              <input type="number" step="0.01" id="prix" name="prix" placeholder="35000" value="<?= $prix; ?>">
                              <span class="help-inline"><?= $prixError; ?></span>
                           </div>
                           <div class="form-group">
                               <label for="category">Catégorie : </label>
                              <select  id="category" name="category">
                                <?php
                                  $db = Database::connect();
                                  foreach($db->query('SELECT * FROM categories') as $row){
                                     echo '<option value="' . $row['id'] .'">' . $row['name'] . '</option>'; 
                                  }
                                   Database::disconnect();
                                  ?>
                               </select>
                              <span class="help-inline"><?=$categoryError; ?></span>
                            
                           </div>
                           <div class="form-group">
                              <label for="image">Sélectionner une image : </label>
                              <input type="file" id="image" name="image">
                              <span class="help-inline"><?= $imageError; ?></span>
                        </div>
                      
                      <br>
                  
                       <div class="form-actions">
                        <button type="submit" class="butAdmin">Ajouter</button>   
                       </div>
                    </form>
                  </div>
            </div>
        </div> 
    	<!-- main js -->
	<script type="text/javascript" charset="utf8" src="../Js/datatables.min.js"></script>
	<script type="text/javascript" charset="utf8" src="../Js/my_datatable.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"></script>
   </body>
    
</html>