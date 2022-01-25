<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Unibo-store";
$templateParams["nome"] = "area_personale.php";
if ($_SESSION["tipoUtente"]==NULL) {
    $templateParams["ordini"] = $dbh->getOrdiniUtente($_SESSION["email"]);
} else {
    $templateParams["ordini"] = $dbh->getTuttiOrdini($_SESSION["email"]);
}
$templateParams["notifiche"] = $dbh->getNotificheUtente($_SESSION["email"]);
//Home Template

require 'template/base.php';
?>