<?php
//-----Controleur frontend Admin

//Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/AdminManager.php');

//Affichage liste des 5 derniers articles
function listPosts()
{
    $postManager = new PostManager();//création objet
    $posts = $postManager->getPosts();

    require('view/frontend/listPostsView.php');
}

//Reccupération d'un chapitre et de ses commentaires
function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

//Ajout d'un commentaire
function addComment($idBillet, $author, $comment)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->postComment($idBillet, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=listPosts');
    }
}

//Signale un commentaire
function signal($commentId) 
{
    $commentManager = new CommentManager();
    $signal = $commentManager->signalement($commentId);

    if($signal === false) {
        die('<p style= "border: 1px solid red; text-align: center; font-size: 25px; margin: 90px 90px 90px;">Impossible de signaler !</p>');
    }else{ 
        header('Location: index.php?action=listPosts');
    }
}

//Affichage formulaire de connexion
function displconnexion() 
{
    require('view/frontend/connectView.php');
}

//Connexion Admin
function connexion($username,$password) 
{
    $admin = new AdminManager();
    $connect = $admin->getConnect($username);
    $isPasswordCorrect = password_verify($_POST['password'], $connect['password']);
    
    if (!$connect)
    {
        echo 'Mauvais identifiant ou mot de passe !';
    }
    else{

        if ($isPasswordCorrect) {
            session_start();
            $_SESSION['username'] = $username;
            header("Location: index.php?action=listChapAdmin");

        }else{
            echo 'Mauvais identifiant ou mot de passe !';
        }   
    }
}

//Déconnexion
function deconnexion() 
{
    $_SESSION = array();
    session_destroy();
    header("Location: index.php"); 
}

//Liste de tous les chapitres (user) 
function listChapitres() 
{
    $postManager = new PostManager();
    $posts = $postManager->getChapitres();
    require('view/frontend/listPostsView.php');
}







