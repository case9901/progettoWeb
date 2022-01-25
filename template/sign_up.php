<section class="sign-in-form section-padding">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 mx-auto col-12">

                            <h1 class="hero-title text-center mb-5">Sign Up</h1>
                            <?php if(isset($templateParams["errorelogin"])): ?>
                            <p><?php echo $templateParams["errorelogin"]; ?></p>
                            <?php endif; ?>

                            <div class="row">
                                <div class="col-lg-8 col-11 mx-auto">
                                    <form role="form" method="post" action="">

                                        <div class="form-floating">
                                            <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email address" required>

                                            <label for="email">Email address</label>
                                        </div>

                                        <div class="form-floating my-4">
                                            <input type="password" name="password" id="password" pattern="[0-9a-zA-Z]{4,10}" class="form-control" placeholder="Password" required>

                                            <label for="password">Password</label>
                                            
                                            <p class="text-center">* shall include 0-9 a-z A-Z in 4 to 10 characters</p>
                                        </div>
                                        
                                        <div class="form-floating my-4">
                                            <input type="text" name="nome" id="nome" pattern="*" class="form-control" placeholder="Nome" required>

                                            <label for="nome">Nome</label>
                                        </div>

                                        <div class="form-floating my-4">
                                            <input type="text" name="cognome" id="cognome" pattern="*" class="form-control" placeholder="Cognome" required>

                                            <label for="cognome">Cognome</label>
                                        </div>

                                        <button type="submit" name="register" value="register" class="btn custom-btn form-control mt-4 mb-3">
                                            Create account
                                        </button>

                                        <p class="text-center">Hai gia un account? <a href="login.php">Accedi</a></p>

                                    </form>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>
            </section>