<?php
session_start();
  if(!isset($_SESSION['email'])){
    
    header("Location: login.php");
}

require 'database.php';

 if(!empty($_GET['id'])){
    $id = checkInput($_GET['id']);
 } 
  if(!empty($_POST)){ 
     
      $id = checkInput($_POST['id']);
      $db = Database::connect();
      $statement = $db->prepare("DELETE FROM items WHERE id = ?");
      $statement->execute(array($id));
      Database::disconnect();
      header("Location: index.php");
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
    
    <body class="c_delete">
            <div class="container admin">
                <div class="row">
                    <div class="col-sm-6">
                        <form class="form" role="form" action="delete.php" method="post">
                            <input type="hidden"  name="id" value="<?=  $id;  ?>"/> 
                            <p class="alert alert-danger">Etes vous sûr de vouloir supprimer cette Voiture ? </p>
                            <div class="form-actions">
                                <button type="submit" class="ajout"><span style="color:green" class="fas fa-ok"></span> Oui</button>   
                                <a class="butAdmin" href="index.php"><span style="color:red" class="fas fa-remove"></span>Non</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <div class="thumbnail">
                           
                        </div>
                        </div>
                    </div>
                </div>
            </div>
         
    
    </body>
    
</html>