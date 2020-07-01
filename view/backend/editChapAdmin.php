<?php $title = 'Chapitre à modifier(admin)'; ?>
<?php ob_start(); ?>

<div class="vuChapComment">
	<div align="center">

		<p><a class="btn btn-sm btn-outline-secondary" href="index.php?action=listChapAdmin">Retour à la liste des Chapitres</a></p><br>

		<div class="news">

        <?php
        while ($post = $chapitre->fetch())
        {
        ?>
    		<h3>
    		  <!-- On affiche le titre du billet -->
        	   <?php echo htmlspecialchars($post['title']); ?><br />
    		</h3>

    		<p>
    		<?php
   	 		 // On affiche le contenu du billet
    		  echo (htmlspecialchars($post['content']));
    		?>
    		</p>

        </div>

        <form id="formulaire2" method="post" action="index.php?action=modifChapitre&id=<?php echo $post['id']; ?>">
    	   <input type="hidden" name="id" id="id" value="<?php echo $post['id']; ?>">
    	   <input type="text" name="title" id="title" value="<?php echo $post['title']; ?>"><br /><br />
    	   <textarea name="content" id="content"><?= $post['content']; ?></textarea><br /><br />
    	   <input id="publish-btn" type="submit" name="submit" value="Publier"><br><br>
        </form>

        <?php
        }
        ?>

    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('adminTemplate.php'); ?>

