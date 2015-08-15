<?php
	function exist_nom($bdd, $nom)
	{
		$sql = "SELECT count(nom) AS existant FROM Profil WHERE nom=?";
		$reponse = $bdd->prepare($sql);
		$reponse->execute(array($nom));
		
		while ($result = $reponse->fetch())
			$nb = $result["existant"];
		
		$result->close();
		$reponse->close();
		
		return $nb;
	}
	
	function get_password($bdd, $nom, $password)
	{
		$sql = "SELECT count(motdepasse) AS concordance FROM Profil WHERE nom=? AND motdepasse=?";
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
				//your source code
			}
			else
			{
				//your source code
			}
		}
		else
		{
			//your source code
		}
	}
?>