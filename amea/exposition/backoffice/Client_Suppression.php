<?php 
	require '../../composants/Bdd.php';
	require '../../composants/Client.php';
	$_idClient = 0;
	
	if ( !empty($_GET['idClient'])) {
		$_idClient = $_REQUEST['idClient'];
	}
	
	if ( !empty($_POST)) {
		// keep track post values
		$_idClient = $_POST['idClient'];
		// delete data
// 		$pdo = DataBdd::connect();
// 		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 		$sql = "DELETE FROM client WHERE id = ?";
// 		$q = $pdo->prepare($sql);
// 		$q->execute(array($idClient));
// 		DataBdd::disconnect();
		$client = new Client();
		$client->rechercher($_idClient);
		echo $client->extraire();
		$client->supprimer();
		header("Location: Client_GestionListe.php");
		
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
		    			<h3>Supprimer un client</h3>
		    		</div>
		    		
	    			<form class="form-horizontal" action="Client_Suppression.php" method="post">
	    			  <input type="hidden" name="idClient" value="<?php echo $_idClient;?>"/>
					  <p class="alert alert-error">Etes vous sûr de supprimer le client [<?php echo $_idClient;?>]?</p>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-danger">Oui</button>
						  <a class="btn" href="Client_GestionListe.php">Non</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>