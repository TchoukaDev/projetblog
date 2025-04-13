<h2>Blog</h2>



<?php if (isset($_SESSION['admin'])): ?>
    <div class="container d-flex justify-content-end">
        <button style="display: none;" class="btn btn-outline-light my-3" id="closeAddArticleBtn">Fermer</button>
    </div>
    <form class="container" style="display: none;" id="addArticleForm" action="blog/addarticle" method="POST">


        <input type="hidden" name="first_name" id="first_name" value="<?php
                                                                        if (isset($_SESSION['firstName'])) {
                                                                            echo $_SESSION['firstName'];
                                                                        } ?>">
        <input type="hidden" name="name" id="name" value="<?php
                                                            if (isset($_SESSION['name'])) {
                                                                echo $_SESSION['name'];
                                                            } ?>">
        <textarea class="tiny" name="content"></textarea>
        <button type="submit" class="btn btn-outline-light my-3">Publier</button>

    </form>
    <div class="container">
        <button class="btn btn-outline-light m-3" id="addArticleBtn">Ajouter un article</button>
    <?php endif;
if (isset($_SESSION["articlesError"])) {
    echo "<p class='text-danger text-center'>" . $_SESSION['articlesError'] . "</p>";
    unset($_SESSION['articlesError']);
}
if (isset($_SESSION['articlesSuccess'])) {
    echo "<p class='text-success text-center'>" . $_SESSION['articlesSuccess'] . "</p>";
    unset($_SESSION['articlesSuccess']);
}
foreach ($articles as $article) :
    $date = new DateTime($article['creation_date']);
    $dateFr = $date->format('d/m/Y H:i');

    $content = html_entity_decode($article['content']);

    ?>
        <div class="container my-5">
            <p>Ecrit par: <?= $article['first_name'] . " " . $article['name'] ?></p>
            <p>Créé le: <?= $dateFr ?> </p>
            <?= $content ?>
        </div>
        <?php
        if (isset($_SESSION['admin'])) : ?>
            <button class='btn btn-outline-light' id="updateArticleBtn_<?= $article['id'] ?>">Modifier</button>

            <form action="blog/deletearticle" method="POST">
                <input type="hidden" name="id" value="<?= $article['id'] ?>">
                <button type='submit' class='btn btn-outline-light'>Supprimer</button>
            </form>

            <div class="container d-flex justify-content-end">
                <button style="display: none;" class="btn btn-outline-light my-3"
                    id="closeUpdateArticleBtn_<?= $article['id'] ?>">Fermer</button>
            </div>

            <form style="display: none;" class="container"
                action="blog/updatearticle"
                id="updateArticleForm_<?= $article['id'] ?>"
                method="POST">
                <input type="hidden" name="id" value="<?= $article['id'] ?>">
                <textarea class="tiny" name="content"><?= $content ?></textarea>
                <button type="submit" class="btn btn-outline-light"
                    id="validUpdateArticleBtn_<?= $article['id'] ?>">Valider</button>
            </form>
    <?php endif;
    endforeach; ?>
    </div>