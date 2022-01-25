            <section class="sign-in-form section-padding">  
                <div class="container">
                    <div class="row">

                        <div class="col-lg-8 mx-auto col-12">

                            <h1 class="hero-title text-center mb-5">Sign In</h1>
                            <?php if(isset($templateParams["errorelogin"])): ?>
                            <p><?php echo $templateParams["errorelogin"]; ?></p>
                            <?php endif; ?>
                            <div class="row">
                                <div class="col-lg-8 col-11 mx-auto">
                                    <form role="form" method="POST" action="#">

                                        <div class="form-floating mb-4 p-0">
                                            <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Email address" required>

                                            <label for="email">Email address</label>
                                        </div>

                                        <div class="form-floating p-0">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>

                                            <label for="password">Password</label>
                                        </div>
                                        <input type="submit" name="submit" value="Invia" />



                                        <p class="text-center">Non hai un account? <a href="sign-up.php">Registrati</a></p>

                                    </form>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>
            </section>