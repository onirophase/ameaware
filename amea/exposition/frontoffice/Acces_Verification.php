<?php
require '../../composants/Bdd.php';
require '../../composants/Client.php';
session_start();
/*
Script de login à l'espace client
*/
$client = new Client();
$_email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); // Vérifier que l'email est valide et ne serve pas au piratage de la base
$_pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING); // Vérifier que le mot de passe ne serve pas au piratage (FILTER_SANITIZE_STRING : chaine de caractère)

if( $_email === false ) {
header('location: Acces_Loging.php?err=mail');  // Si l'email est mal formé on retourne sur la page login.
exit;  // Stop
}  

//include("connexion.php"); // On se connecte à la base MySQL

/* VERIFICATION DU MAIL */
// $requete = $bdd->prepare("SELECT id_client FROM t_clients WHERE mail_client = :mail"); // La requête SQL qui vérifie si le mail existe
// $requete->bindValue(':mail', $mail, PDO::PARAM_STR); // Faire correspondre l'information ":mail" dans la requête avec la variable $mail et sécurité anti-piratage
// $requete->execute();  // Executer la requête

// $donnees = $requete->fetch(); // On met les données de la requête en forme de tableau dans la variable $donnees (obligatoire)

// $idClient = $donnees['id_client'];

$ok = $client->rechercherParEmail($_email);
// echo "recherche=" . $ok;
// die;
// Si l'email est non trouvé on retourne sur la page login.
//if($donnees === false) {
	
if( $ok == FALSE ) {	
	header('location: Acces_Loging.php?err=mail');   
exit;
} 

/* VERIFICATION DE L'ACCES VALIDE */
// $requete = $bdd->prepare("SELECT client_valide FROM t_clients WHERE id_client = :id"); // La requête SQL qui vérifie si l'accs est valide pour le client n° "id"
// $requete->bindValue(':id', $idClient, PDO::PARAM_INT); // Faire correspondre l'information ":id" dans la requête avec la variable $donnees['id_client'] et sécurité anti-piratage
// $requete->execute();  // Executer la requête

// $validite = $requete->fetch(); // On met les données de la requête sous forme de tableau dans la variable $validite

// // Si l'accèes est non-valide on retourne sur la page login.
// if($validite['client_valide'] == 0) {
// header('location: login.php?err=valide');   
// exit;
// } 

/* VERIFICATION DU MOT DE PASSE */
// La requête SQL qui récupère le mot de passe dans la base de données en fonction de l'id client 
// $requete = $bdd->prepare("SELECT mdp_client FROM t_clients WHERE id_client = :id"); 
// $requete->bindValue(':id', $idClient, PDO::PARAM_INT); // Faire correspondre ":id" dans la requête avec le numéro client dans la variable $donnees['id_client']
// $requete->execute();  // Executer la requête

// $donnees = $requete->fetch(); // On met les données de la requête en forme de tableau dans $données

// Si le mot de passe est incorrect on retourne sur la page login.

// echo $client->extraire();
// //echo md5(SALT.$_pass);
// echo "[" . $_pass ."]";
// die;

if( $client->etat!=actif) {
	header('location: Acces_Loging.php?err=inactif');
	exit;
}

if( md5(SALT.$_pass) != $client->pass) {
header('location: Acces_Loging.php?err=mail');   
exit;
}

$_SESSION['id_client'] = $client->id;

//$requete->CloseCursor(); // Fin des requêtes
header('location: Espace_Gestion.php');
?>