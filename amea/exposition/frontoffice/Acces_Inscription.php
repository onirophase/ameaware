<?php
session_start();    // Initialiser les sessions, obligatoirement en ligne 2 d'une page PHP

$error = filter_input(INPUT_GET, 'err', FILTER_SANITIZE_STRING);  // La variable $error filtre et rÃ©cupÃ©re le mot dans l'URL

// Initialisation des variables 
$message  = "";   // Message d'erreur vide
$nom      = "";
$prenom   = "";
$nature  = "";
$email     = "";
$fixe      = "";
$mobile      = "";
$checkParticulier = "";
$checkProfesionnel = "";

if( $error != false ){
$nom      = $_SESSION['nom'];
$prenom   = $_SESSION['prenom'];
// $nature  = $_SESSION['nature'];
//$email     = $_SESSION['email'];
$fixe      = $_SESSION['fixe'];
// $mobile      = $_SESSION['mobile'];

  if($nature == "particulier"){ $checkParticulier = "checked='checked'"; }
  if($nature == "professionnel") { $checkProfesionnel  = "checked='checked'"; }
}

if( $error == "vide")  { $message = "<p id='erreur' class='formulaire'>Veuillez remplir tous les champs.</p>"; }   // Si $error contient le mot "mail" alors on prÃ©pare un message d'erreur dans la variable $message
if( $error == "email") { $message = "<p id='erreur' class='formulaire'>email absent ou invalide.</p>"; }   // Si $error contient le mot "mail" alors on prÃ©pare un message d'erreur dans la variable $message
if( $error == "pass") { $message = "<p id='erreur' class='formulaire'>Mots de passe différents.</p>"; }   // Si $error contient le mot "pass" alors on prÃ©pare un message d'erreur dans la variable $message

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  
  <link href="./css/style.css" rel="stylesheet">
  
  <title>Inscription</title>
  </head>
  <body>
  
  <?php  include("Menu.php"); ?>
  
  <h1 class="formulaire">Inscription</h1>
  
  <p class="formulaire">Tous les champs sont obligatoires</p>
  
  <form method="post" action="Acces_Ajout.php">

       <p class="formulaire"><label>Votre nom :</label> <input type="text" name="nom" value="<?php echo $nom; ?>" /></p>
       <p class="formulaire"><label>Votre prénom :</label> <input type="text" name="prenom" value="<?php echo $prenom; ?>" /></p>
       <p class="formulaire">Vous êtes : <input type="radio" name="nature" value="particulier" <?php echo $checkParticulier; ?> />Particulier <input type="radio" name="nature" value="professionnel" <?php echo $checkProfesionnel; ?> />Professionnel</p>
      <p class="formulaire"><label>Votre tel. fixe</label> <input type="text" name="fixe" value="<?php echo $fixe; ?>" /></p>
       <p class="formulaire"><label>Votre tel. mobile :</label> <input type="text" name="mobile" value="<?php echo $mobile; ?>" /></p>
     
       <p class="formulaire"><label>Votre mail :</label> <input type="text" name="email" value="<?php echo $email; ?>" /></p>
       <p class="formulaire"><label>Choisissez un mot de passe :</label> <input type="password" name="pass1" /></p>
       <p class="formulaire"><label>Confirmez le mot de passe :</label> <input type="password" name="pass2" /></p>
       
       <?php echo $message;  // Afficher le message d'erreur  ?>
       
       <p class="formulaire"><input type="submit" value="Valider" /></p>

  </form>
  
  </body>
</html>