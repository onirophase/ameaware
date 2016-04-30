<?php
session_start();
require '../../composants/Bdd.php';
require '../../composants/Client.php';

//var_dump($_POST);

// Filtrage des données de formulaire
$nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
$prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
$nature = filter_input(INPUT_POST, 'nature', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);  // Vérifie si c'est une adresse mail valide
$fixe = filter_input(INPUT_POST, 'fixe', FILTER_SANITIZE_STRING);
$mobile = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_STRING);
$pass1 = filter_input(INPUT_POST, 'pass1', FILTER_SANITIZE_STRING);
$pass2 = filter_input(INPUT_POST, 'pass2', FILTER_SANITIZE_STRING);

// Mettre les données du formulaire en session (sauf mots de passe)
$_SESSION['nom']     = $nom;
$_SESSION['prenom']  = $prenom;
$_SESSION['nature'] = $nature;
$_SESSION['email']    = $email;
$_SESSION['fixe']     = $fixe;
$_SESSION['mobile']     = $mobile;

// Est-ce que tous les champs sont remplis ?
if($nom == "" OR $prenom == "" OR $nature == "" OR $fixe == "" OR $mobile == "" OR $pass1 == "" OR $pass2 == "" ){

header('location: Acces_Inscription.php?err=vide');  // Si le formulaire est incomplet on retourne sur la page inscription.
exit;  // Stop
}

if( $email === false ) { header('location: Acces_Inscription.php?err=email'); exit; } // L'email est-il correct ?

if( $pass1 != $pass2 ) { header('location: Acces_Inscription.php?err=pass'); exit; } // Les mots de passe sont-ils différents ?

//include("connexion.php"); // On se connecte à la base MySQL

// Criptage du mot de passe

$client = new Client();
$client->nom = $nom;
$client->prenom = $prenom;
$client->email = $email;
$client->fixe = $fixe;
$client->mobile = $mobile;
$client->nature = $nature;
$client->etat = "actif";
$client->pass = md5(SALT.$pass1);
//$client->pass = $pass1;

// echo $client->extraire();
// die;

$client->ajouterProspect();

/* INSERTION DES DONNEES DANS LA BASE */
// $requete = $bdd->prepare("INSERT INTO t_clients (nom_client, prenom_client, ste_client, mail_client, tel_client, mdp_client) VALUES (:nom, :prenom, :societe, :mail, :tel, :pass)"); // La requête SQL qui insere les données dans la table t_client
// $requete->bindValue(':nom', $nom, PDO::PARAM_STR);
// $requete->bindValue(':prenom', $prenom, PDO::PARAM_STR);
// $requete->bindValue(':societe', $nature, PDO::PARAM_STR);
// $requete->bindValue(':mail', $mail, PDO::PARAM_STR);
// $requete->bindValue(':tel', $tel, PDO::PARAM_STR);
// $requete->bindValue(':pass', $pwd_crypte, PDO::PARAM_STR);

// $requete->execute();  // Executer la requête

// $requete->closeCursor();

session_destroy();

$message_mail = "
<p>Bonjour</p>
<p>Une nouvelle inscription a été faite sur le site :</p>
<p>Nom : " . $nom . "</p>
<p>Prénom : " . $prenom . "</p>
<p>Status : " . $nature . "</p>
<p>Mail : " . $mail . "</p>
<p>Tél : " . $tel . "</p>";  

$header_mail = "
From: \"AEMEA\"<dest@.emeafr>\r\n
Reply-to: \"AEMEA\"<dest@.emeafr>\r\n
MIME-Version: 1.0\r\n
Content-Type: text/html; charset=UTF-8";

@mail("dest@emea.fr", "Nouvelle inscription", $message_mail, $header_mail);

header('location: Acces_ConfirmationInscription.php');  // Rediriger vers la page de remerciement
?>