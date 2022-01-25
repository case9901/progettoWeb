<?php
    include("bootstrap.php");
    if (isset($_POST['register'])) {
        $login_result = $dbh->trovaUtente($_POST["email"]);
        if(count($login_result)>0){
            //Login fallito
            $templateParams["errorelogin"] = "Errore! L'utente è già registrato!";
        }
        else{
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $result=$dbh->registerUser($_POST["nome"],$password,$_POST["email"],$_POST["cognome"]);
            if ($result) {
                $login_result = $dbh->trovaUtente($_POST["email"]);

                $templateParams["notifica"]=$dbh->inserisciNotifica($_POST["email"],"Benvenuto. Grazie per esserti iscritto al sito");
                $templateParams["notifica"]=$dbh->inserisciNotifica("admin@admin","Un nuovo cliente si è iscritto al sito(email: " .$_POST["email"].")");

                registerLoggedUser($login_result[0]);
            }
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
        $templateParams["nome"] = "sign_up.php";
    }
    require 'template/base.php';
    ?>