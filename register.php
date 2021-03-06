<?php
	include('connexion.php');

	$nom_utilisateur = $_POST['nom'];
	$prenom_utilisateur = $_POST['prenom'];
	$mdp_utilisateur = sha1($_POST['mdp']);
	$cmdp_utilisateur = sha1($_POST['cmdp']);
	$mail_utilisateur = $_POST['mail'];
	$secret_utilisateur = $_POST['secret'];

	$recherche = $bdd->prepare('SELECT mail_utilisateur FROM utilisateur WHERE mail_utilisateur= :mail_utilisateur');
	$recherche->execute(array(
		'mail_utilisateur' => $mail_utilisateur));
	$verif = $recherche->fetch();

	if ($mdp_utilisateur == $cmdp_utilisateur AND !$verif)
	{
		$req = $bdd->prepare('INSERT INTO utilisateur VALUES (:id_utilisateur,:nom_utilisateur,:prenom_utilisateur,:mdp_utilisateur,:mail_utilisateur,:secret_utilisateur,:admin,:confirme)');
		$req->execute(array(
			'id_utilisateur' => NULL,
			'nom_utilisateur' => $nom_utilisateur,
			'prenom_utilisateur' => $prenom_utilisateur,
			'mdp_utilisateur' => $mdp_utilisateur,
			'mail_utilisateur' => $mail_utilisateur,
			'secret_utilisateur' => $secret_utilisateur,
			'admin' => false,
			'confirme' => false));

		header("location: ./index.php?register=ok");
        exit();
	}
	else
	{
		header("location: ./index.php?register=ko");
        exit();
	}
?>