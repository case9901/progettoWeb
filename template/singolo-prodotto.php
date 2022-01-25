            <?php 
                if (isset($templateParams["prodotto"][0])) {
                    $prodotto=$templateParams["prodotto"][0]; 
                    //controllo se prodotto presente nel carrello
                    $cart = isset($_COOKIE["cart"]) ? $_COOKIE["cart"] : "[]";
                    $cart = json_decode($cart);
                    $prodotto=$templateParams["prodotto"][0];
                    $presente=0;
                    foreach ($cart as $c) {
                    if ($prodotto["idProdotto"]==$c->prodotto->idProdotto) {
                        $presente=1;
                        $c_prodotto=$c;
                    }
                }
            }
            ?>
            <section class="product-detail section-padding">
                <div class="container">
                    <div class="row">
                        <?php 
                            if (!isset($prodotto)): ?>
                                <p>Il prodotto non è stato trovato . Potrebbe non essere piu presente</p>
                            <?php else : ?>
                            
                        <div class="col-lg-6 col-12">
                            <div class="product-thumb">
                                <img src=<?php echo "img/".$prodotto["img"]; ?> class="img-fluid product-image w-100" alt="">
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="product-info d-flex">
                                <div>
                                    <h2 class="product-title mb-0"><?php echo $prodotto["nome"]; ?></h2>

                                </div>
                                <?php if($prodotto["sconto"]==NULL) : ?>
                                    <strong class="product-price text-muted ms-auto mt-auto mb-5"><?php echo $prodotto["prezzo"]."€"; ?></strong>
                                <?php else : ?>
                                    <small class="product-price text-muted text-decoration-line-through ms-auto mt-auto mb-5"><?php echo $prodotto["prezzo"]."€"; ?></small>
                                    <strong class="product-price text-muted ms-auto mt-auto mb-5"><?php echo $prodotto["sconto"]."€"; ?></strong>
                                <?php endif; ?>
                            </div>

                            <div class="product-description">

                                <strong class="d-block mt-4 mb-2">Description</strong>

                                <p class="lead mb-5"><?php echo $prodotto["descrizione"]; ?></p>
                            </div>

                            <div class="product-cart-thumb row">
                            <?php if(isset($_SESSION["email"])): ?>
                                <form role="form" method="post" action=<?php if($_SESSION["tipoUtente"]!=1) {
                                    echo "#";
                                } else if ($_SESSION["tipoUtente"]==1) {
                                    echo "admin_action.php";
                                } ?>>

                                    <div class="col-lg-6 col-12">
                                    <?php if(isset($_SESSION["email"]) && $_SESSION["tipoUtente"]!=1) : ?>

                                        <div class="form-floating my-4">
                                            <?php if($presente!=1) : ?>
                                                <input type="number" name="quantita" id="quantita" min="1" max=<?php echo $prodotto["quantita"]; ?> class="form-control" placeholder="quantita" required>

                                                <label for="quantita">Quantita</label>
                                        
                                            <?php else : ?>
                                                <input type="number" name="quantita" id="quantita" min="1" max=<?php echo $prodotto["quantita"]; ?> value=<?php echo $c_prodotto->quantita; ?> class="form-control" placeholder="quantita" required>

                                                <label for="quantita">Nel carrello:</label>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                        <input type="hidden" name="idProdotto" value="<?php echo $prodotto["idProdotto"]; ?>" />
                                    </div>
                                    <?php if(isset($_SESSION["email"]) && $_SESSION["tipoUtente"]!=1) : ?>
                                        <div class="col-lg-6 col-12 mt-4 mt-lg-0">
                                            <?php if ($prodotto["quantita"]>0) : ?>
                                                <?php if($presente==1) : ?>
                                                    <button type="submit" name="add_cart" value="add_cart" class="btn custom-btn form-control" data-bs-toggle="modal" data-bs-target="#cart-modal">Modifica</button>
                                                    <button type="submit" name="rimuovi" value="rimuovi" class="btn custom-btn form-control" data-bs-toggle="modal" data-bs-target="#cart-modal">Rimuovi</button>

                                                <?php else: ?>
                                                    <button type="submit" name="add_cart" value="add_cart" class="btn custom-btn form-control" data-bs-toggle="modal" data-bs-target="#cart-modal">Aggiungi al carrello</button>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <p>Siamo spiacenti, il prodotto non è al momento disponibile</p>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (isset($_SESSION["email"]) && $_SESSION["tipoUtente"]==1) : ?>
                                        <div class="col-lg-6 col-12 mt-4 mt-lg-0">
                                            <button type="submit" name="modifica" value="modifica" class="mb-3 btn custom-btn form-control" data-bs-toggle="modal" data-bs-target="#cart-modal">Modifica</button>
                                            <button type="submit" name="delete" value="delete" class="btn custom-btn form-control" data-bs-toggle="modal" data-bs-target="#cart-modal">Elimina</button>

                                        </div>

                                        
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </form>
                            </div>

                        </div>
                    <?php endif; ?>
                    </div>
                </div>
            </section>