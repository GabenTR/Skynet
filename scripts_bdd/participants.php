<?php
	function createTableParticipant($bdd, $conversation)
	{
		$sql = "CREATE TABLE Participant". $conversation ." (idParticipant int PRIMARY KEY NOT NULL, pseudo int NOT NULL, connected bool NOT NULL, dateDerniereConnexion DATE NOT NULL, heureDerniereConnexion TIME NOT NULL, dateDernierMessage DATE, heureDernierMessage TIME, conversation int NOT NULL)";
		$reponse = $bdd->query($sql);
		$reponse->close;

		$reponse = $bdd->prepare("ALTER TABLE Participant". $conversation ." ADD INDEX(conversation)");
		$reponse->execute(array());
		$reponse->close();

		$reponse = $bdd->prepare("ALTER TABLE Participant". $conversation ." ADD INDEX(pseudo)");
		$reponse->execute(array());
		$reponse->close();

		$sql = "ALTER TABLE Participant". $conversation ." ADD CONSTRAINT participantConv FOREIGN KEY (conversation) REFERENCIES Conversation(idConversation)";
		$reponse = $bdd->prepare($sql);
		$reponse->execute(array());
		$reponse->close();

		$sql = "ALTER TABLE Participant". $conversation ." ADD CONSTRAINT participantPseudo FOREIGN KEY (pseudo) REFERENCIES Pseudo(idPseudo)";
		$reponse = $bdd->prepare($sql);
		$reponse->execute(array());
		$reponse->close();
	}

	function obtainParticipants($bdd, $conversation)
	{
		$sql = "SELECT nomPseudo FROM Pseudo WHERE idPseudo LIKE (SELECT pseudo FROM Participant". $conversation ." WHERE connecte=1)";
		$reponse = $bdd->prepare($sql);
		$reponse->execute(array());
		
		return $reponse;
	}

	function addParticipant($bdd, $conversation, $pseudo, $connected, $dateDerniereConnexion, $heureDerniereConnexion, $dateDernierMessage, $heureDernierMessage)
	{
		$sql = "INSERT INTO Participant". $conversation ." (pseudo, connected, dateDerniereConnexion, heureDerniereConnexion, DateDernierMessage, HeureDernierMessage) VALUES (SELECT id FROM Pseudo WHERE nomPseudo=?,?,?,?,?,?,SELECT idConversation FROM Conversation WHERE titre=?)";
		$reponse = $bdd->prepare($sql);
		$reponse->execute(array($pseudo,$connected,$dateDerniereConnexion,$heureDerniereConnexion,$dateDernierMessage,$heureDernierMessage,$conversation));
		$reponse->close();
	}
?>