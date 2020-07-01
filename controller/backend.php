<?php

//----- Controleur backend admin

require_once('model/PostManager.php');// chargement classes
require_once('model/CommentManager.php');
require_once('model/AdminManager.php');

//Rédaction chapitre
function writeChapter($title, $content) 
{
	$chapWrite = new PostManager();//Création nouvel objet
	$chapter = $chapWrite->postChapter($title, $content);//Retour modèle fonction postChapitre
	
	if($chapter === false) {
		die('<p style= "border: 1px solid red; text-align: center; font-size: 55px; margin: 90px 90px 90px;">Impossible d \'ajouter un chapitre.');//Condition si false on arrête le script
	}else{//Si true chargement de la page qui affichera la liste des chapitres
		header('Location: index.php?action=listChapAdmin');
	}
}

//Affiche l'interface de redaction chapitre
function editoInterface()  
{
	require('view/backend/writeChap.php');
}

//Récupération d'un chapitre admin par id
function chapitAdmin() 
{ 	
	$postManager = new PostManager();
	$chapitre = $postManager->getChapitre($_GET['id']);
	
	require('view/backend/editChapAdmin.php');
}

//Affichage de la liste des chapitres Admin
function listChapAdmin() 
{
	$postManager = new PostManager();
	$posts = $postManager->getChapterAdmin();
	require('view/backend/listChapAdmin.php');
}

//Suppression d'un chapitre
function suppChapitre($dataId) 
{	

	$supprime = new PostManager();
	$deletedPost = $supprime->deletChapter($dataId);
	
	if($deletedPost === false) {
		die('<p style= "border: 1px solid red; text-align: center; font-size: 55px; margin: 90px 90px 90px;">Impossible de supprimer un chapitre.</p>');
	}else{
		header('Location: index.php?action=listChapAdmin');
	}
}

//Modification d'un chapitre
function modifChapitre($title, $content, $postId) 
{
	$chapModif = new PostManager();
	$chapOk = $chapModif->updateChapitre($title, $content,$postId);
	
	if($chapOk === false) {
		die('<p style= "border: 1px solid red; text-align: center; font-size: 55px; margin: 90px 90px 90px;" Impossible de modifier un chapitre.</p>');
	}else{
		header('Location: index.php?action=listChapAdmin');
	}
}

//Récupère les commentaires signalés pour les afficher dans la vue admin
function commentsAdmin() 
{ 	
	$commentManager = new CommentManager();
	$comments = $commentManager->getCommentSignal($_GET['signalement']);
	
	require('view/backend/commentsReportAdmin.php');
}

//Suppression d'un commentaire signalé
function suppComments($commentId) 
{
	$supprime = new CommentManager();
	$deletedComment = $supprime->deletComment($commentId);

	if($deletedComment === false) {
		die('<p style= "border: 1px solid red; text-align: center; font-size: 55px; margin: 90px 90px 90px;">Impossible de supprimer ce commentaire...</p>');
	}else{
		header('Location: index.php?action=commentsAdmin&signalement=1');
	}
}

//Désignale commentaire signalé
function designalComments($commentId) 
{ 	
	$commentManager = new CommentManager();
	$comments = $commentManager->deSignal($commentId);

	if($comments === false) {
		die('<p style= "border: 1px solid red; text-align: center; font-size: 55px; margin: 90px 90px 90px;">Impossible de designaler le commentaire!</p>');
	}else{ 
		header('Location: index.php?action=commentsAdmin&signalement=1');
	}
	
	require('view/backend/commentsReportAdmin.php');
}




