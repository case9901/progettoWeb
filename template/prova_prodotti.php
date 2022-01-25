
<section class="section-padding">

<div class="container">
<div class="col-12 text-center">
    <h2 class="mb-5">Alcuni prodotti</h2>
  </div>
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
  
  <?php foreach($templateParams["prodottiCasuali"] as $prodotti) : ?>
  <div class="col mb-4 d-flex align-items-stretch">
    <div class="card">
      <a href="product-detail.php?idProdotto=<?php echo $prodotti["idProdotto"]; ?>">
        <img src=<?php echo "img/".$prodotti["img"]; ?> class="card-img-top" alt="...">
      </a>
      <div class="card-body">
        <h5 class="card-title"><?php echo $prodotti["nome"]; ?></h5>
        <p class="card-text"><?php echo $prodotti["descrizione"]; ?></p>
      </div>
        <div class="card-footer">
          
        <form method="post" action="admin_action.php" class="inline">
                <a class="bi-search btn btn-primary" href="product-detail.php?idProdotto=<?php echo $prodotti["idProdotto"]; ?>" role="button"></a>
                <?php if(isset($_SESSION["email"]) && $_SESSION["tipoUtente"]==1) : ?>

                <input type="hidden" name="idProdotto" value="<?php echo $prodotti["idProdotto"]; ?>">
                <button type="submit" name="delete" value="delete" class="bi-trash" data-bs-toggle="modal">
                </button>
                <?php endif; ?>

              </form>
            <?php if($prodotti["sconto"]!=NULL) : ?>
              <p class="text-muted text-decoration-line-through"><?php echo $prodotti["prezzo"]."€"; ?></p>
              <p class="fw-bold"><?php echo $prodotti["sconto"]."€"; ?></p>
            <?php else : ?>
              <p class="fw-bold"><?php echo $prodotti["prezzo"]."€"; ?></p>
            <?php endif; ?>
        </div>
    </div>
  </div>
  <?php endforeach; ?>
  
</div>
  
</div>
<!-- /.container -->
</section>

