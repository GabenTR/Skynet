<?php
	function exist_nom($bdd, $nom)
	{
		$sql = "SELECT count(nomUser) AS existant FROM compte WHERE nomUser=?";
		$reponse = $bdd->prepare($sql);
		$reponse->execute(array($nom));
		
		while ($result = $reponse->fetch())
			$nb = $result["existant"];
		
		$result->close(); //ERREUR ICI
		$reponse->close();
		
		return $nb;
	}
	
	function get_password($bdd, $nom, $password)
	{
		$sql = "SELECT count(motDePasse) AS concordance FROM compte WHERE nomUser=? AND motDePasse=?";
		$response = $bdd->prepare($sql);
		$reponse->execute(array($nom,$password));
		
		while ($result = $reponse->fetch())
			$nb = $result["concordance"];
		
		$result->close();
		$reponse->close();
		
		return $nb;
	}
	
	//fonction de test à implémenter dans le code de connexion
	//Cette fonction admet que les champs $_POST["nom"] et $_POST["password"] ne sont pas vides
	function check_profile($bdd, $nom, $password)
	{
		if (exist_nom($bdd, $nom) == 1)
		{
			if (getPassword($bdd, $nom, $password) == 1)
			{
				echo '<div class="login_text_message"><p>Connecté.
				<p><a href="./login.php">Retour</a></p></div>';
			}
			else
			{
				echo '<div class="login_text_message"><p>Votre mdp nest pas bon.
				<p><a href="./login.php">Retour</a></p></div>';
			}
		}
		else
		{
			echo '<div class="login_text_message"><p>Username incorrect.
			<p><a href="./login.php">Retour</a></p></div>';
		}
	}
?>