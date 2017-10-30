<?php
require_once('../inc/init.inc.php');
    
# Une fois le formulaire fait en HTML on réalise les traitements PHP et en 1er on déclare les variables correspondant à notre formulaire
$prenom = ""; //
$nom = ""; //
$email = ""; //
$tel = ""; //
$mdp = ""; //
$pseudo = ""; //
$avatar = ""; //
$age = ""; //
$date_birth = ""; // NON
$sexe = "f"; //
$etat_civil = ""; //
$adresse = ""; //
$cp = ""; //
$ville = ""; //
$pays = ""; // NON 
$web = ""; //
# 16 champs


#-1 on détecte si l'internaute a cliqué sur le bouton pour s'inscrire en ayant renseigné tous les champs
if (isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['tel']) && isset($_POST['mdp']) && ($_POST['pseudo']) && isset($_POST['avatar']) && isset($_POST['age']) && isset($_POST['sexe']) && isset($_POST['etat_civil']) && isset($_POST['adresse']) && isset($_POST['cp']) && isset($_POST['ville']) && isset($_POST['web'])) {
    extract($_POST); // transforme chaque indice du tableau array en variable qui contient la valeur correspondante
  // faire un controle sur la taille du pseudo (entre 1 et 20 caractères)
  // echo 'TEST';
    if(strlen($pseudo) < 1 || strlen($pseudo) > 20)// si erreur de taille sur le pseudo
    {
        $msg .= '<div class="erreur">Erreur sur la taille du pseudo:<br />Le pseudo doit contenir entre 1 et 20 caractères (inclus).</div>';
    }
    // expression régulière - on défini les caractères qu'on n'accepte pas
    if(!preg_match('#^[a-zA-Z0-9.ç_-]+$#', $pseudo))
    {
        /*
        les signes # indiquent le début et la fin de l'expression régulière
        le ^ indique le début de la chaine, sinon la chaine pourrait commencer par autre chose
        le $ indique la fin de la chaine, sinon la chaine pourrait finir par autre chose
        le + indique qu'on peyt retrouver plusieurs fois le même caractère, sinon on ne pourrait le trouver qu'une seule fois

        preg_match() renvoie false si un caractère non autorisé par l'expression régulière se trouve dans la chaine testée (ici $pseudo)
        */
        $msg .= '<div class="erreur">Erreur sur le pseudo:<br />Caractères autorisés: de a - z et de 0 - 9.</div>';
    }
        // on protège les saisies contre les injections de code
         $prenom = htmlentities($prenom, ENT_QUOTES);
         $nom = htmlentities($nom, ENT_QUOTES);
         $email = htmlentities($email, ENT_QUOTES);
         $tel = htmlentities($tel, ENT_QUOTES);
         $mdp = htmlentities($mdp, ENT_QUOTES);
         $pseudo = htmlentities($pseudo, ENT_QUOTES);
        // $avatar = htmlentities($avatar, ENT_QUOTES);
         $age = htmlentities($age, ENT_QUOTES);
         $date_birth = ""; // NON
         $sexe = htmlentities($sexe, ENT_QUOTES);
         $etat_civil = htmlentities($etat_civil, ENT_QUOTES);
         $adresse = htmlentities($adresse, ENT_QUOTES);
         $cp = htmlentities($cp, ENT_QUOTES);
         $ville = htmlentities($ville, ENT_QUOTES);
         $pays = ""; // NON 
         $web = htmlentities($web, ENT_QUOTES);
    
        // avant l'enregistrement en BDD on vérifie que le pseudo est unique (cf modélisation BDD ou le pseudo est unique)
         $controle_pseudo = execute_requete("SELECT * FROM t_utilisateurs WHERE pseudo='$pseudo'");

    if($controle_pseudo->rowCount() >= 1) // s'il y a au moins une ligne affectée par la requete le pseudo existe déjà
    {
        $msg .= '<div class="erreur">Erreur sur le pseudo:<br />Pseudo indisponible.</div>';
    }

    // validation et inscription en BDD
    if(empty($msg)) // s'il n'y a pas de message d'erreur ($msg est vide) on peut lancer l'inscriptions
    {
        // $mdp = password_hash($mdp, PASSWORD_DEFAULT); // cryptage du mdp
        execute_requete("INSERT INTO t_utilisateurs (prenom, nom, email, telephone, mdp, pseudo, avatar, age, sexe, etat_civil, adresse, ville, code_postal, site_web) VALUES ('$prenom', '$nom', '$email', '$tel', '$mdp', '$pseudo', '', '$age', '$sexe', '$etat_civil', '$adresse', '$ville', '$cp', '$web')");

    // à l'enregistrement du formulaire en BDD on redirige l'utilisateur sur une autre page
    // pas de HTML avant
    header("location:connexion.php"); // 
    $msg .= '<div class="succes">Inscription OK.</div>';
    
    }
    # a comenter
    else
  {
    $msg .= '<div class="succes">Votre Pseudo est : ' . $pseudo . '</div>';
  }
  $msg .= '<div class="erreur">Formulaire incomplet:<br />Recommencez votre saisie.</div>';
}
    
