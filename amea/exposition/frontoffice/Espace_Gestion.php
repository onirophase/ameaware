<?php
require '../../composants/Bdd.php';
require '../../composants/Client.php';
session_start();

if(!isset($_SESSION['id_client'])){
header('location: index.php');
exit;
}



$_idClient = $_SESSION['id_client'];

$client = new Client();

$client->rechercher($_idClient);


// include('connexion.php'); // On se connecte à la base MySQL

// /* RECUPERATION DONNEES CLIENT */
// $requete = $bdd->prepare("SELECT * FROM t_clients WHERE id_client =  :id"); // La requête SQL qui vérifie si le mail existe
// $requete->bindValue(':id', $idClient, PDO::PARAM_INT); // Faire correspondre l'information ":id" dans la requête avec la variable $idClient et sécurité anti-piratage
// $requete->execute();  // Executer la requête

// $data = $requete->fetch(); // On met les données de la requête  dans la variable $data sous forme de tableau


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  
  <link href="./css/style.css" rel="stylesheet">
  
  <title>Espace client</title>
  </head>
  <body>
  
  <?php  include("Menu.php"); ?>
  
  <h1 class="formulaire">Espace client</h1>
  
  <p class="formulaire">Bienvenue sur votre espace client.</p>

  <?php echo $client->extraire(); ?>	   
  </body>
</html>