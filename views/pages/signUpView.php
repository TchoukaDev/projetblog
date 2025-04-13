<h3> Inscription: </h3>

<form method="POST" action="index.php?page=signup">
    <p>

        <input type='text' name='name' id='name' required placeholder="Nom">


        <input type="text" name="first_name" id="first_name" required placeholder="Prénom">
    </p>

    <p>

        <input type="email" name="email" id="email" required placeholder="Adresse email">
    </p>
    <p>

        <input type="password" name="password" id="password" required placeholder="Mot de passe">
    </p>
    <p>
        <input type="password" name="password2" id="password2" required placeholder="Confirmer le mot de passe">
    </p>
    <p>
        <input type="submit" value="S'inscrire">
    </p>
</form>
<?php if (isset($_SESSION["signUpError"])) {
    echo "<p class='text-danger'>" . $_SESSION['signUpError'] . "</p>";
    unset($_SESSION['signUpError']);
}
if (isset($_SESSION['signUpSuccess'])) {
    echo "<p class='text-success'>" . $_SESSION['signUpSuccess'] . "</p>";
    unset($_SESSION['signUpSuccess']);
} ?>