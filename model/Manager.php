<?php

class Manager

{
//Connexion a la base de donnée
	protected function dbConnect()

	{
		try
		{
			//$db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', ''); //Localhost
			$db = new PDO('mysql:host=db5000579977.hosting-data.io;dbname=dbs559572', 'dbu966292', 'GC8BO0FM#Es5');
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
			return $db;
		}
		catch(Exception $e)
		{
        	die('Erreur : '.$e->getMessage());
		}

	}

}