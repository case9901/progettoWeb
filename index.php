<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Unibo-Store";
$templateParams["nome"] = "prova_prodotti.php";
$templateParams["prodottiCasuali"]=$dbh->getProdottiCasuali();
require 'template/base.php';
?>