<?php $title = 'Redaction des chapitres(admin)'; ?>
<?php ob_start(); 

?>
 
<div class="vuChapComment">
  <div align="center">
   
   <a class="btn btn-sm btn-outline-secondary" href="index.php?action=listChapAdmin">Liste des chapitres</a>
   <a class="btn btn-sm btn-outline-secondary" href="index.php?action=commentsAdmin&amp;signalement=1">Modérer les commentaires</a>
  <br/><br/>
   
  <h3>Rédaction d'un nouveau chapitre : </h3><br/>

  <form class="form"method="post" action="index.php?action=writeChapter&amp;id= ">
   <input class="form-control" type="text" placeholder="Titre de l'article" id="title" name="title" /><br><br><br>
   <textarea class="mytextarea" name="content"  rows="20" cols="50" placeholder="Votre article"></textarea><br>
   <button type="submit" name="publish"class="btn btn-primary">Publier</button><br><br>
 </form>

  </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('adminTemplate.php'); ?> 