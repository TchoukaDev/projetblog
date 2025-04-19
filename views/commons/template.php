<?php
require_once 'views/fragments/navbar_items.php';
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

<body class="min-vh-100 bg-dark text-light d-flex flex-column">

    <!-- header -->
    <header class="bg-main text-light text-center p-4 fw-bold">
        <h1>Romain WIRTH</h1>
        <h2>Développeur Full Stack en formation</h2>
    </header>

    <!-- Navbar -->
    <nav class="navbar border-bottom bg-navbar sticky-top navbar-dark navbar-expand-sm">
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

    <!-- Barre de connexion/inscription -->
    <?php
    if (isset($_SESSION['firstName'])) : ?>
        <div class="bg-dark fst-italic fs-5 mt-4 ">
            <div class="container text-end d-flex justify-content-between align-items-center">
                <div class="text-light">
                    Bonjour <?= $_SESSION['firstName']; ?>
                </div>
                <a href="logout" class="btn btn-lightuielement border border-lightbg fst-normal">Se déconnecter</a>
            </div>
        </div>
    <?php
    else: ?>
        <div class="container d-flex justify-content-sm-end justify-content-center mt-4">
            <div class=" btn-group w-25 ">
                <a href="login" class="btn d-flex justify-content-center align-items-center border border-lightbg btn-lightuielement">Se connecter</a>
                <a href="signup" class="btn d-flex justify-content-center align-items-center border border-lightbg btn-darkuielement">S'inscrire</a>
            </div>
        </div>
    <?php
    endif
    ?>
    <main class="flex-grow-1">





        <?= $content ?>

    </main>
    <footer class=" border-top border-light bg-navbar mt-5 p-4">
        <div class=container>
            <span class="fst-italic">©TchoukaDev <?= date('Y') ?> </span>
        </div>
    </footer>

    <script src="public/js/tooltip.js">

    </script>
    <script src="public/js/tiny.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/main.js" type="module"></script>
    <script src="public/js/article.js" type="module"></script>
    <script src="public/js/review.js" type="module"></script>

</body>

</html>