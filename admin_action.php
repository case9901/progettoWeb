<?php
require_once 'bootstrap.php';
if(isset($_POST["delete"])) {
    $result=$dbh->eliminaProdotto($_POST["idProdotto"]);
    
    $result=$dbh->inserisciNotifica($_SESSION["email"],"hai eliminato con successo il prodotto");
    
    header('Location: login.php');
}

if (isset($_POST["modifica"])) {
    $templateParams["prodotto"]=$dbh->getProdotto($_POST["idProdotto"]);
    $templateParams["nome"]="modifica_elemento.php";
    require("template/base.php");
}

if(isset($_POST["invio_prodotto"])) {
    if(isset($_FILES["img"]) && strlen($_FILES["img"]["name"])>0){
        list($result, $msg) = uploadImage("img/", $_FILES["img"]);

        $imgarticolo = $msg;

    } else {
        $imgarticolo=$_POST["oldimg"];
    }
    if($_POST["sconto"]==0) {
        $_POST["sconto"]=NULL;
    }
    $result=$dbh->modificaProdotto($_POST["nome"],$_POST["descrizione"],$_POST["prezzo"],$_POST["sconto"],$_POST["quantita"],$imgarticolo,$_POST["idProdotto"]);
    if ($result) {
        $result=$dbh->inserisciNotifica($_SESSION["email"],"hai modificato con successo il prodotto ".$_POST["idProdotto"],"product-detail.php?idProdotto=".$_POST["idProdotto"]);
        header("Location:login.php");
    }
}

if(isset($_GET["action"]) && ($_GET["action"]=="insert")) {
    $templateParams["nome"]="nuovo_elemento.php";
    require("template/base.php");
}

if(isset($_POST["nuovo_prodotto"])) {
    if(isset($_FILES["img"]) && strlen($_FILES["img"]["name"])>0){
        list($result, $msg) = uploadImage("img/", $_FILES["img"]);
        if($result == 0){
            echo $msg;
        }
        $imgarticolo = $msg;

    }
    if($_POST["sconto"]==0) {
        $_POST["sconto"]=NULL;
    }
    $result=$dbh->inserisciProdotto($_POST["nome"],$_POST["descrizione"],$_POST["prezzo"],$_POST["sconto"],$_POST["quantita"],$imgarticolo);  
    if ($result) {
        $last_id=$dbh->getLastId();
        $result=$dbh->inserisciNotifica($_SESSION["email"],"hai inserito con successo il nuovo prodotto","product-detail.php?idProdotto=".$last_id);
        header("Location: login.php");
    }  
}

?>