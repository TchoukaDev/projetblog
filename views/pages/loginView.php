<?php
if (!isset($_SESSION['connected'])): ?>
    <section class="container">
        <div class="d-flex justify-content-center">
            <form class=" bg-main shadowlight border border-lightuielement text-center p-5 rounded-4 w-75 w-xl-50 mt-5 mb-2" method="POST" action="index.php?page=login">
                <h3 class="text-center mb-5 text-decoration-underline"> Connexion: </h3>

                <p>
                <div class="input-group mx-auto w-100 w-md-75 w-lg-50">

                    <input type="email" name="email" id="email" class="form-control  signUpInput" placeholder="Adresse email" required aria-label="Email">
                    <span class="input-group-text">@</span>
                </div>
                </p>
                <p>
                    <input type="password" name="password" id="password" class="form-control m-auto w-100 w-md-75 w-lg-50 signUpInput" placeholder="Mot de passe" required aria-label="Mot de passe">
                </p>
                <p>
                    <input class="btn btn-outline-light mt-4" type="submit" value="Se connecter">
                </p>
                <?php if (isset($_SESSION["loginError"])) : ?>
                    <p class='text-danger'><?= $_SESSION['loginError'] ?></p>
                <?php
                    unset($_SESSION['loginError']);
                endif; ?>
            </form>

        <?php endif;
        ?>
        </div>
    </section>