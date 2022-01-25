<!doctype html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Unibo-Store</title>

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <!--<link rel="stylesheet" href="css/slick.css"/>-->

        <link href="css/style.css" rel="stylesheet">

    <?php
    if(isset($templateParams["js"])):
        foreach($templateParams["js"] as $script):
    ?>
        <script src="<?php echo $script; ?>"></script>
    <?php
        endforeach;
    endif;
    ?>
</head>
<body>
    <header class="site-header">
        <?php
            require("navbar.php");
            if (isset($templateParams["nome"]) && $templateParams["nome"]=="prova_prodotti.php") {
                require("carousel.php");
            }
        ?>
    </header>
    <main>
    <?php
        if(isset($templateParams["nome"])){
            require($templateParams["nome"]);
        }
    ?>
    </main>
    
        <?php 
            require("footer.php");
        ?>


    
    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/Headroom.js"></script>
        <script src="js/jQuery.headroom.js"></script>
        <script src="js/slick.min.js"></script>-->
        <script src="js/custom.js"></script>
</body>
</html>