<?php if($_SESSION["tipoUtente"]==1) {
    $prodotto=$templateParams["prodotto"][0];
}
?>
<section class="sign-in-form section-padding">
    <div class="container">
        <div class="row">
            <h1 class="hero-title text-center mb-5">Modifica Prodotto</h1>
            <div class="col-lg-8 col-11 mx-auto">
                <form role="form" method="post" action="admin_action.php" enctype="multipart/form-data">

                    <div class="form-floating">
                        <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome Prodotto" value="<?php echo $prodotto["nome"]; ?>" required>

                        <label for="nome">Nome Prodotto</label>
                    </div>

                    <div class="form-floating my-4">
                        <input type="text" name="descrizione" id="descrizione" class="form-control" placeholder="Descrizione" value="<?php echo $prodotto["descrizione"]; ?>" required>

                        <label for="descrizione">Descrizione</label>
                    </div>

                    <div class="form-floating">
                        <input type="number" name="prezzo" id="prezzo" min="0" step=".01" class="form-control" placeholder="prezzo" value="<?php echo $prodotto["prezzo"]; ?>" required>

                        <label for="prezzo">Prezzo</label>
                    </div>

                                        
                    <div class="form-floating my-4">
                        <input type="number" name="sconto" id="sconto" min="0" step=".01" class="form-control" placeholder="sconto" value="<?php echo $prodotto["sconto"]; ?>">

                        <label for="sconto">Sconto</label>
                    </div>

                    <div class="form-floating my-4">
                        <input type="number" name="quantita" id="quantita" min="1" class="form-control" placeholder="quantita" value="<?php echo $prodotto["quantita"]; ?>" required>

                        <label for="quantita">Quantita</label>
                    </div>

                    <div class="form-floating my-4">
                        <input type="file" name="img" id="img" class="form-control-file">

                    </div>
                    
                    <input type="hidden" name="idProdotto" id="idProdotto" value="<?php echo $prodotto["idProdotto"]; ?>">

                    <input type="hidden" name="oldimg" id="oldimg" value="<?php echo $prodotto["img"]; ?>">
                    <button type="submit" name="invio_prodotto" value="invio_prodotto" class="btn custom-btn form-control mt-4 mb-3">
                        Modifica Prodotto
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>