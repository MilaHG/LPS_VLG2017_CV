<?php
require_once("inc/init.inc.php");



// affichages HTML (tout le reste du code doit venir avant)
include("inc_admin/header.inc.php");
# ou include("inc/header.inc.php"); pour la partie NON ADMIN
/* DETAIL DU FICHIER :
 * <!DOCTYPE html>
  <html lang="fr">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="description">
  <meta name="author" content="Portfolio MilaHG">
  <link rel="icon" href="<?= URL; ?>lib/img/cat.png">

  <title>Portfolio</title>

  <!-- Bootstrap core CSS -->
  <link href="<?= URL; ?>lib/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= URL; ?>lib/css/font-awesome.css" rel="stylesheet">

  <!-- Custom styles for this template => on copie-colle le code du template dans notre fichier perso css -->
  <link href="<?= URL; ?>lib/css/style.css" rel="stylesheet">
  <?php
  $msg .= '<div style="padding: 10px; color: white; background-color: black;>Bienvenue !</div>'; // $msg à valider ici !!!
  ?>

  </head>

  <body>
 *
 */
include("inc_admin/nav.inc.php");
/* DETAILS DU FICHIER
 *

  <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
  <div class="navbar-header">
  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
  <span class="sr-only">Toggle navigation</span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  </button>
  <a class="navbar-brand" href="#">Ma Boutique</a>
  </div>
  <div id="navbar" class="collapse navbar-collapse">
  <ul class="nav navbar-nav">
  <li <?php echo active(URL . 'boutique.php'); ?> ><a href="<?php echo URL; ?>boutique.php">Boutique</a></li>
  <li <?php echo active(URL . 'panier.php'); ?> ><a href="<?php echo URL; ?>panier.php">Panier</a></li>
  <?php
  if (utilisateur_est_connecte())
  {// menu connecté
  echo '
  <li' . active(URL . 'profil.php') . '><a href="' . URL . 'profil.php">Profil</a></li>
  <li><a href="' . URL . 'connexion.php?action=deconnexion">Déconnexion</a></li>';
  }
  else
  {// menu anonyme
  echo '
  <li' . active(URL . 'connexion.php') . '><a href="' . URL . 'connexion.php">Connexion</a></li>
  <li' . active(URL . 'inscription.php') . '><a href="' . URL . 'inscription.php">Inscription</a></li>';
  }

  if(utilisateur_est_connecte_et_est_admin())
  {// menu admin
  echo '
  <li' . active(URL . 'admin/gestion_boutique.php') . '><a href="' . URL . 'admin/gestion_boutique.php">Gestion boutique</a></li>
  <li' . active(URL . 'admin/gestion_membres.php') . '><a href="' . URL . 'admin/gestion_membres.php">Gestion membres</a></li>
  <li' . active(URL . 'admin/gestion_commandes.php') . '><a href="' . URL . 'admin/gestion_commandes.php">Gestion commandes</a></li>';
  }

  ?>
  </ul>
  </div><!--/.nav-collapse -->
  </div>
  </nav>

 *
 *  */
?>

<div class="container">

    <div class="starter-template">
        <h1><span class="blueviolet glyphicon glyphicon-share"></span> Connect</h1>
        <?php echo $msg;  // variable initialisée dans le fichier init.inc.php
        ?>
    </div>

</div><!-- /.container -->

<?php
include("inc_admin/footer.inc.php");
# contenu correspondant au footer de l'admin
/*
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- <script src="<?= URL; ?>js/bootstrap.min.js"></script> -->

  </body>
</html>
 */
