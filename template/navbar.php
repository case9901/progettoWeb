            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <a class="navbar-brand" href="index.php">
                        <strong><span>Unibo</span> Store</strong>
                    </a>


                    <!--    schermo mobile    -->
                    <div class="d-lg-none dropdown">
                        <!--Parte Login, aggiungere if per accesso-->
                        <a href="#" class="dropdown dropdown-toggle bi-person custom-icon me-3" data-bs-toggle="dropdown"></a>

                        <div class="dropdown-menu">
                            <?php if (isset($_SESSION["email"])) : ?>
                                <a href="login.php" class="dropdown-item">Profilo</a>
                                <a href="logout.php" class="dropdown-item">Logout</a>
                            <?php else : ?>
                                <a href="login.php" class="dropdown-item">Login</a>
                                <a href="sign-up.php" class="dropdown-item">Registrati</a>
                            <?php endif; ?>
                        </div>

                        <!--<a href="sign-in.html" class="bi-person custom-icon me-3"></a>-->

                        <a href="carrello.php" class="bi-bag custom-icon"></a>
                    </div>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="<?php isActive("index.php");?> nav-link" href="index.php">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="<?php isActive("lista_prodotti.php");?> nav-link" href="lista_prodotti.php">Prodotti</a>
                            </li>

                        </ul>

                        <div class="d-none d-lg-block dropdown">
                                <a href="#" class="dropdown dropdown-toggle bi-person custom-icon me-3" data-bs-toggle="dropdown"></a>

                                <div class="dropdown-menu">
                                    <?php if (isset($_SESSION["email"]) && ($_SESSION["tipoUtente"]==1)) : ?>
                                        <a href="admin_action.php?action=insert" class="dropdown-item">Aggiungi Prodotto</a>

                                        <a href="login.php" class="dropdown-item">Profilo</a>
                                        <a href="logout.php" class="dropdown-item">Logout</a>
                                    <?php elseif (isset($_SESSION["email"]) && ($_SESSION["tipoUtente"]!=1)) : ?>
                                        <a href="login.php" class="dropdown-item">Profilo</a>
                                        <a href="logout.php" class="dropdown-item">Logout</a>
                                    <?php else: ?>
                                        <a href="login.php" class="dropdown-item">Login</a>
                                        <a href="sign-up.php" class="dropdown-item">Registrati</a>
                                    <?php endif; ?>
                                </div>
                            <?php if(isset($_SESSION["email"])) : ?>
                                <a href="carrello.php" class="bi-bag custom-icon"></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </nav>