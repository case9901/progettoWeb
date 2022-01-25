<section class="featured-product section-padding">
<div class="container pb-4">
<table class="table table-hover table-fixed">
  <thead>
    <tr>
      <th scope="col">Codice Ordine</th>
      <th scope="col">Data Ordine</th>
      <th scope="col">Costo</th>
      <th scope="col">Visualizza</th>
      <?php if($_SESSION["tipoUtente"]==1) : ?>
        <th scope="col">Email</th>
      <?php endif; ?>
    </tr>
  </thead>
  <tbody>
    <?php foreach($templateParams["ordini"] as $ordine) : ?>
    <tr>
      <th scope="row"><?php echo $ordine["idOrdine"]; ?></th>
      <td><?php echo $ordine["dataOrdine"]; ?></td>
      <td><?php echo $ordine["prezzoTotale"]; ?></td>
      <td>
        <form method="post" action="guarda_ordine.php" class="inline">
          <input type="hidden" name="idOrdine" value="<?php echo $ordine["idOrdine"]; ?>">
          <button type="submit" name="guarda_ordine" value="guarda_ordine" class="btn btn-link">Link</button>
        </form>
      </td>
      <?php if($_SESSION["tipoUtente"]==1) : ?>
        <td><?php echo $ordine["utente_email"]; ?></td>
      <?php endif; ?>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
<?php 
  if (empty($templateParams["ordini"])) : ?>
    <p class="text-center">Non ci sono ordini al momento</p>
  <?php endif; ?>
</div>
<div class="container">
<table class="table table-hover table-fixed pt-4">
  <thead>
    <tr>
      <th scope="col">Codice Notifica</th>
      <th scope="col">Data Notifica</th>
      <th scope="col">Messaggio</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($templateParams["notifiche"] as $notifica) : ?>
    <tr>
      <th scope="row"><?php echo $notifica["idNotifiche"]; ?></th>
      <td><?php echo $notifica["tempo"]; ?></td>
      <td>
        <?php if($notifica["link"]!=NULL) : ?>
          <a href="<?php echo $notifica["link"]; ?>">
            <?php echo $notifica["messaggio"]; ?>
        </a>
        <?php else :?>
          <?php echo $notifica["messaggio"]; ?>
        <?php endif; ?>
        </td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
</div>
</section>
