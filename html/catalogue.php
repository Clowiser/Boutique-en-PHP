<?php
// Liste des articles
$liste_article = [
    [
        'id' => 1,
        'photo' => "img/bouteille.jpg",
        'nom' => "<p>Bouteille</p> ",
        'prix' => 20//pas besoin de '' pour les chiffres
    ],
    [
        'id' => 2,
        'photo' => "img/mug.jpg",
        'nom' => "<p>Mug</p> ",
        'prix' => 15
    ],
    [
        'id' => 3,
        'photo' => "img/couverts.jpg",
        'nom' => "<p>Couverts</p>",
        'prix' => 12
    ]
];

// Affichage  articles - foreach est utilisable pour un tableau
foreach ($liste_article as $element) { // éxectute la fonction donnée sur chaque élément du tableau $liste_article
    // le $element est le nom de la variable que l'on donne et qui renvoie à chaque case [] du tableau (j'aurais pu l'appeler $case)
    echo '<div class="contain">','<a href ="index.php?page=article.php&Addarticle='.$element['id'].'"><img class="img" src="'.$element['photo'].'"/></a>'."\n", $element['nom'] , $element['prix'], "€", //permet d'afficher QUE l'article sur lequel on clique de la page Catalogue à la page Article par le LIEN créé avec l'image!!! (jaurais pu mettre le nom et le prix dans la balise <a> ainsi l'ensemble des 3 élements aurait fait le lien à la Page Article)
    '<form method="post" action="index.php?page=panier.php">', // envoie les informations sur la page Panier / liste des articles inclue dans formulaire
    '<input type="number" name="quantite" min="0" value="1" >', // nombre : saisie du nombre d'article 
    '<input type="hidden" name="article" value="'.$element['id'].'">', // élement masqué : correspond à l'id de l'article (id 1, id 2 et id 3)
    '<input type="hidden" name="prix" value="'.$element['prix'].'">', // élement masqué : correspond au prix de l'article 
    '<input type="submit" name="ajoutPanier" value="Ajouter au panier">','</form>','</div>'; // envoie les données enregistrées - c'est par le bouton submit au name ajoutPanier que la validation du formulaire renvoie sur la Page Panier 
}// page = article et article c'est le id que l'on a mis (qui sera choisi en fonction de ce que l'utilsateur choisi)
?>