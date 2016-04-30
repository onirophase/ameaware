<?php
class Client {
	// Attributs
	public $id;
	public $nom;
	public $prenom;
	public $nature;
	public $etat;
	public $fixe;
	public $email;
	public $mobile;
	
	// Méthodes
	public function __construct() {
	}
	public function rechercher($_id) {
		$ok = TRUE;
		$pdo = Bdd::connecter ();
		$pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$sql = "SELECT id,nom,prenom,nature,etat,email,fixe,mobile,pass FROM client WHERE id = ?";
		$q = $pdo->prepare ( $sql );
		$q->execute ( array (
				$_id 
		) );
		$data = $q->fetch ( PDO::FETCH_ASSOC );
		$this->id = $data ['id'];
		$this->nom = $data ['nom'];
		$this->prenom = $data ['prenom'];
		$this->nature = $data ['nature'];
		$this->etat = $data ['etat'];
		$this->email = $data ['email'];
		$this->fixe = $data ['fixe'];
		$this->mobile = $data ['mobile'];
		$this->pass = $data ['pass'];
		Bdd::deconnecter ();
		return $ok;
	}
	public function rechercherParEmail($_email) {
		$ok = TRUE;
		$pdo = Bdd::connecter ();
		$pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$sql = "SELECT id,nom,prenom,nature,email,fixe,mobile,pass,etat FROM client WHERE email = ?";
		$q = $pdo->prepare ( $sql );
		$q->execute ( array (
				$_email 
		) );
		$nb = $q->rowCount ();
		if ($nb > 0) {
			$data = $q->fetch ( PDO::FETCH_ASSOC );
			
			$this->id = $data ['id'];
			$this->nom = $data ['nom'];
			$this->prenom = $data ['prenom'];
			$this->nature = $data ['nature'];
			$this->email = $data ['email'];
			$this->fixe = $data ['fixe'];
			$this->mobile = $data ['mobile'];
			$this->pass = $data ['pass'];
			$this->etat = $data ['etat'];
		} else {
			$ok=FALSE;
		}
		Bdd::deconnecter ();
		return $ok;
	}
	public function ajouter() {
		$ok = TRUE;
		$pdo = Bdd::connecter ();
		$pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$sql = "INSERT INTO client (nom,prenom,email,fixe,mobile,etat) values(?, ?, ?, ?, ?, ?, ?)";
		$q = $pdo->prepare ( $sql );
		if($this->nature=="") {
			$this->nature="professionnel";
		}
		if($this->etat=="") {
			$this->etat="actif";
		}
		$q->execute ( array (
				$this->nom,
				$this->prenom,
				$this->email,
				$this->fixe,
				$this->mobile,
				$this->nature,
				$this->etat
		) );
		Bdd::deconnecter ();
		return $ok;
	}
	public function ajouterProspect() {
		$ok = TRUE;
		$pdo = Bdd::connecter ();
		$pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$sql = "INSERT INTO client (nom,prenom,email,fixe,mobile,nature,etat,pass) values(?, ?, ?, ?, ?, ?, ?, ?)";
		$q = $pdo->prepare ( $sql );
		if($this->nature=="") {
			$this->nature="professionnel";
		}
		if($this->etat=="") {
			$this->etat="actif";
		}
		$q->execute ( array (
				$this->nom,
				$this->prenom,
				$this->email,
				$this->fixe,
				$this->mobile,
				$this->nature,
				$this->etat,
				$this->pass 
		) );
		Bdd::deconnecter ();
		return $ok;
	}
	public function modifier() {
		$ok = TRUE;
		
		$pdo = Bdd::connecter ();
		$pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		if($this->nature=="") {
			$this->nature="professionnel";
		}
		if($this->etat=="") {
			$this->etat="actif";
		}
		$sql = "UPDATE client SET nom = ?, prenom = ?, nature = ?, etat = ?, email = ?,fixe = ?, mobile = ? WHERE id = ?";
		$q = $pdo->prepare ( $sql );
		$q->execute ( array (
				$this->nom,
				$this->prenom,
				$this->nature,
				$this->etat,
				$this->email,
				$this->fixe,
				$this->mobile,
				$this->id 
		) );
		
		
		if ($this->pass != null or $this->pass != "") {
			$sql = "UPDATE client SET
					pass = ? WHERE id = ?";
			$q = $pdo->prepare ( $sql );
			$q->execute ( array (
					$this->pass,
					$this->id 
			) );
		}
		
		Bdd::deconnecter ();
		return $ok;
	}
	public function supprimer() {
		$ok = TRUE;
		
		$pdo = Bdd::connecter ();
		$pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$sql = "DELETE FROM client WHERE id = ?";
		$q = $pdo->prepare ( $sql );
		$q->execute ( array (
				$this->id 
		) );
		Bdd::deconnecter ();
		
		return $ok;
	}
	public function charger($_row) {
		$ok = TRUE;
		$this->id = $_row ['id'];
		$this->nom = $_row ['nom'];
		$this->prenom = $_row ['prenom'];
		$this->nature = $_row ['nature'];
		$this->etat = $_row ['etat'];
		$this->email = $_row ['email'];
		$this->fixe = $_row ['fixe'];
		$this->mobile = $_row ['mobile'];
		$this->pass = $_row ['pass'];
		return $ok;
	}
	public function extraire() {
		$retour = "";
		$retour .= "\nId = " . $this->id . ", ";
		$retour .= "\nNom=" . $this->nom . ", ";
		$retour .= "\nPrenom=" . $this->prenom . ", ";
		$retour .= "\nNature = " . $this->nature . ", ";
		$retour .= "\nEtat = " . $this->etat . ", ";
		$retour .= "\nEmail = " . $this->email . ", ";
		$retour .= "\nFixe = " . $this->fixe . ", ";
		$retour .= "\nMobile = " . $this->mobile . ", ";
		$retour .= "\nPass = " . $this->pass . ", ";
		
		
		return $retour;
	}
	public function rechercherListe() {
		$pdo = Bdd::connecter ();
		$sql = 'SELECT * FROM client ORDER BY id DESC';
	}
}