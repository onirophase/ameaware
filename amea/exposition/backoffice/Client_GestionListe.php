<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    		<div class="row">
    			<h3>GÃ©rer les clients +</h3>
    		</div>
			<div class="row">
				<p>
					<a href="Client_Edition.php" class="btn btn-success">CrÃ©er</a>
				</p>
				
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>Nom/prénom</th>
		                  <th>Nature</th>
		                  <th>Addresse email</th>
		                  <th>Numéro de mobile</th>
		                  <th>Action</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
					   require '../../composants/Bdd.php';
					   require '../../composants/Client.php';
					   
					   $pdo = Bdd::connecter();
					   
					   $sql = 'SELECT * FROM client ORDER BY id DESC';
	 				   foreach ($pdo->query($sql) as $row) {
	 				   	         
						   		echo '<tr>';
// 							   	echo '<td>'. $row['nom'] . " " . $row['prenom'] . '</td>';
// 							   	echo '<td>'. $row['email'] . '</td>';
// 							   	echo '<td>'. $row['mobile'] . '</td>';
								$client = new Client();
								$client->charger($row);
								if($client->etat=="actif"){
									$color = 'btn-success'; $texte = "On"; $etat="inactif";
								} else { 
									$color = 'btn-danger'; $texte = "Off"; $etat="actif";
									
								}   //echo ($data['client_valide']==1)?'btn-success':'btn-danger';
						   		echo '<td>'. $client->nom . " " . $client->prenom . '</td>';
						   		echo '<td>'. $client->nature . '</td>';
						   		echo '<td>'. $client->email . '</td>';
						   		echo '<td>'. $client->mobile . '</td>';
							   	echo '<td width=300>';
							   	echo '<a class="btn" href="Client_Consultation.php?idClient='.$row['id'].'">Voir</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-success" href="Client_Edition.php?idClient='.$row['id'].'">Modifier</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-danger" href="Client_Suppression.php?idClient='.$row['id'].'">Supprimer</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn '.$color.'" href="Client_Activation.php?idClient='.$row['id'].'&etat='.$etat.'">' . $texte . '</a>';
							   	echo '</td>';
							   	echo '</tr>';
							   	
					   }
					   Bdd::deconnecter();
					  ?>
				      </tbody>
	            </table>
    	</div>
    </div> <!-- /container -->
  </body>
</html>