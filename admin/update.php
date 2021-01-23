<?php
  session_start();
   if(!isset($_SESSION['email'])){
    
     header("Location: login.php");
//exit();
 }
$sMessage = "";
require 'database.php';

//GET->Récuperer id Au premier passage
if (!empty($_GET['id'])){
    $id = checkInput($_GET['id']);//Variables super globale GET
} 

   
    $marqueError = $modeleError = $chevauxError = $vitesseMaxError = $moteurError = $coupleError = $de_0_100km_hError = $miseEnCirculationError = $prixError = $categoryError= $imageError  = $marque = $modele = $chevaux = $vitesseMax = $moteur = $couple = $de_0_100km_h = $miseEnCirculation = $prix =  $category = $image ="";
    //Si la variable post est pas vide alors nettoyage checkInput et rempli toutes les variables
    if(!empty($_POST)){
      
      $marque           = checkInput($_POST['marque']);//Variables super globale POST
      $modele           = checkInput($_POST['modele']);
      $chevaux          = checkInput($_POST['chevaux']);
      $vitesseMax       = checkInput($_POST['vitesseMax']);
      $moteur           = checkInput($_POST['moteur']);
      $couple           = checkInput($_POST['couple']);
      $de_0_100km_h     = checkInput($_POST['de_0_100km_h']);
      $miseEnCirculation= checkInput($_POST['miseEnCirculation']);
      $prix             = checkInput($_POST['prix']);
      $category         = checkInput($_POST['category']);
      $image            = checkInput($_FILES['image']['name']);//Variables super globale FILES
      $imagePath        = '../images/'  . basename($image);
      $imageExtension   = pathinfo($imagePath,PATHINFO_EXTENSION);
      $isSuccess        = true; 
      //Cas d'erreurs sur les inputs
      if(empty($marque)){
          $marqueError = 'Ce champ ne  peut être vide';
          $isSuccess = false;
      }
      if(empty($modele)){
          $modeleError = 'Ce champ ne  peut être vide';
          $isSuccess = false;
      }
      if(empty($chevaux)){
        $chevauxError = 'Ce champ ne  peut être vide';
        $isSuccess = false;
    }
    if(empty($vitesseMax)){
        $vitesseMaxError = 'Ce champ ne  peut être vide';
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
        $isImageUpdated = false;
      }
      else{
            $isImageUpdated = true;
            $isUploadSuccess = true;
            //Si l'extension de image et différente de  alors imageError,isUploadSuccess est faux
            if($imageExtension !="jpg" && $imageExtension !="png" && $imageExtension !="jpeg" && $imageExtension !="gif"){
                
                $imageError = "les fichiers autorisés sont: .jpg, .jpeg, .png, .gif";
                $isUploadSuccess = false;
            }
            //Si le fichier existe alors imageError
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
        //2 Cas de succes du update form 
        // le cas 1 :  tout est bon, isSucces est égale à true 
        //le cas 2 :  si modification avec image a été updaté alors isUploadSuccess à true,si modification avec image pas updaté alors isSuccess =true
        if(($isSuccess && $isImageUpdated && $isUploadSuccess) || ($isSuccess && !$isImageUpdated)){
                $db = Database::connect();

                if($isImageUpdated){
                        $statement = $db->prepare("UPDATE items SET marque = ?,modele = ?,chevaux = ?,vitesseMax = ?,moteur = ?,couple = ?,de_0_100km_h = ?, miseEnCirculation = ?, prix = ?,`image` = ?, category = ? WHERE id = ?");
                        $statement->execute(array( $marque,$modele,$chevaux,$vitesseMax,$moteur,$couple,$de_0_100km_h,$miseEnCirculation,$prix,$image,$category,$id));
                      
                }
                else{
                    $statement = $db->prepare("UPDATE items SET marque = ?,modele = ?,chevaux = ?,vitesseMax = ?,moteur = ?,couple = ?,de_0_100km_h = ?, miseEnCirculation = ?, prix = ?,category = ? WHERE id = ?");
                    $statement->execute(array( $marque,$modele,$chevaux,$vitesseMax,$moteur,$couple,$de_0_100km_h,$miseEnCirculation,$prix,$category,$id));
                 
                    
                }
            
            Database::disconnect();
            if (count($_POST)>0) $sMessage = "La voiture a bien été Modifiée !"; 
            header("Location: index.php");
        }
        //Sinon si image a été updaté et que upload à echoué =false
         else if($isImageUpdated && !$isUploadSuccess){

             $db = Database::connect();
             $statement = $db->prepare("SELECT `image` FROM items WHERE id = ?");
             $statement->execute(array($id));
             $item = $statement->fecth();
             //On remet l'image dans la var image
             $image = $item['image'];
             Database::disconnect();
         }
    }

//1er passage avant de cliquer sur modifier
// Recupérer et afficher les valeurs de l'item A updaté dans les inputs
else{
    $db = Database::connect();
    $statement = $db->prepare("SELECT * FROM items WHERE id = ?");
    $statement->execute(array($id));
    $item = $statement->fetch();
    $marque = $item['marque'];
    $modele = $item['modele'];
    $chevaux = $item['chevaux'];
    $vitesseMax = $item['vitesseMax'];
    $moteur = $item['moteur'];
    $couple = $item['couple'];
    $de_0_100km_h = $item['de_0_100km_h'];
    $miseEnCirculation = $item['miseEnCirculation'];
    $prix = $item['prix'];
    $image = $item['image'];
    $category = $item['category'];
 Database::disconnect();

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
                    <div class="col-sm-5">
                        <form class="form" role="form" action="<?= 'update.php?id=' . $id; ?>" method="post" enctype="multipart/form-data">
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
                                <label for="chevaux">Chevaux : </label>
                                <input type="text" id="chevaux" name="chevaux" placeholder="300" value="<?= $chevaux; ?>">
                                <span class="help-inline"><?= $chevauxError; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="vitesseMax">Vitesse Max : </label>
                                <input type="text" id="vitesseMax" name="vitesseMax" placeholder="220" value="<?= $vitesseMax; ?>">
                                <span class="help-inline"><?= $vitesseMaxError; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="moteur">Moteur : </label>
                                <input type="text"  id="moteur" name="moteur" placeholder="3.0L V6 24s" value="<?= $moteur; ?>">
                                <span class="help-inline"><?= $moteurError; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="couple">Couple : </label>
                                <input type="text" id="couple" name="couple" placeholder="539Nm" value="<?= $couple; ?>">
                                <span class="help-inline"><?= $coupleError; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="de_0_100km_h"> 0 à 100 km/h : </label>
                                <input type="text" id="de_0_100km_h" name="de_0_100km_h" placeholder="3.5s" value="<?= $de_0_100km_h; ?>">
                                <span class="help-inline"><?= $de_0_100km_hError; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="miseEnCirculation">Année : </label>
                                <input type="text" id="miseEnCirculation" name="miseEnCirculation" placeholder="2020-05-14" value="<?= $miseEnCirculation; ?>">
                                <span class="help-inline"><?= $miseEnCirculationError; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="prix">Prix:(en €)</label>
                                <input type="number" step="0.01" id="prix" name="prix" placeholder="35000" value="<?= $prix; ?>">
                                <span class="help-inline"><?= $prixError; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="nomImage">Image</label>
                                <input  type="text"name="nomImage" value=<?= $image ?>>
                            </div>
                            <div class="form-group">
                                <label for="category">Catégorie : </label>
                                <select  id="category" name="category">
                                    <?php
                                    $db = Database::connect();
                                    foreach($db->query('SELECT * FROM categories') as $row){
                                        if($row['id'] == $category)
                                           echo '<option selected="selected" value="' . $row['id'] .'">' . $row['name'] . '</option>'; 
                                        else
                                            echo '<option  value="' . $row['id'] .'">' . $row['name'] . '</option>'; 
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
                                <button type="submit" class="butAdmin">Modifier</button>   
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-7">
                        <a class="ajout" href="index.php">Retour</a>
                        <h1><strong>Modifier la Voiture </strong></h1> 
                        <img src="<?= '../images/' .  $item['image'] ; ?>" alt="...">
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