<?php

class CommentManager extends Manager
{
//Reccuperation des commentaires selon l'id du post 
function getComments($id)
{
	$db = $this->dbConnect();
	$comments = $db->prepare('SELECT id, author, comment FROM commentaires WHERE id_billet = ?');
	$comments->execute(array($_GET['id']));

	return $comments;
}
//Ajout de commentaire
function postComment($idBillet, $author, $comment)
{
    $db = $this->dbConnect();
    $comments = $db->prepare('INSERT INTO commentaires (id_billet, author, comment) VALUES(?, ?, ?)');
    $affectedLines = $comments->execute(array($idBillet, $author, $comment));

    return $affectedLines;
}

//Requete pour signaler commentaire
public function signalement($commentId) 
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE commentaires SET signalement = 1 WHERE id = ?');
		$req->execute(array($commentId));

		return $req;
	}

//Récupère les commentaires signalés pour les afficher dans la vue 
public function getCommentSignal($signalement) 
	{
		$db = $this->dbConnect();
		$comments = $db->prepare('SELECT id, author, comment, signalement FROM commentaires WHERE signalement = 1 ORDER BY ID DESC');
		$comments->execute(array($signalement));
		return $comments;
	}

//Suppression du commentaire
public function deletComment($commentId) 
	{
		$db = $this->dbConnect();
		$req = $db->prepare('DELETE FROM commentaires WHERE id = ?');
		$req->execute(array($commentId));
		
		return $req;
	}

//Designale le commentaire 
public function deSignal($commentId) 
	{
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE commentaires SET signalement = 0 WHERE id = ?');
		$req->execute(array($commentId));

		return $req;
	}

}