<?php
$error = filter_input(INPUT_GET, 'err', FILTER_SANITIZE_STRING);  // La variable $error filtre et récupére le mot dans l'URL
 
$message = "";   // Message d'erreur vide

if( $error == "email")  { $message = "<p id='erreur' class='formulaire'>Veuillez vérifier vos identifiants !</p>"; }   // Si $error contient le mot "mail" alors on prépare un message d'erreur dans la variable $message
if( $error == "valide") { $message = "<p id='erreur' class='formulaire'>Accès désactivé, veuillez nous contacter.</p>"; }   // Si $error contient le mot "mail" alors on prépare un message d'erreur dans la variable $message
if( $error == "inactif") { $message = "<p id='erreur' class='formulaire'>Accès désactivé, veuillez nous contacter.</p>"; }   // Si $error contient le mot "mail" alors on prépare un message d'erreur dans la variable $message

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  
  <link href="./css/style.css" rel="stylesheet">
  
  <title>Login</title>
  </head>
  <body>
  
  <?php

 include("Menu.php"); 

?>
  
  <h1 class="formulaire">Login</h1>
  
  <?php
  
  echo $message;  // Afficher le message d'erreur
  
  ?>
  
  <form method="post" action="Acces_Verification.php"  >
       <p class="formulaire"><label>Mail :</label> <input type="text" name="email" /></p>

       <p class="formulaire"><label>Mot de passe :</label> <input type="password" name="pass" /></p>

       <p class="formulaire"><input type="submit" value="Valider" /></p>

  </form>
  
  </body>
</html>
