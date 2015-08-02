<?php
	function createTableMessage($bdd, $conversation)
	{
		$sql = "CREATE TABLE Message? (idMessage int PRIMARY KEY NOT NULL, contenu text NOT NULL, pseudo int NOT NULL, datePost date NOT NULL, heurePost time NOT NULL, conversation int NOT NULL)";
		$reponse = $bdd->execute($sql);

		$sql = "ALTER TABLE Message? ADD CONSTRAINT messageConv FOREIGN KEY conversation REFERENCES Conversation(idConversation)";
		$reponse = $bdd->execute($sql);

		$sql = "ALTER TABLE Message? ADD CONSTRAINT messageConv FOREIGN KEY pseudo REFERENCES Pseudo(idPseudo)";
		$reponse = $bdd->execute($sql);
	}

	function obtainMessages($bdd, $conversation)
	{
		$sql = "SELECT contenu,Pseudo.nomPseudo,datepost,heurepost FROM Message WHERE Message". $conversation .".pseudo LIKE (SELECT idPseudo FROM Pseudo) AND conversation LIKE (SELECT idConversation FROM Conversation WHERE titre=?)";
		$reponse = $bdd->execute($sql);

		return $reponse;
	}

	function addMessage($bdd, $contenu, $pseudo, $date, $heure, $conversation)
	{
		$sql = "INSERT INTO Message". $conversation ." (contenu,pseudo,datePost,heurePost,conversation) VALUES (?,(SELECT idPseudo FROM Pseudo WHERE nomPseudo LIKE ?),?,?,(SELECT idConversation FROM Conversation WHERE titre LIKE ?))");
		$reponse = $bdd->execute($sql);
	}
?>