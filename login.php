<?php
require_once 'bootstrap.php';
if(isset($_POST["email"]) && isset($_POST["password"])) {
    $utente=$dbh->trovaUtente($_POST["email"])[0];
    if(password_verify($_POST["password"], $utente["password"])) {
        registerLoggedUser($utente);
    } else {
        $templateParams["errorelogin"] = "Errore! Controllare username o password!";
    }
}

if(isUserLoggedIn()){
    $templateParams["titolo"] = "Unibo-Store";
    $templateParams["nome"] = "area_personale.php";
    if($_SESSION["tipoUtente"]==NULL) {
        $templateParams["ordini"] = $dbh->getOrdiniUtente($_SESSION["email"]);
    } else {
        $templateParams["ordini"] = $dbh->getTuttiOrdini();

    }
    $templateParams["notifiche"] = $dbh->getNotificheUtente($_SESSION["email"]);

    //$templateParams["articoli"] = $dbh->getPostByAuthorId($_SESSION["idautore"]);
    if(isset($_GET["formmsg"])){
        $templateParams["formmsg"] = $_GET["formmsg"];
    }
}
else{
    $templateParams["titolo"] = "Unibo-Store";
    $templateParams["nome"] = "sign-in.php";
}
/*$templateParams["categorie"] = $dbh->getCategories();
$templateParams["articolicasuali"] = $dbh->getRandomPosts(2);*/

require 'template/base.php';
?>