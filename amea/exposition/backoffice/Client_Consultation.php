<?php 
	require '../../composants/Bdd.php';
	require '../../composants/Client.php';
	$client = new Client;
	$_idClient = null;
	if ( !empty($_GET['idClient'])) {
		$_idClient = $_REQUEST['idClient'];
	}
	
	if ( null==$_idClient ) {
		header("Location: gestion_client.php");
	} else {
// 		$pdo = Bdd::connect();
// 		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 		$sql = "SELECT * FROM client WHERE id = ?";
// 		$q = $pdo->prepare($sql);
// 		$q->execute(array($idClient));
// 		$data = $q->fetch(PDO::FETCH_ASSOC);
// 		Bdd::disconnect();
		
		$client->rechercher($_idClient);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Consulter un client</h3>
		    		</div>
		    		
	    			<div class="form-horizontal" >
					  <div class="control-group">
					    <label class="control-label">Nom</label>
					    <div class="controls">
						    <label class="checkbox">
						     	<?php echo $client->nom;?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Adresse mail</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $client->email;?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Numero de mobile</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $client->mobile;?>
						    </label>
					    </div>
					  </div>
					    <div class="form-actions">
						  <a class="btn" href="Client_GestionListe.php">Retour</a>
					   </div>
					
					 
					</div>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>