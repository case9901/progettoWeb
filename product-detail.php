<?php
require_once 'bootstrap.php';

$templateParams["nome"] = "singolo-prodotto.php";

$idProdotto = -1;

if(isset($_GET["idProdotto"])){
    $idProdotto = $_GET["idProdotto"];
}
$templateParams["prodotto"] = $dbh->getProdotto($idProdotto);

if(isset($_POST["add_cart"])) {
    $cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
    $cart = json_decode($cart);
    $prodotto=$templateParams["prodotto"][0];
    $presente=0;
    foreach ($cart as $c) {
        if ($prodotto["idProdotto"]==$c->prodotto->idProdotto) {
            $presente=1;
        }
    }
    $prezzo=0;
    if($prodotto["sconto"]==NULL) {
        $prezzo=$prodotto["prezzo"];
    } else {
        $prezzo=$prodotto["sconto"];
    }
    if ($presente==0) {
        array_push($cart, array(
            "productCode" => $idProdotto,
            "quantita" => $_POST["quantita"],
            "prezzo"=>$prezzo,
            "prodotto" => $prodotto
        ));
    } else {
        foreach ($cart as $c) {
            if ($prodotto["idProdotto"]==$c->prodotto->idProdotto) {
                $c->quantita=$_POST["quantita"];
                setcookie("cart", json_encode($cart));
            }
        }
    }
     
    setcookie("cart", json_encode($cart));
} elseif (isset($_POST["rimuovi"])) {
    $prodotto=$templateParams["prodotto"][0];

    $cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
    $cart = json_decode($cart);
    $new_cart = array();
    foreach ($cart as $c) {
        if ($prodotto["idProdotto"]!=$c->prodotto->idProdotto) {
            array_push($new_cart, $c);        
        }
    }
    setcookie("cart", json_encode($new_cart));

}
if(!isset($_POST["add_cart"]) && !isset($_POST["rimuovi"])) {
    require 'template/base.php';
} else {
    header('Location: carrello.php');
}
?>