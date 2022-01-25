<?php
require_once 'bootstrap.php';
if(isset($_POST["guarda_ordine"]))  {
    $templateParams["dettaglioProdotto"]=$dbh->prendiOrdine($_POST["idOrdine"]);
    $templateParams["nome"]="prova_riepilogo_ordine.php";
    require ("template/base.php");
}