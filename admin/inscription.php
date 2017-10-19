<?php
require_once('../inc/init.inc.php');
    
# Une fois le formulaire fait en HTML on réalise les traitements PHP et en 1er on déclare les variables correspondant à notre formulaire
$pseudo = "";
$mdp = "";
$avatar = "";
$etat_civil = "";
$nom = "";
$prenom = "";
$age = "";
$email = "";
$sexe = "f";
$adresse = "";
$cp = "";
$ville = "";
$tel = "";
    
#-1 on détecte si l'internaute a cliqué sur le bouton pour s'inscrire en ayant renseigné les champs obliatoires (pseudo et mdp)
if (isset($_POST['pseudo']) && isset($_POST['mdp'])) {
    #-2 si l'internaute a cliqué on vérifie avec la fonction DEBUG (cf. functions.inc.php appellée par init.inc.php) les saisies postées
    
    debug($_POST);
    #-3 pour le PSEUDO si les caractères interdits ou un pseudo trop court ou trop long ont été renseignés on refuse l'insertion en BDD et en informe l'internaute
    $verif_saisie = preg_match('#^[a-zA-Z0-9._-]+$#', $pseudo);
    /* preg_match() est une expression régulière (regex) toujours entourée 
     * du symbole # dieze afin de préciser des options choisies : ^ désigne 
     * le début de la chaîne
     * $ désigne la fin de la chaîne
     * + est présent pour dire que les lettres autorisées peuvent apparaître
     *  plusieurs fois
     */
         
    if ($verif_saisie && (strlen($pseudo) < 1 || strlen($pseudo) > 20 ))
        {
            $msg .= "<div class='erreur'>Le pseudo doit contenir entre 1 et 20 caractères. <br> Caractère accepté : Lettre de A à Z et chiffre de 0 à 9</div>";
        }
        else
        {
            extract($_POST); // transforme chaque indice du tableau array en variable qui contient la valeur correspondante
            #-4 la saisie est bonne et on vérifie si les infos n'existent pas déjà en BDD 
            $t_utilisateurs = execute_requete("SELECT * FROM t_utilisateurs WHERE pseudo = '$_POST[pseudo]'");
            #-5 si le pseudo existe déjà en BDD (au moins 1 ligne de résultat à la requê te) on refuse l'inscription et informe l'internaute
            if ($t_utilisateurs->num_rows > 0)
            {
                $msg .= "<div class='erreur'>Pseudo indisponible. Veuillez en choisir un autre, merci.</div>"; 
            }
            #-6 la saisie est bonne et le pseudo inexistant en BDD => on inscrit l'internaute (insertion en BDD)
            else
            {
                #-7 on boucle sur toutes les saisies afin de les passer dans les fonctions prédéfinies PHP htmlEntities et addSlashes. /!\ Cela permet d'effectuer 1 premier traitement mais ce n'est pas pour autant complétement sécurisé
                foreach ($_POST as $key => $value) 
                    {
                       $_POST[$key] = htmlentities(addslashes($value));
                    }
                    execute_requete("INSERT INTO t_utilisateurs (pseudo, mdp, avatar, etat_civil, nom, prenom, age, email, sexe, adresse, ville, code_postal, telephone, site_Òweb) VALUES ($pseudo, $mdp, $avatar, $etat_civil, $nom, $prenom, $age, $email, $sexe, $adresse, $ville, $cp, $tel, $web)");
                    // à l'enregistrement du formulaire en BDD on redirige l'utilisateur sur une autre page
                    // pas de HTML avant
                    // header("location:connexion.php"); // 
                    $msg .= '<div class="succes">Inscription OK.</div>';
            }
        }
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