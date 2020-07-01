<?php
require_once("model/Manager.php");//Appelle la class Manager pour se connecter à bdd

class AdminManager extends Manager
{
	//Récupère les informations de l'admin
	public function getConnect($username)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT * FROM admin WHERE username = ?');
		$req->execute(array($username));
		
		return $req->fetch();
	}

}
