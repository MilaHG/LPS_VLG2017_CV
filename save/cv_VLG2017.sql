/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  marie
 * Created: 6 oct. 2017
 */

CREATE DATABASE IF NOT EXISTS cv_vlg2017;

USE cv_vlg2017;

CREATE TABLE t_utilisateurs(id_utilisateur INT(3) NOT NULL AUTO_INCREMENT, prenom VARCHAR(30) NOT NULL, nom VARCHAR(30) NOT NULL, email VARCHAR(50) NOT NULL, telephone INT(10) ZEROFILL, mdp VARCHAR(12) NOT NULL, pseudo VARCHAR(30) NOT NULL, avatar VARCHAR(20), age INT(3), date_naissance DATE, sexe ENUM('f','m') NOT NULL, etat_civil ENUM('M.','Mme'), adresse VARCHAR(50), code_postal INT(5) ZEROFILL, ville VARCHAR(30), pays VARCHAR(20), site_web VARCHAR(50), PRIMARY KEY (id_utilisateur)) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO t_utilisateurs (id_utilisateur, prenom, nom, email, telephone, mdp, pseudo, avatar, age, date_naissance, sexe, etat_civil, adresse, code_postal, ville, pays, site_web) VALUES (1, 'Marie-Hélène', 'GAURIAU', 'marie-helene.gauriau@lepoles.com', '0784180913', 'admin', 'Mila', 'blackckey.png', 120, '1850-01-01', 'f', 'Mme', '1 rue du Paradis', '75000', 'PARIS', 'France', 'www.moi.fr');

INSERT INTO t_utilisateurs (id_utilisateur, prenom, nom, email, telephone, mdp, pseudo, avatar, age, date_naissance, sexe, etat_civil, adresse, code_postal, ville, pays, site_web) VALUES (2, 'Mathilde', 'SORTAIS', 'thebazile@gmail.com', '0784180913', 'admin', 'Mathy', 'blackckey.png', 10, '2003-01-04', 'f', 'Mme', '1 rue du Paradis', '75000', 'PARIS', 'France', 'www.moi.fr');

CREATE TABLE t_titre_cv (
    id_titre_cv INT(3) NOT NULL AUTO_INCREMENT,
    titre_cv TEXT,
    accroche TEXT,
    logo VARCHAR(20),
    utilisateur_id INT(3),
    PRIMARY KEY (id_titre_cv)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE t_loisirs (
    id_loisir INT(3) NOT NULL AUTO_INCREMENT,
    loisir VARCHAR(30),
    utilisateur_id INT(3),
    PRIMARY KEY (id_loisir)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/***/
CREATE TABLE t_competences (
    id_competence INT(3) NOT NULL AUTO_INCREMENT,
    loisir VARCHAR(30),
    utilisateur_id INT(3),
    PRIMARY KEY (id_competence)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE t_experiences (
    id_experience INT(3) NOT NULL AUTO_INCREMENT,
    e_titre VARCHAR(50),
    e_soustitre VARCHAR(50),
    e_dates VARCHAR(50),
    e_description TEXT,
    utilisateur_id INT(3),
    PRIMARY KEY (id_experience)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE t_formations (
    id_formation INT(3) NOT NULL AUTO_INCREMENT,
    f_titre VARCHAR(50),
    f_soustitre VARCHAR(50),
    f_dates VARCHAR(50),
    f_description TEXT,
    utilisateur_id INT(3),
    PRIMARY KEY (id_formation)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE t_realisations (
    id_realisation INT(3) NOT NULL AUTO_INCREMENT,
    r_titre VARCHAR(50),
    r_soustitre VARCHAR(50),
    r_dates VARCHAR(50),
    r_description TEXT,
    utilisateur_id INT(3),
    PRIMARY KEY (id_realisation)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;