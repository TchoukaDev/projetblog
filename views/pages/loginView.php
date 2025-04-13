<?php

if (!isset($_SESSION['connected'])): ?>

    <form method="POST" action="index.php?page=login">
        <h2>Se connecter</h2>

        <p>
            <label for="email">Email</label>
            <span class="input-group-text">@</span>
            <input type="email" name="email" id="email" class="form-control" required>
        </p>
        <p>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </p>
        <p>
            <input type="submit" value="Se connecter">
        </p>
    </form>

<?php endif;

if (isset($_SESSION["loginError"])) {
    echo "<p class='text-danger'>" . $_SESSION['loginError'] . "</p>";
    unset($_SESSION['loginError']);
}
?>