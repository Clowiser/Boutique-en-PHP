<?php
session_start();
require("php/fonctions.php"); // ou required 'fonctions.php'; inclue = on a besoin ; identique à include sauf que si erreur = ERREUR FATALE et stope le script - on inclue le page des fonctions.php dans l'ensemble du site, et chacune des fonctions est appelé dans les pages où elles sont utilisées

include("php/header.php"); // ou include 'header.php'; include = on affiche ; l'ensemble des fichiers du header est inclu suivant le chemin du fichier fourni dans tous les pages du site via l'index (toutes le spages du site auront le header affiché)

    if (isset($_GET['page'])){ // moyen pour vérifier que notre variable existe $_Get['page'] - isset détermine si une variable est déclarée et est différente de null
    if ($_GET['page'] == 'index.php'){ //si page = index alors affiche accueil (index=accueil) + méthode GET pour transporter le paramètre dans la chaîne d’URL
        include ("php/accueil.php");
    }
    if ($_GET['page'] == 'catalogue.php'){ // $_GET : variable d'environnement 
        include ("php/catalogue.php");
        echo '<title>Catalogue de la Boutique des Etoiles</title>'; 
    }
    if ($_GET['page'] == 'article.php'){
        include ("php/article.php");
        echo '<title>Article de la Boutique des Etoiles</title>'; 
    }
    if ($_GET['page'] == 'AddArticle.php'){
        include ("php/AddArticle.php");
        echo '<title>Ajouter un nouvel article</title>'; 
    }
    if ($_GET['page'] == 'displayarticle.php'){
        include ("php/displayarticle.php");
        echo '<title>Votre article ajouté</title>'; 
    }
    if ($_GET['page'] == 'panier.php'){
        include ("php/panier.php");
        echo '<title>Votre panier </title>'; 
    }
    }else{
        include ("php/accueil.php");
    }

include("php/footer.php"); // idem que le header
if(isset($_GET['destroy']))session_destroy();
?>
</body>