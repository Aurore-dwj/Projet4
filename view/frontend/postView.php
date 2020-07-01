<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>

<div align="center">
    <a class="btn btn-sm btn-outline-secondary mb-3" href="Index.php" >Retour à la liste des billets</a>
</div>

<div class="news">
    <h3>
        <?php echo htmlspecialchars($post['title']);?>
    </h3>
    
    <p>
        <?php
        echo nl2br(htmlspecialchars($post['content']));
        ?>
    </p>
</div>

<div class="container">
    <h3 class="pt-1">Commentaires</h3>

<?php

while ($comment = $comments->fetch())
{

?>

    <p class="pt-3"><strong><?php echo htmlspecialchars($comment['author']); ?></strong></p>
    <p><?php echo nl2br(htmlspecialchars($comment['comment'])); ?></p>
    <a class="btn btn-sm btn-outline-primary mb-3" href="index.php?action=signal&amp;id=<?= $comment['id']; ?>">Signaler ce commentaire</a>

<?php

} // Fin de la boucle des commentaires

?>

<!-- Ajout du formulaire pour déposer un commentaire -->
    <h3 class="pb-3">Déposer un commentaire</h3>
    <form action="index.php?action=addComment&amp;id=<?php echo $post['id'];?>" method="post">
        <input type="text" placeholder="Votre pseudo" id="author" name="author"><br><br>
        <textarea class="form-control" rows="5" placeholder="Votre commentaire" name="comment"></textarea><br><br>
        <input id="comment-btn" type="submit" name="submit" value="Laisser un commentaire"><br><br>
    </form>

</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>