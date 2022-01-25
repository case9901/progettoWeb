<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Unibo-Store";
$templateParams["nome"] = "lista_prodotti.php";
/*$templateParams["categorie"] = $dbh->getCategories();
$templateParams["articolicasuali"] = $dbh->getRandomPosts(2);*/
//Home Template
//$templateParams["articoli"] = $dbh->getPosts(2);
$templateParams["prodottiCasuali"]=$dbh->getProdottiCasualiTutti();
require 'template/base.php';
?>
