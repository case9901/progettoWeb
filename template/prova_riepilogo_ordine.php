<section class="section-padding">
<div class="container">
<div class="row">
	 <br>
            <div class="col-md-12">
                <div class="col-md-8 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                    <!--SHIPPING METHOD-->
                    <div class="panel panel-default">
                        <div class="panel-heading text-center"><h4>Riepilogo ordine</h4></div>
                        <div class="panel-body">
                           <table class="table borderless">
    						<thead>
                                <tr>
									<th scope="col">Riepilogo</th>
									<th scope="col">Prezzo</th>
									<th scope="col">Quantita</th>
                                </tr>
    						</thead>
    						<tbody>
								<?php $totale=0; ?>
    							<?php foreach($templateParams["dettaglioProdotto"] as $ordine) : ?>
    							<tr>
    								<td class="col-md-3">
    								    <div class="media">
    								         <a class="thumbnail pull-left" href="product-detail.php?idProdotto=<?php echo $ordine["prodotto_idProdotto"]; ?>"> <img class="media-object" alt="" src=<?php echo "img/".$ordine["prodotto_img"]; ?> style="width: 72px; height: 72px;"> </a>
    								         <div class="media-body">
    								             <h5 class="media-heading"> <?php echo $ordine["prodotto_nome"]; ?></h5>
    								         </div>
    								    </div>
    								</td>
    								<td class="text-center"><?php echo $ordine["prezzo"]."€"; ?></td>
    								<td class="text-center"><?php echo $ordine["quantita"]; ?></td>
									<?php $totale+=$ordine["prezzo"]*$ordine["quantita"]; ?>
    								<!--<td class="text-right"><button type="button" class="btn btn-danger">Remove</button></td>-->
    							</tr>
                                <?php endforeach; ?>
    						</tbody>
    					</table> 
                        </div>
                    </div>
                    <!--SHIPPING METHOD END-->
					<p> <?php echo "Il costo totale è ".$totale."€"; ?>

                </div>
            </div>
        </div>
                                </div>
</section>