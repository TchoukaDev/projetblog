<main class=" container mb-5" id="addArticleLink">
    <div class="d-flex justify-content-center mb-5 mt-2">
        <h2 class="bg-main p-4 rounded-pill w-50 text-center border border-light">Mes articles</h2>
    </div>
    <!--Formulaire d'ajout d'article -->
    <?php
    if (isset($_SESSION['admin'])): ?>

        <form class="container" style="display: none;" id="addArticleForm" action="blog/addarticle" method="POST">
            <p class="d-flex justify-content-end">
                <button type="button" class="btn btn-close btn-close-white border border-navbar" title="Fermer l'éditeur de texte" data-bs-toggle="tooltip" data-bs-placement="right" id="closeAddArticleBtn"></button>
            </p>

            <?php if (isset($_SESSION['firstName'])) : ?>
                <input type="hidden" name="first_name" id="first_name" value="<?= $_SESSION['firstName'];
                                                                            endif; ?>">
                <?php if (isset($_SESSION['name'])) : ?>
                    <input type="hidden" name="name" id="name" value="<?= $_SESSION['name'];
                                                                    endif; ?>">
                    <p>
                        <input type="text" class="form-control" name="title" placeholder="Choisissez un titre..." required aria-label="Article title">
                    </p>
                    <p><textarea class="tiny" name="content" placeholder="Ecrivez votre article..." aria-label="Article content"></textarea></p>
                    <p class="text-center"><button type=" submit" class="btn btn-outline-light">Publier l'article</button></p>
        </form>

        <!-- Notifications -->
        <?php
        if (isset($_SESSION["articlesError"])) {
            echo "<p class='text-danger text-center py-3'>" . $_SESSION['articlesError'] . "</p>";
            unset($_SESSION['articlesError']);
        }
        if (isset($_SESSION['articlesSuccess'])) {
            echo "<p class='text-success text-center py-3'>" . $_SESSION['articlesSuccess'] . "</p>";
            unset($_SESSION['articlesSuccess']);
        }
        if (isset($_SESSION["reviewsError"])) {
            echo "<p class='text-danger text-center py-3'>" . $_SESSION['reviewsError'] . "</p>";
            unset($_SESSION['reviewsError']);
        }
        if (isset($_SESSION['reviewsSuccess'])) {
            echo "<p class='text-success text-center py-3'>" . $_SESSION['reviewsSuccess'] . "</p>";
            unset($_SESSION['reviewsSuccess']);
        }
        ?>


    <?php endif;



    foreach ($articles as $article):


        // Conversion de la date puis affichage des articles

        $articleDate = new DateTime($article['creation_date']);
        $articleDateFr = $articleDate->format('d/m/Y H:i');
        $articleContent = html_entity_decode($article['content']);

        $lastArticle = end($articles);

    ?>

        <section class="container bg-main border border-lightuielement mb-5 px-5 p-5 rounded-4 shadowlight">

            <?php if (isset($_SESSION['admin'])) : ?>
                <div class='border border-borderbtn bg-navbar d-flex flex-column px-4 pt-4 articleAuthor'>
                <?php else: ?>
                    <div class='border border-borderbtn bg-navbar d-flex flex-column p-4 articleAuthor'>
                    <?php endif; ?>

                    <div class="border-bottom border-borderbtn fs-5 mb-4">
                        <?php
                        //Buttons de modification et suppression de l'article
                        if (isset($_SESSION['admin'])) : ?>
                            <div class="text-end">
                                <button type="button" class='btn btn-lightuielement border' id="updateArticleBtn_<?= $article['id'] ?>" title="Modifier l'article" data-bs-toggle="tooltip" data-bs-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M12.146.854a.5.5 0 0 1 .708 0l2.292 2.292a.5.5 0 0 1 0 .708l-9.5 9.5a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l9.5-9.5zM11.207 2L13 3.793 14.293 2.5 12.5.707 11.207 2zM10.5 2.707L2 11.207V13h1.793l8.5-8.5L10.5 2.707z" />
                                    </svg></button>
                                <span title="Supprimer l'article" data-bs-toggle="tooltip" data-bs-placement="bottom"><button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#deleteArticleModal<?= $article['id'] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5a.5.5 0 0 1 .5-.5H6h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5zM4.5 2.5A.5.5 0 0 1 5 2h6a.5.5 0 0 1 .5.5V3H14a.5.5 0 0 1 0 1h-1.132l-.858 9.171A1.5 1.5 0 0 1 10.516 14H5.484a1.5 1.5 0 0 1-1.494-1.829L3.132 4H2a.5.5 0 0 1 0-1h2.5v-.5z" />
                                        </svg>
                                    </button></span>
                            </div>
                        <?php endif; ?>
                        <div class="text-center px-5 py-3">
                            <h3><?= $article['title'] ?><br></h3>
                        </div>
                        <div class="d-flex justify-content-between px-5 ">
                            <p>Auteur: <?= $article['first_name'] . " " . $article['name'] ?></p><br>
                            <p>Publié le <?= $articleDateFr ?></p>
                        </div>



                        <div class=" d-flex flex-column bg-navbar mb-4 px-5 pt-5 articleContent">

                            <?= $articleContent ?>


                        </div>
                    </div>
                    <?php
                    if (isset($_SESSION['admin'])) : ?>

                        <!-- Btn fermer textarea -->
                        <div class="container d-flex justify-content-end">
                            <button style="display: none;" class="btn btn-outline-light mb-3"
                                id="closeUpdateArticleBtn_<?= $article['id'] ?>">Fermer</button>
                        </div>

                        <!-- Formulaire de modification d'article -->
                        <form style="display: none;" class="container"
                            action="blog/updatearticle"
                            id="updateArticleForm_<?= $article['id'] ?>"
                            method="POST">
                            <input type="hidden" name="id" value="<?= $article['id'] ?>">
                            <p>
                                <label for="title" class="mb-1 p-2 text-decoration-underline">Choisir un titre: </label>
                            </p>
                            <p>
                                <input type="text" class="form-control" name="title" value="<?= $article['title'] ?>">
                            </p>
                            <textarea class="tiny" name="content"><?= $articleContent ?></textarea>
                            <p></p><button type="submit" class="btn btn-outline-light"
                                id="validUpdateArticleBtn_<?= $article['id'] ?>">Valider</button></p>
                        </form>

                    <?php endif;

                    // Filtrer les commentaires de l'article par article
                    $articleReviews = array_filter($reviews, function ($review) use ($article) {
                        return $review['article_id'] == $article['id'];
                    }); ?>

                    <div class="d-flex flex-column bg-darkuielement rounded-4 border border-lightuielement w-75 align-self-center">
                        <h4 class="px-5 py-3 text-decoration-underline text-light2 text-center">Commentaires:</h4>

                        <?php if (count($articleReviews) === 0) : ?>
                            <div class="px-5 py-3 d-flex flex-column justify-content-start border border-navbar text-light2">
                                Il n'y a aucun commentaire.
                            </div>
                        <?php else: ?>
                            <?php
                            // Pour chaque commentaire de chaque article
                            foreach (array_slice($articleReviews, 0, 3) as $review) :

                                $reviewDate = new DateTime($review['creation_date']);
                                $reviewDateFr = $reviewDate->format('d/m/Y H:i');
                                $reviewContent = html_entity_decode($review['content']); ?>

                                <!-- Affichage des commentaires -->

                                <div class="px-5 py-3 d-flex flex-column justify-content-start border border-navbar">
                                    <div class="d-flex justify-content-between text-light2">
                                        <p>Posté par: <?= $review['first_name'] . " " . $review['name'] ?></p>
                                        <p>Le: <?= $reviewDateFr ?> </p>
                                    </div>
                                    <div><?= $reviewContent ?></div>
                                    <?php


                                    // Btn supprimer
                                    if (isset($_SESSION['admin'])) : ?>
                                        <span class="align-self-end" title="Supprimer l'article" data-bs-toggle="tooltip" data-bs-placement="bottom"><button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#deleteReviewModal<?= $review['id'] ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5a.5.5 0 0 1 .5-.5H6h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5zM4.5 2.5A.5.5 0 0 1 5 2h6a.5.5 0 0 1 .5.5V3H14a.5.5 0 0 1 0 1h-1.132l-.858 9.171A1.5 1.5 0 0 1 10.516 14H5.484a1.5 1.5 0 0 1-1.494-1.829L3.132 4H2a.5.5 0 0 1 0-1h2.5v-.5z" />
                                                </svg>
                                            </button></span>


                                    <?php endif; ?>
                                </div>

                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <!-- Boutons d'ouverture de textarea pour ajouter un commentaire -->
                    <div class="text-center">
                        <button type="button" class="btn btn-lightuielement m-3" id="addReviewBtn_<?= $article['id'] ?>">Ajouter un commentaire</button>

                        <button type="button" class="btn btn-outline-light m-3" data-bs-toggle="modal" data-bs-target="#allReviewsModal<?= $article['id'] ?>">Voir tous les commentaires (<?= count($articleReviews) ?>)</button>
                    </div>

                    <?php
                    // Formulaire ajout de commentaire
                    if (isset($_SESSION['connected'])) : ?>
                        <div class="container d-flex justify-content-end">
                            <button style="display: none;" class="btn-close btn-close-white border border-navbar" title="Fermer l'éditeur de texte" data-bs-toggle="tooltip" data-bs-placement="right" id="closeAddReviewBtn_<?= $article['id'] ?>"></button>
                        </div>
                        <form class="container" style="display: none;" id="addReviewForm_<?= $article['id'] ?>" action="blog/addreview" method="POST">

                            <?php if (isset($_SESSION['firstName'])) : ?>
                                <input type="hidden" name="firstName" id="firstName" value="<?= $_SESSION['firstName'];
                                                                                        endif; ?>">
                                <?php if (isset($_SESSION['name'])) : ?>
                                    <input type="hidden" name="name" id="name" value="<?= $_SESSION['name'];
                                                                                    endif; ?>">
                                    <p><input type="hidden" name="articleId" value="<?= $article['id'] ?>"> </p>
                                    <p><textarea class="tiny" name="content" placeholder="Ecrivez votre commentaire" aria-label="Review content"></textarea></p>
                                    <p class="text-center"><button type="submit" class="btn btn-outline-light my-3">Valider le commentaire</button></p>
                        </form>

                    <?php endif; ?>
                    </div>
        </section>



    <?php
    endforeach; ?>

    <!-- Bouton d'ouverture textearea pour ajout d'article -->

    <div class="container mt-5 sticky-bottom text-end" id="divAddArticleBtn">
        <button type="button" class="btn btn-lightuielement m-3 " id="addArticleBtn">Ajouter un article</button>
    </div>
    <?php

    echo $deleteArticleModal;
    echo $deleteReviewModal;
    echo $allReviewsModal; ?>

</main>