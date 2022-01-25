<section class="section-padding">

<div class="container">
<div class="row">
	 <br>
            <div class="col-md-12">
                <div class="col-md-8 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                    <!--SHIPPING METHOD-->
                    <div class="panel panel-default">
                        <div class="panel-heading text-center"><h4>Carrello</h4></div>
                        <div class="panel-body">
                           <table class="table borderless">
  <thead>
    <tr>
      <th scope="col">Immagine</th>
      <th scope="col">Nome</th>
      <th scope="col">Descrizione</th>
      <th scope="col">Prezzo</th>
      <th scope="col">Quantita</th>
      <th scope="col">Cestina</th>

    </tr>
  </thead>
  <tbody>
    <?php
        $cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
        $cart = json_decode($cart);
 
        $totale = 0;
        
        foreach ($cart as $c) :
            $totale += $c->prezzo * $c->quantita;
            $subtotal=$c->prezzo * $c->quantita;
            
            ?>
            <tr>
              <td class="col-md-3">
    								    <div class="media">
    								         <a class="thumbnail pull-left" href="product-detail.php?idProdotto=<?php echo $c->prodotto->idProdotto; ?>"> <img class="media-object" src=<?php echo "img/".$c->prodotto->img; ?> alt = "" style="width: 72px; height: 72px;"> </a>
    								         <div class="media-body">
    								             <h5 class="media-heading"> <?php echo $c->prodotto->nome; ?></h5>
    								         </div>
    								    </div>
    								</td>
    								<td class="text-center"><?php echo $c->prodotto->nome; ?></td>
    								<td class="text-center"><?php echo $c->prodotto->descrizione; ?></td>
                    <td class="text-center"><?php echo $c->prezzo."€"; ?></td>
                    <td class="text-center"><?php echo $c->quantita; ?></td>
                    <td class="text-right">
                      <form method="post" action=<?php echo "product-detail.php?idProdotto=".$c->prodotto->idProdotto; ?>>
                        <input type="hidden" name="idProdotto" value="<?php echo $c->prodotto->idProdotto; ?>">
                        <button type="submit" method="post" name="rimuovi" value="rimuovi" data-bs-toggle="modal" data-bs-target="#cart-modal" class="btn custom-btn form-control" data-bs-toggle="modal" data-bs-target="#cart-modal">Rimuovi</button>
                      </form>
                    </td>



            </tr>
            <?php endforeach; ?>
            
  </tbody>
</table>
<?php 
  if (empty($_COOKIE["cart"])) : ?>
    <p class="text-center">Non ci sono prodotto nel carrello al momento</p>
<?php else : ?>
  <p> <?php echo "Il costo totale è ".$totale."€"; ?>
  <form role="form" method="post" action="#">
      <input type="hidden" name="totale" value="<?php echo $totale; ?>">
      <button type="submit" name="conferma_ordine" value="conferma_ordine" class="btn custom-btn cart-btn" data-bs-toggle="modal" data-bs-target="#cart-modal">Add to Cart</button>
  </form>
<?php endif; ?>

</div>
                    </div>
                </div>
            </div>
</div>
</div>
</section>