<?php

//---- Routeur

require('controller/frontend.php');
require('controller/backend.php');
session_start();  // Garde la session

try { 

	//Affichage de la page d'accueil avec les derniers articles
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        //Affiche un article et ses commentaires
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }

        //Ajout d'un commentaire
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    // Autre exception
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }

    //Signale un commentaire
    if (isset($_GET['action'])) { 
        if ($_GET['action'] == 'signal') {
            if ((isset($_GET['id'])) && (!empty($_GET['id']))){
                signal($_GET['id']);
            }else{
                echo '<p style= "border: 1px solid red; text-align: center; font-size: 25px; margin: 90px 90px 90px;">Erreur de signalement !</p>';
            }
        }
    }
    
    //Affiche l'interface de redaction de chapitre
    if (isset($_GET['action'])) { 
        if ($_GET['action'] == 'editoInterface') {
            if(!isset($_SESSION['username'])){//Si une session n'est pas en cours
                listPosts();//Renvoi le visiteur à la page d'accueil 
            }else{
                editoInterface(); 
            }
        }       
    }
    // Redaction d'un nouveau chapitre
    if (isset($_GET['action'])) { 
        if ($_GET['action'] == 'writeChapter') {
            if (isset($_POST['title']) AND isset($_POST['content'])){
                $title = ($_POST['title']);
                $content = ($_POST['content']);
                if(!empty(trim($_POST['title'])) AND !empty(trim($_POST['content']))){            
                    writeChapter($_POST['title'], $_POST['content']); 
                }else{
                    echo '<p style= "border: 1px solid red; text-align: center; font-size: 25px; margin: 90px 90px 90px;">Vous n\'avez pas saisi de message!</p>';
                }             
            }   
        } 
    }

//Affichage liste des chapitres Admin
    if (isset($_GET['action'])) { 
        if ($_GET['action'] == 'listChapAdmin') {
            if(!isset($_SESSION['username'])){
                listPosts();
            }else{
                listChapAdmin();   
            }
        }
    }

    //Supprime un chapitre et ses commentaires
    if (isset($_GET['action'])) { 
        if ($_GET['action'] == 'suppChapitre') {
            if(!isset($_SESSION['username'])){
                listPosts();
            }else{
                if ((isset($_GET['id'])) && (!empty($_GET['id']))) {
                    suppChapitre($_GET['id']);

                }
            }
        }   
    }

    //Affiche un chapitre à modifier 
    if (isset($_GET['action'])) { 
        if ($_GET['action'] == 'chapitAdmin') {
            if(!isset($_SESSION['username'])){
                listPosts();
            }else{
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    chapitAdmin();
                }else {
                    echo '<p style= "border: 1px solid red; text-align: center; font-size: 25px; margin: 90px 90px 90px;">Petit problème d\'affichage du chapitre !</p>';
                }
            }   
        } 
    } 

    //Modifie un chapitre
    if (isset($_GET['action'])) {  
        if ($_GET['action'] == 'modifChapitre') {
            if ((isset($_GET['id'])) && (!empty($_GET['id']))) {
                modifChapitre($_POST['title'], $_POST['content'], $_GET['id']); 
            }
        }
    }

    //Récupère les commentaires signalés
    if (isset($_GET['action'])) { 
        if ($_GET['action'] == 'commentsAdmin') {
            if(!isset($_SESSION['username'])){
                listPosts();
            }else{
                if (isset($_GET['signalement']) && $_GET['signalement'] == '1') {
                    commentsAdmin($_GET['signalement']);
                }else{
                    echo '<p style= "border: 1px solid red; text-align: center; font-size: 25px; margin: 90px 90px 90px;">Problème d\'affichage des signalements !</p>';
                }
            }   
        }
    }

    //Désignale commentaire signalé
    if (isset($_GET['action'])) { 
        if ($_GET['action'] == 'designalComments') {
            if ((isset($_GET['id'])) && (!empty($_GET['id']))){
                designalComments($_GET['id']);
            }else{ 
            echo '<p style= "border: 1px solid red; text-align: center; font-size: 25px; margin: 90px 90px 90px;">Erreur de désignalement !</p>';
            }
        }
    }

    //Supprime un commentaire
    if (isset($_GET['action'])) { 
        if ($_GET['action'] == 'suppComments') {
            if ((isset($_GET['id'])) && (!empty($_GET['id']))) {
                suppComments($_GET['id']);
            }
        }
    }

    //Affiche le formulaire de connexion
    if (isset($_GET['action'])) { 
        if ($_GET['action'] == 'displConnexion') {
            displConnexion(); 
        }       
    }

    //Connexion
    if(isset($_GET['action'])) { 
        if ($_GET['action'] == 'connexion') {
                if(!empty($_POST['username']) AND !empty($_POST['password'])){
                    connexion($_POST['username'], $_POST['password']); 
                }else{
                    echo '<p style= "border: 1px solid red; text-align: center; font-size: 25px; margin: 90px 90px 90px;">Tous les champs doivent-être remplis!</p>';
                }   
        }      
    }

    //Deconnexion
    if (isset($_GET['action'])) { 
        if ($_GET['action'] == 'deconnexion') {
            deconnexion();
        } 
    }

    //Affiche la liste les chapitres
    if (isset($_GET['action'])) { 
        if ($_GET['action'] == 'listChapitres') {
            listChapitres(); 
        }
    }


    }else {
        listPosts();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}


