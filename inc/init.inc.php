<?php

# fichier le plus important du site => appelé en tout 1er (pas d'utf8)


$hote = 'localhost';
$bdd = 'cv_vlg2017';
$utilisateur = 'root';
$mdp = ''; /* pour MAC le mdp est root */

# variable de réception pour la connexion à la BDD
$pdo = new PDO('mysql:host=' . $hote . ';dbname=' . $bdd, $utilisateur, $mdp, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
/*
 * arguments
  1- serveur et nom BDD
  2- identifiant de connexion à la BDD
  3- mdp
  4- options: toujours dans un tableau array (ici gestion des erreurs en 1er argument et en 2 prise en charge UTF-8)
  erreurs => http://php.net/manual/fr/pdo.error-handling.php
 */

echo '<pre>';
var_dump($pdo);
echo '</pre>';

/* * ****************************************** */

# Ouverture de la Session (nouvelle ou l'existante)
session_start();

/* * ****************************************** */

# AUTRES INCLUSIONS
require_once 'functions.inc.php'; // appel du fichier de fonctions

/* * ****************************************** */

# VARIABLES DISPONIBLES SUR TOUTES LES PAGES
$msg = ""; // stockage des messages pour les afficher à l'utilisateur

/* * ****************************************** */

# DEFINITION URL DU SITE
define("URL", "/LPS_VLG2017_CV/");
echo URL;
echo '<br />';

/* * ****************************************** */

# DEFINITION SERVEUR
define("RACINE_SERVEUR", $_SERVER['DOCUMENT_ROOT']);
/* information récupérée dynamiquement grace à la superglobale $_SERVER
 * information nécessaire pour l'enregistrement de fichier sur notre serveur (photo...)
 */
echo RACINE_SERVEUR;
echo '<hr />';
