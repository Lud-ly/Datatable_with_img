<?php
require 'database.php';
session_start();
   
      $email = $password = $error = "";

  if(!empty($_POST)){
      
      $email             = checkInput($_POST['email']);
      $password          = checkInput($_POST['password']);
      
      $db = Database::connect();
      $statement = $db->prepare("SELECT * FROM users WHERE email = ? and password = ?"); 
      $statement->execute(array($email,$password));
      Database::disconnect();
      
      
      if($statement->fetch()){
          
          $_SESSION['email'] = $email;
          header("Location: index.php");
    }
      else{
          $error = "Votre mot de passe ou email sont incorrects";
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
	<link rel="stylesheet" type="text/css" href="../style/login.css">
	<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript" src="../Js/jquery_3_5_1.js"></script>
	<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
    </head>
    
    
    
    <body class="c_hello">
    <div class="container admin">
        <div class="row">
            <div class="login-page">
                <div class="form">
                    <div class="login">
                        <div class="login-header">
                            <h3>Inscription</h3>
                            <p>Please enter your credentials to registration.</p>
                        </div>
                    </div>
                    <form class="login-form">
                        <input type="text" placeholder="username"/>
                        <input type="password" placeholder="password"/>
                        <button>login</button>
                        <p class="message">Not registered? <a href="../index.php">Retour</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"></script>
    </body>
</html>