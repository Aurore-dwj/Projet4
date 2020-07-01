<?php

require_once("model/Manager.php"); //On Appelle la class Manager pour se connecter à la base de donnée

class PostManager extends Manager
{
//Reccuperation des 5 derniers articles
public function getPosts()
{
	$db = $this->dbConnect();
	$req = $db->query('SELECT id, title, content FROM billets ORDER BY ID DESC LIMIT 0, 5');

	return $req; 
}

//Reccuperation des articles par id
public function getPost($postId)
{
	$db = $this->dbConnect();
	$req = $db->prepare('SELECT id, title, content FROM billets WHERE id=?');
	$req->execute(array($postId));
	$post = $req->fetch();

	return $post;

}

//Insertion d'article dans la base de donnée
public function postChapter($title, $content) 
	{
		$db = $this->dbConnect();
		$inserChap = $db->prepare('INSERT INTO billets(title, content) VALUES (?, ?)');
        $chapter = $inserChap->execute(array($title, $content));
		
		return $chapter;

	}

//Récupération de tous les chapitres rangés en ordre d'id descendante
public function getChapterAdmin() 
	{
		
		$db = $this->dbConnect();
		$req = $db->query('SELECT id, title, content FROM billets ORDER BY ID DESC');

		return $req;
	}

//Supprime un chapitre et ses commentaires
public function deletChapter($dataId) 
	{ 
        $db = $this->dbConnect();
        $comment = $db->prepare('DELETE FROM commentaires WHERE id_billet = ?');
        $comment->execute([$dataId]);
        $req = $db->prepare('DELETE FROM billets WHERE id = ?');
        $req->execute(array($dataId));
       	
    }

//Recupère un chapitre par son id (admin)
public function getChapitre($postid)
    {
    	$db = $this->dbConnect();
    	$req = $db->prepare('SELECT * FROM billets WHERE id = ?');
		$req->execute(array($postid));
	
    	return $req;
	}

//Modifie un chapitre
public function updateChapitre($title, $content, $postId) 
	{
		$db = $this->dbConnect();
		$updChap = $db->prepare('UPDATE billets SET title = ?, content = ? WHERE id = ?');
        $chapOk = $updChap->execute(array($title, $content,$postId));
		return $chapOk;

	}

//Récupération de tous les chapitres (visiteur)
public function getChapitres() 
	{
		
		$db = $this->dbConnect();
		$req = $db->query('SELECT id, title, content FROM billets ORDER BY id DESC LIMIT 0, 50');

		return $req;
	}
}