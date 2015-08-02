<?php
	function createTableMessage($bdd, $conversation)
	{
		$sql = "CREATE TABLE Message". $conversation ." (idMessage int PRIMARY KEY NOT NULL, contenu text NOT NULL, pseudo int NOT NULL, datePost date NOT NULL, heurePost time NOT NULL, conversation int NOT NULL)";
		//$reponse = $bdd->prepare($sql);
		$reponse = $bdd->query($sql);
		
		$reponse = $bdd->prepare("ALTER TABLE Message". $conversation ." ADD INDEX(conversation)");
		$reponse->execute(array());
		
		$reponse = $bdd->prepare("ALTER TABLE Message". $conversation ." ADD INDEX(pseudo)");
		$reponse->execute(array());

		$sql = "ALTER TABLE Message". $conversation ." ADD CONSTRAINT messageConv FOREIGN KEY (conversation) REFERENCES Conversation(idConversation)";
		$reponse = $bdd->prepare($sql);
		$reponse->execute(array());

		$sql = "ALTER TABLE Message". $conversation ." ADD CONSTRAINT messageOwner FOREIGN KEY (pseudo) REFERENCES Pseudo(idPseudo)";
		$reponse = $bdd->prepare($sql);
		$reponse->execute(array());
	}

	function obtainMessages($bdd, $conversation)
	{
		$sql = "SELECT contenu,Pseudo.nomPseudo,datepost,heurepost FROM Message WHERE Message". $conversation .".pseudo LIKE (SELECT idPseudo FROM Pseudo) AND conversation LIKE (SELECT idConversation FROM Conversation WHERE titre=?)";
		$bdd->prepare($sql);
		$reponse = $bdd->execute(array($conversation));

		return $reponse;
	}

	function addMessage($bdd, $contenu, $pseudo, $date, $heure, $conversation)
	{
		$sql = "INSERT INTO Message". $conversation ." (contenu,pseudo,datePost,heurePost,conversation) VALUES (?,(SELECT idPseudo FROM Pseudo WHERE nomPseudo LIKE ?),?,?,(SELECT idConversation FROM Conversation WHERE titre LIKE ?))";
		$bdd->prepare($sql);
		$reponse = $bdd->execute(array($contenu,$pseudo,$date,$heure,$conversation));
	}
?>