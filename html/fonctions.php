<?php
//une autre façon d'afficher les articles de la manière des Fonctions
function afficheArticle($articles){ // pour afficher les articles spécifiquement celui qui est sélectionné
    $liste_article = [
        [
            'id' => 1,
            'photo' => "img/bouteille.jpg",
            'nom' => "<p>Bouteille</p> ",
            'prix' => 20,//pas besoin de '' pour les chiffres, ça comprend que ce sont des chiffres
            'description' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
        ],
        [
            'id' => 2,
            'photo' => "img/mug.jpg",
            'nom' => "<p>Mug</p> ",
            'prix' => 15,
            'description' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
        ],
        [
            'id' => 3,
            'photo' => "img/couverts.jpg",
            'nom' => "<p>Couverts</p>",
            'prix' => 12,
            'description' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
        ]
    ];

  foreach ($liste_article as $element) { // boucle foreach qui parcourt element du tableau (si $articles est égal ) l'id de chaque element affiche)
    if($articles == $element['id'] ){ // important de comparer pour afficher !! 
    echo '<div class="contain">','<img class="img" src="'.$element['photo'].'" />'. "\n", $element['nom'] , '<p class="justi">', $element['description'], '</p>' , $element['prix'], "€",'</div>';
}
}
}

//ETAPE 7 - Création du panier
function affichePanier($panier){ // création du $panier et je lui dis (voir en bas dans total panier) que je récupère $element[id] l'id de mon tableau (car comparaison)
    $liste_article = [

        [
            'id' => 1,
            'photo' => "img/bouteille.jpg",
            'nom' => "<p>Bouteille Isotherme</p> ",
            'prix' => 20
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

  foreach ($liste_article as $element) { // je vais chercher element dans mon tableau liste_article
    if($panier == $element['id'] ){ // important de comparer pour afficher !!
    echo '<div class="contain">','<img class="img" src="'.$element['photo'].'" />'. "\n", $element['nom'] , $element['prix'], "€",'</div>'; 
}
}
}

// Total du panier quand on modifie la quantité | revoir la seconde partie pour la modification de la quantité
function totalPanier($id,$quantite) { // créer une variable pour faire le calcul du total du panier et affiche ce total (comme la variable $liste_article)
    $liste_article = [

        [
            'id' => 1,
            'photo' => "img/bouteille.jpg",
            'nom' => "<p>Bouteille Isotherme</p> ",
            'prix' => 20
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
foreach ($liste_article as $element){ // donc on reparcout element du tableau 
    if($id == $element['id']){ // si $id (du paramètre de la fonction) est égal à l'id de l'element du tableau 
        $total=$quantite*$element['prix']; //{Ancien Com quand calul $total= $post[quantite]*$post[prix] : je récupère par le POST les infos du formulaire (fait le lien)}  le total=$quantite(nombre)*le prix de l'element du tableau
        echo '<div class="contain"> <form method="POST" action="index.php?page=panier.php">',// affiche blabla + action = envoie les informations sur la page Panier
        '<input type="number" name="quantite" min="0" value="'.$quantite.'" >', // min permet de savoir que c'est un entier nombre : saisie du nombre d'article + $quantite {AC : on récupère par la méthode du formulaire}
        '<input type="hidden" name="article" value="'.$id.'">', // élement masqué : correspond à l'id de l'article (id 1, id 2 et id 3)
        //'<input type="hidden" name="prix" value="'.$_POST['prix'].'">', // élement masqué : correspond au prix de l'article 
        '<input type="submit" name="modifQuantite" value="Modifier la quantité"> </form>','<p> Sous-total : '.$total.' € </p>','</div>'; // {AC : name=submit }
    }
}
}

function totaltotal(){
    $liste_article = [

        [
            'id' => 1,
            'photo' => "img/bouteille.jpg",
            'nom' => "<p>Bouteille Isotherme</p> ",
            'prix' => 20
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
    $montanttotal = 0; // on crée une variable = 0 qui nous servira a calcuer le montant total des articles via l'action ci-dessous
    foreach ($_SESSION['panier'] as $k => $v) { // on parcout le tableau panier via foreach (avec Sessions qui stocke les données indiv) avec var k associé à var v soit $key => $value ($k parcours et stock dans $v) soit $k => $v = id => 1 etc
        foreach($liste_article as $element){
            if($element['id'] == $_SESSION['panier'][$k]['id']){ // si l'id de l'element du tableau est égal au donnees du tableau panier
        $total=$element['prix']*$_SESSION['panier'][$k]['quantite'];
        $montanttotal=$total+$montanttotal; // nouveau montanttotal = total(donc )
    }
    }
}
    echo "<div class='contain'><p>Le montant total de la commande est de : ".$montanttotal."€</p></div>";
}

function modifQuantite($id,$quantite,$ajout){ // fonction pour modifier la quantité de l'article avec les paramètres id et quantité que l'on va ajouter dans le panier
    $exist = false;
    if (!isset($_SESSION['panier'])){
        $_SESSION['panier'][] = ['id' => $_POST['article'], 'quantite' => $_POST['quantite']];
    }else{
        $modif = count($_SESSION['panier']); // variable modif (créée) est égal à la variable $-session du tableau panier - count : compte tous les élément du tableau panier
        for($i = 0; $i <$modif; $i++){ // $i = 0 (création de la var) ; $i < $modif (comptage des element du panier) ; $i ++ qui fait chaque ligne du panier (passe au suivant)
            if ($id == $_SESSION['panier'][$i]['id']){ // si var id est strictement égal au panier tableau, à l'index tableau et à l'id tableau alors ...
                if($ajout == true) $_SESSION['panier'][$i]['quantite'] = $quantite; // ... = $quantité
                if($ajout == false) $_SESSION['panier'][$i]['quantite'] += $quantite;
                $exist = true;
            }
        }
        if ($exist == false){
            $_SESSION['panier'][] = ['id' => $_POST['article'], 'quantite' => $_POST['quantite']];
        }
    }
}
    

function viderPanier($panier) { // variable pour vider le panier
    unset($_SESSION['panier']); // unset : supprime le panier
}
?>