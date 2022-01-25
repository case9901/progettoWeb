<section class="featured-product section-padding">
<div class="container pb-4 ";>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Immagine</th>
      <th scope="col">Nome</th>
      <th scope="col">Descrizione</th>
      <th scope="col">Prezzo</th>
      <th scope="col">Quantita</th>
    </tr>
  </thead>
  <tbody>
    <?php $totale=0; ?>
    <?php foreach($templateParams["dettaglioProdotto"] as $ordine) : ?>
    <tr>
      <div class="wrapper">
        <th scope="row"><img class="card-image-top" src=<?php echo "img/".$ordine["img"]; ?> alt="..."></th>
      </div>
      <td><?php echo $ordine["nome"]; ?></td>
      <td><?php echo $ordine["descrizione"]; ?></td>
      <td><?php echo $ordine["prezzo"]; ?></td>
      <td><?php echo $ordine["quantita"]; ?></td>
      <?php $totale+=$ordine["prezzo"]*$ordine["quantita"]; ?>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
<p> <?php echo "Il costo totale è ".$totale."€"; ?>

</div>
</section>