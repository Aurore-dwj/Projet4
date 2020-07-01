<?php $title = 'Commentaires Signalés(admin)'; ?>

<?php ob_start(); ?>

<div class="vuChapComment">
	<div align="center">
    <div><br>
      <h2>Commentaires signalés :</h2><br>
      <a class="btn btn-sm btn-outline-secondary" href="index.php?action=listChapAdmin">Retour vers la liste des chapitres</a>
      
	<?php
//Boucle pour reccupérer les derniers commentaires
    while ($comment = $comments->fetch())
      	{
      	?>
      	 <!-- Affiche l'auteur et le commentaire -->
      	 <div class="news"><br>
      		  <p><em>Auteur : <?= nl2br(htmlspecialchars($comment['author'])) ?></em></p>
         	  <p>Commentaire : <?= nl2br(htmlspecialchars($comment['comment'])) ?></p><br>
         	  <a href="index.php?action=suppComments&amp;id=<?=$comment['id'] ?>"><button type="submit" name="suppComments"class="btn btn-primary">Supprimer le commentaire </button></a>
         	  <a href="index.php?action=designalComments&amp;id=<?=$comment['id'] ?>"><button type="submit"class="btn btn-primary">Désignaler ce commentaire </button></a><br><br>
          </div>

    <?php 
		    }//Fin de la boucle
    	$comments->closeCursor(); 
    ?>
	   </div>
	</div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('adminTemplate.php'); ?>