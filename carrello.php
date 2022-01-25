<?php
require_once 'bootstrap.php';
$templateParams["titolo"] = "Unibo-Store";
if (isset($_POST["conferma_ordine"])) {
    $result=$dbh->crea_ordine($_POST["totale"]);
    if ($result==0) {
        $last_id=$dbh->getLastOrdine()[0];
        $result=$dbh->inserisciNotifica($_SESSION["email"],"Ordine Confermato (codice ordine: ".$last_id["idOrdine"].")");
        $result=$dbh->inserisciNotifica("admin@admin","E'stato mandato un ordine(codice ordine: ".$last_id["idOrdine"]. "; Email Utente: ".$_SESSION["email"].")");

        setcookie("cart", "", time() - 3600);

        header("Location:login.php");
    }

} else {
    $templateParams["nome"] = "carrello.php";
    require 'template/base.php';
}
?>