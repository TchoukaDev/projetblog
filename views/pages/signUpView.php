<section class="container">
    <div class="d-flex justify-content-center">
        <form class=" bg-main shadowlight border border-lightuielement text-center p-5 rounded-4 w-75 w-xl-50 mt-5 mb-2" method="POST" action="index.php?page=signup">
            <h3 class="text-center mb-5 text-decoration-underline"> Inscription: </h3>

            <?php if (!isset($_SESSION['signUpSuccess'])) : ?>
                <p>
                    <input class="form-control mx-auto w-100 w-md-75 w-lg-50 signUpInput" type='text' name='name' id='name' required placeholder="Nom">
                </p>
                <p>
                    <input class="form-control mx-auto w-100 w-md-75 w-lg-50 signUpInput" type="text" name="first_name" id="first_name" required placeholder="Prénom">
                </p>

                <p>

                    <input class="form-control mx-auto w-100 w-md-75 w-lg-50 signUpInput" type="email" name="email" id="email" required placeholder="Adresse email">
                </p>
                <p>

                    <input class="form-control mx-auto w-100 w-md-75 w-lg-50 signUpInput" type="password" name="password" id="password" required placeholder="Mot de passe">
                </p>
                <p>
                    <input class="form-control mx-auto w-100 w-md-75 w-lg-50 signUpInput" type="password" name="password2" id="password2" required placeholder="Confirmer le mot de passe">
                </p>
                <p>
                    <input class="btn btn-outline-light mt-4" type="submit" value="S'inscrire">
                </p>
            <?php endif;

            if (isset($_SESSION["signUpError"]) || isset($_SESSION['signUpSuccess'])) : ?>
                <div class="">
                    <?php
                    if (isset($_SESSION["signUpError"])) : ?>
                        <p class='text-danger'> <?= $_SESSION['signUpError'] ?></p>
                    <?php unset($_SESSION['signUpError']);
                    endif;
                    if (isset($_SESSION['signUpSuccess'])) : ?>
                        <p class='text-success'> <?= $_SESSION['signUpSuccess'] ?></p>

                    <?php
                        unset($_SESSION['signUpSuccess']);
                    endif;
                    ?>
                </div>
            <?php
            endif; ?>
        </form>
    </div>

    </div>

</section>