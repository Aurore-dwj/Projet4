<?php $title = 'Liste des chapitres en ligne(admin)'; ?>
<?php ob_start();

?>

<div class="vuChapComment">
  <div align="center">
   <em><h3>Liste des derniers chapitres</h3></em><br>
   <a class="btn btn-sm btn-outline-secondary" href="index.php?action=editoInterface">Rédiger un chapitre</a>
   <a class="btn btn-sm btn-outline-secondary" href="index.php?action=commentsAdmin&amp;signalement=1">Modérer les commentaires</a>
   <br><br>

<!-- Mise en forme du tableau -->
<div class="container">
<table class="table">
    <tbody>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Descriptif</th>
                <th>Options</th>
            </tr>
        </thead>
</div>

<?php
	//On affiche les lignes du tableau une à une à l'aide d'une boucle
    while($post = $posts->fetch())
    {
?>

		<tr>
   			<td><?php echo htmlspecialchars($post['title']);?></td>
    		<td><?php echo htmlspecialchars($post['content']);?></td>
    		<td><a class="btn btn-sm btn-outline-secondary" name ="edit" href="index.php?action=chapitAdmin&id=<?php echo $post['id']; ?>">Modifier l'article</a></td>
    		<td><a class="btn btn-sm btn-outline-secondary" name="delete" href="index.php?action=suppChapitre&id=<?php echo $post['id']; ?>">Supprimer l'article</a></td>
		</tr>

<?php
    } //fin de la boucle, le tableau contient tous les articles de la bdd  
?>

	</div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('adminTemplate.php'); ?>