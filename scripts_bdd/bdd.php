<?php
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=skynet;charset=utf-8', 'root', ''); //L'accès sera plus sécurisé par la suite, les tests se faisant sur serveur virtuel en Intranet
	}
	catch(Exception $e)
	{
		die ('Erreur : ' . $e->getMesage());
	}
?>