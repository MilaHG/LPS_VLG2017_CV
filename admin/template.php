<?php
require_once('../inc/init.inc.php');

# vérification de la saisie d'un pseudo et mdp
//if (isset($_POST['pseudo']) && isset($_POST['mdp'])) {
//    debug($_POST);
//}






# HTML
# (tout le reste du code doit venir avant l'affichage HTML)
include("inc_admin/header.inc.php");
include("inc_admin/nav.inc.php");
?>

    <div class="container">
        <div class="starter-template">
        <h1><span class="blueviolet glyphicon glyphicon-log-in"></span> Connexion</h1>
        <?php echo $msg;  // variable initialisée dans le fichier init.inc.php
          ?> 
      </div>
        <p>test</p>
    </div><!-- /.container -->
   
        
<?php
include("inc_admin/footer.inc.php");
