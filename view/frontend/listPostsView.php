<?php $title = "Billet simple pour l'Alaska" ?>

<?php ob_start(); ?>

<!-- Texte de bienvenue -->
<div class="jumbotron p-4 p-md-5 text-white rounded bg-dark ">
    <div class="col-md-8 px-0 ">
        <h2 class="display-4 font-italic align-items-center">Bienvenue</h2>
        <p class="lead my-3">Découvrez mon dernier roman sous un format inédit. Je publirai un chapitre par semaine. N'hésitez pas à me faire part de vos impressions en me laissant des commentaires.</p>
        <p class="lead mb-0 text-white font-weight-bold">Bonne lecture !</p>
    </div>
</div>

<h2>Derniers billets du blog :</h2>

<?php
while ($post = $posts->fetch())
{

?>

<div class="news">
    <h3>
        <?php echo htmlspecialchars($post['title']); ?>
    </h3>
    
    <p>
        <?php
        // On affiche le contenu du billet
        echo nl2br(htmlspecialchars($post['content']));
        ?>
        <br />
        <em><a href="Index.php?action=post&amp;id=<?php echo $post['id']; ?>">Lire la suite</a></em>
    </p>
</div>

<?php

} // Fin de la boucle des billets
$posts->closeCursor();
?>

<a class="btn btn-secondary btn-lg btn-block" href="index.php?action=listChapitres&amp;">Découvrir tous les chapitres</a><br>

<?php $content = ob_get_clean(); ?>

<?php require ('template.php'); ?>

        
