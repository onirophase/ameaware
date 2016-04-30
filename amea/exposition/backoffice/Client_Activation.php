<?php
require '../../composants/Bdd.php';
require '../../composants/Client.php';
$_idClient = filter_input(INPUT_GET, 'idClient', FILTER_SANITIZE_NUMBER_INT); // Filtrer le n° client
$_etat = filter_input(INPUT_GET, 'etat', FILTER_SANITIZE_STRING); // Filtrer le n° client
// $initiales = filter_input(INPUT_GET, 'init', FILTER_SANITIZE_STRING); // Filtrer le n° client


// include ('connexion.php');

// /* CHANGER L'ACCES */
// $requete = $bdd->prepare("UPDATE t_clients SET client_valide = :val WHERE id_client = :id"); 
// $requete->bindValue(':val', $val, PDO::PARAM_INT);
// $requete->bindValue(':id', $idClient, PDO::PARAM_INT);
// $requete->execute();  // Executer la requête

// $requete->closecursor();

// // Création du dossier du client sur FTP
// // Sur Trust telecom, remplacer c:/wamp/www/exercice/clients/ par /www/clients/

// if($val == 1) @mkdir("c:/wamp/www/exercice/clients/".$initiales.$idClient, 0700);

$client = new Client();
$client->rechercher($_idClient);
$client->etat=$_etat;
// echo $client->extraire();
// die;
$client->modifier();


header('location: Client_GestionListe.php');

?>