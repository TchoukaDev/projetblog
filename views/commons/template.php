<?php
require_once 'views/components/navbar_items.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tiny.cloud/1/t5iv00mwkwxr9bk98986eqsgfui2kpyu3b5pmj4oogs95d3g/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="<?= ROOT ?>public/design/css/main.css">
    <title><?= $title ?></title>
</head>

<header class="bg-main text-light text-center p-4 fw-bold">
    <h1>Romain WIRTH</h1>
    <h2>Développeur Full Stack en formation</h2>
</header>
<nav class="navbar bg-navbar navbar-dark navbar-expand-sm">
    <div class="container">
        <div class="navbar-brand me-5">TchoukaDev</div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php foreach ($navbarItems as $link): ?>
                    <li class="nav-item">
                        <a href=<?= $link['url'] ?> class="nav-link"><?= $link['label'] ?></a>
                    </li>
                <?php endforeach ?>
            </ul>

        </div>
    </div>
</nav>
<?php
if (isset($_SESSION['firstName'])) : ?>
    <div class="bg-dark  fst-italic fs-5 ">
        <div class="container text-end d-flex justify-content-between">
            <div class="text-light pt-3">
                Bonjour <?= $_SESSION['firstName']; ?>
            </div>
            <a href="logout" class="btn btn-outline-light btn-sm mt-3 fst-normal">Se déconnecter</a>
        </div>
    </div>
<?php
else: ?>
    <div class="container d-flex justify-content-end">
        <div class=" btn-group w-25 ">
            <a href="login" class="btn btn-outline-light btn-sm mt-3">Se connecter</a>
            <a href="signup" class="btn btn-outline-light btn-sm mt-3">S'inscrire</a>
        </div>
    </div>
<?php
endif
?>



<body class="vh-100 bg-dark text-light">


    <?= $content ?>


    <footer>
        A Faire--------------------------
    </footer>
    <script>
        <?= require_once 'public/js/tiny.js'; ?>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= ROOT ?>public/js/main.js"></script>
</body>

</html>