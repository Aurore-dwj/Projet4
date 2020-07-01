<?php $title = 'Connexion'; ?>
<?php ob_start(); 

?>

<div align="center">
   <a class="btn btn-sm btn-outline-secondary" href="index.php">Retour à la page d'accueil</a><br><br>
</div>


<div class="container login-container">
   <div class="row">
      <div class="col-md-6 login-form-2">
         <h3>Connexion</h3>
         <form method="POST" action="index.php?action=connexion" method="POST">
            <div class="form-group">
               <input type="text" class="form-control" name="username" placeholder="Identifiant" value="" />
            </div>
            <div class="form-group">
               <input type="password" class="form-control" name="password" placeholder="Mot de passe" value="" />
            </div>
            <div class="form-group">
               <input type="submit" class="btnSubmit" name="connexion" value="Connexion" />
            </div>
         </form>
      </div>
   </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?> 