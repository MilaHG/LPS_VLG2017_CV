<?php

# Animation du menu selon la page / rubrique en cours de consultation

function active($url) {
    if ($_SERVER['PHP_SELF'] == $url) { // $_SERVER['PHP_SELF'] renvoie l'url du script en cours
        return ' class="active" ';
    }
}

/* * ********************** */

# Exécution de requêtes SQL

function execute_requete($req) {
    global $pdo; // on réupère la variable représentant la connexion BDD depuis le script global cf. inc/init.inc.php
    $resultat = $pdo->query($req); // exécution de la requête passée en argument
    # gestion des erreurs
    if (!$resultat) { // cas d'erreur sur la requête
        die('Erreur sur la requête : ' . $req . '<br />Message : ' . $pdo->error . '<hr />');
        // si la requete échoue, die + affichage de l'erreur
    }
    return $resultat; // si la requête réussi on retourne le résultat de celle-ci
}

/* * ********************** */

# Fonction d'aide au débug

function debug($var, $mode = 1) { // si je ne fournit que le 1er argument, par défaut à l'exécution il prendra la valeur de la 2nd variable déclarée en argument     {}
    echo '<div style="background-color: orange; padding: 10px;">';
    $trace = debug_backtrace(); // la fonction debug_backtrace retourne un tableau ARRAY contenant des informations telles que la ligne et le fichier où est exécutée cette fonction
//    echo '<hr />';
//    var_dump($trace);
//    echo '<hr />';

    $trace = array_shift($trace); // retire le 1er élément du tableau et réordonne tous les éléments pour qu'il n'y ait pas de vide
    echo '<p>Debug demandé dans le fichier: ' . $trace['file'] . ' à la ligne: ' . $trace['line'] . '</p>';

    if ($mode === 1) {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
        // si on passe un seul argument  debug($arg); => var_dump
    } else {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
        // si on passe deux arguments et que le 2nd argument n'est pas 1  debug($arg, $arg2); => print_r
    }
    echo '</div>';
}

/* * ********************** */

# Fonctions utilisateurs

function admin_connecte() {
    if (isset($_SESSION['utilisateur'])) {
        // si le pseudo et le mdp sont bien en BDD l'indice 'utilisateur' est généré dans la page de connexion
        return true;
    } else {
        return false;
    }
}