/***********************************/
    
# HTML
# (tout le reste du code doit venir avant l'affichage HTML)
include("inc_admin/header.inc.php");
include("inc_admin/nav.inc.php");
?>
    
<div class="container">
    <h1 class="text-center"><span class="blueviolet glyphicon glyphicon-share"></span> Inscription</h1>
        <?php echo $msg; // variable initialisée dans le fichier init.inc.php
        ?>
            
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
        <?php
            
            
        //debug($_POST); // vérification des informations provenant du formulaire
        ?>
            <form method="post" action="">
                
                <div class="form-group">
                    <label for="pseudo">Pseudo *</label>
                    <input type="text" class="form-control" id="pseudo"  placeholder="Pseudo" name="pseudo" maxlength="20" pattern="a-zA-Z0-9-_.]{1,20}" title="caractères acceptés : a-zA-Z0-9-_." required="required" value="" />
                </div>
                    
                <div class="form-group">
                    <label for="mdp">Mot de Passe *</label>
                    <input type="password" class="form-control" id="mdp"  placeholder="Mot de passe" name="mdp" value="" required="required"/>
                </div>
                    
                <div class="form-group">
                    <label for="avatar">Avatar</label>
                    <input type="file" class="form-control" name="avatar" id="avatar">
                </div>
                    
                <div class="form-group">
                    <label for="etat_civil" class="radio-inline">
                        <input type="radio" name="etat_civil" checked="" value="Mme">Madame
                    </label>
                    <label for="etat_civil" class="radio-inline">
                        <input type="radio" name="etat_civil" value="M.">Monsieur
                    </label>
                </div>
                    
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom"  placeholder="Nom" name="nom" value="" />
                </div>
                    
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" class="form-control" id="prenom"  placeholder="Prénom" name="prenom" value="" />
                </div>                
                    
                <div class="form-group">
                    <label for="age">Age</label>
                    <select name="age" id="age" class="form-control">
                    <?php 
                    for ($age = 1; $age <= 120; $age++) {
                        echo '<option>' . $age . '</option>';
                        }
                    ?> 
                    </select>
                </div>
                    
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email"  placeholder="E-mail" name="email" value="" />
                </div>
                    
                <div class="radio">
                    <label class="radio-inline">
                        <input type="radio" name="sexe" value="f">Femme
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="sexe" value="h">Homme
                    </label>
                </div>
                    
                <div class="form-group">
                    <label for="adresse">Adresse</label>
                    <textarea type="text" class="form-control" id="adresse"  placeholder="Adresse" name="adresse" pattern="[a-zA-Z0-9-_.]{5,15}" title="caractères acceptés : a-zA-Z0-9- _."></textarea>
                </div>
                    
                <div class="form-group">
                    <label for="ville">Ville</label>
                    <input type="text" class="form-control" id="ville"  placeholder="Ville" name="ville" value="" pattern="[a-zA-Z0-9-_.]{5,15}" title="caractères acceptés : a-zA-Z0-9- _."/>
                </div>
                    
                <div class="form-group">
                    <label for="cp">Code Postal</label>
                    <input type="text" class="form-control" id="cp"  placeholder="Code Postal" name="cp" pattern="[0-9]{5}" title="5 chiffres requis : 0-9" value="" />
                </div>
                    
                <div class="form-group">
                    <label for="tel">Téléphone</label>
                    <input type="text" class="form-control" id="tel"  placeholder="0123456789" name="tel" pattern="[0-9]{10}" title="5 chiffres requis : 0-9" value="" />
                </div>
                    
                <div class="form-group">
                    <label for="web">Site web</label>
                    <input type="text" class="form-control" id="web" name="web">
                </div>
                    
                <hr />
                    
                <input type="submit" class="form-control btn btn-warning btn-block" id="inscription" name="inscription" value="Inscription" />
            </form>
        </div>      
    </div>
        
        
        
</div><!-- /.container -->
    
    
<?php
include("inc_admin/footer.inc.php");