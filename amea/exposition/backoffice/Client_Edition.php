<?php
require '../../composants/Bdd.php';
require '../../composants/Client.php';
$client = new Client ();
$_idClient = null;
if (! empty ( $_GET ['idClient'] )) {
	$_idClient = $_REQUEST ['idClient'];
}

if (! empty ( $_POST )) {
	// keep track validation errors
	$nomError = null;
	$prenomError = null;
	$emailError = null;
	$fixeError = null;
	$mobileError = null;
	
	// keep track post values
	$nom = $_POST ['nom'];
	$prenom = $_POST ['prenom'];
	$email = $_POST ['email'];
	$fixe = $_POST ['fixe'];
	$mobile = $_POST ['mobile'];
	
	// validate input
	$valid = true;
	if (empty ( $nom )) {
		$nomError = 'Veuillez saisir un nom';
		$valid = false;
	}
	
	if (empty ( $email )) {
		$emailError = 'Veuillez saisir une adresse email';
		$valid = false;
	} else if (! filter_var ( $email, FILTER_VALIDATE_EMAIL )) {
		$emailError = 'Veuillez saisir une adresse email valide';
		$valid = false;
	}
	
	if (empty ( $fixe )) {
		$fixeError = 'Veuillez saisir un numéro de fixe';
		$valid = false;
	}
	
	if (empty ( $mobile )) {
		$mobileError = 'Veuillez saisir un numéro de mobile';
		$valid = false;
	}
	
	if ($valid) {
		$client->id = $_idClient;
		$client->nom = $nom;
		$client->prenom = $prenom;
		$client->email = $email;
		$client->fixe = $fixe;
		$client->mobile = $mobile;
		// insert data
		//$pdo = Bdd::connect ();
		if (null == $_idClient) {
			// $pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			// $sql = "INSERT INTO client (nom,email,mobile) values(?, ?, ?)";
			// $q = $pdo->prepare ( $sql );
			// $q->execute ( array (
			// $nom,
			// $email,
			// $mobile
			// ) );
			
			$client->ajouter ();
		} else {
			// update data
			// $pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			// $sql = "UPDATE client SET nom = ?, email = ?, mobile =? WHERE id = ?";
			// $q = $pdo->prepare ( $sql );
			// $q->execute ( array (
			// $nom,
			// $email,
			// $mobile,
			// $idClient
			// ) );
// 			echo "modifier";
// 			echo $client->extraire();
// 			die();
			$client->modifier ();
		}
		// DataBdd::disconnect ();
		header ( "Location: Client_GestionListe.php" );
	}
} else {
// 	$pdo = DataBdd::connect ();
// 	$pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
// 	$sql = "SELECT * FROM client WHERE id = ?";
// 	$q = $pdo->prepare ( $sql );
// 	$q->execute ( array (
// 			$idClient 
// 	) );
// 	$data = $q->fetch ( PDO::FETCH_ASSOC );
// 	$nom = $data ['nom'];
// 	$email = $data ['email'];
// 	$mobile = $data ['mobile'];
	$client->rechercher($_idClient);
	$nom=$client->nom;
	$prenom=$client->prenom;
	$email=$client->email;
	$fixe=$client->fixe;
	$mobile=$client->mobile;
//	DataBdd::disconnect ();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container">

		<div class="span10 offset1">
			<div class="row">
				<?php if (null == $_idClient) { ?>
				<h3>CrÃ©er un client</h3>
				<?php } else {?>
				<h3>Modifier un client</h3>
				<?php }?>
			</div>

			
			<?php if (null == $_idClient) { ?>
				<form class="form-horizontal" action="Client_Edition.php"
				method="post">
				<?php } else {?>
				<form class="form-horizontal"
					action="Client_Edition.php?idClient=<?php echo $_idClient?>"
					method="post">
				<?php }?>
					<div
						class="control-group <?php echo !empty($nomError)?'error':'';?>">
						<label class="control-label">Nom :</label>
						<div class="controls">
							<input name="nom" type="text" placeholder="Nom"
								value="<?php echo !empty($nom)?$nom:'';?>">
					      	<?php if (!empty($nomError)): ?>
					      		<span class="help-inline"><?php echo $nomError;?></span>
					      	<?php endif; ?>
					    </div>
					</div>
					
					<div
						class="control-group <?php echo !empty($prenomError)?'error':'';?>">
						<label class="control-label">Prenom :</label>
						<div class="controls">
							<input name="prenom" type="text" placeholder="Nom"
								value="<?php echo !empty($prenom)?$prenom:'';?>">
					      	<?php if (!empty($prenomError)): ?>
					      		<span class="help-inline"><?php echo $prenomError;?></span>
					      	<?php endif; ?>
					    </div>
					</div>
					<div
						class="control-group <?php echo !empty($emailError)?'error':'';?>">
						<label class="control-label">Adresse email :</label>
						<div class="controls">
							<input name="email" type="text" placeholder="Addresse email"
								value="<?php echo !empty($email)?$email:'';?>">
					      	<?php if (!empty($emailError)): ?>
					      		<span class="help-inline"><?php echo $emailError;?></span>
					      	<?php endif;?>
					    </div>
					</div>
					
					<div
						class="control-group <?php echo !empty($fixeError)?'error':'';?>">
						<label class="control-label">Numéro de fixe :</label>
						<div class="controls">
							<input name="fixe" type="text" placeholder="Numéro de fixe"
								value="<?php echo !empty($fixe)?$fixe:'';?>">
					      	<?php if (!empty($fixeError)): ?>
					      		<span class="help-inline"><?php echo $fixeError;?></span>
					      	<?php endif;?>
					    </div>
					</div>
					
					<div
						class="control-group <?php echo !empty($mobileError)?'error':'';?>">
						<label class="control-label">Numéro de mobile :</label>
						<div class="controls">
							<input name="mobile" type="text" placeholder="Numéro de mobile"
								value="<?php echo !empty($mobile)?$mobile:'';?>">
					      	<?php if (!empty($mobileError)): ?>
					      		<span class="help-inline"><?php echo $mobileError;?></span>
					      	<?php endif;?>
					    </div>
					</div>
					<div class="form-actions">
				<?php if (null == $_idClient) { ?>
				<button type="submit" class="btn btn-success">CrÃ©er</button>
				<?php } else {?>
				<button type="submit" class="btn btn-success">Modifier</button>
				<?php }?>
					<a class="btn" href="Client_GestionListe.php">Retour</a>
					</div>
				</form>
		
		</div>

	</div>
	<!-- /container -->
</body>
</html>