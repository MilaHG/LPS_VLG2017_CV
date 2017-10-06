<?php

$hote = 'localhost';
$bdd = 'cv_vlg2017';
$utilisateur = 'root';
$mdp = '';


$pdo = new PDO('mysql:host=' . $hote . ';dbname=' . $bdd, $utilisateur, $mdp, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//$pdo = new PDO('mysql:host=' . $hote . ';dbname=' . $bdd, $utilisateur, $mdp);
//$pdo->exec('SET NAMES utf8');
