<?php ob_start();

foreach ($articles as $article): ?>

    <div class="modal fade" data-bs-backdrop="static" id="deleteArticleModal<?= $article['id'] ?>" tabindex="-1" aria-labelledby="deleteArticleModalLabel<?= $article['id'] ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteArticleModalLabel<?= $article['id'] ?>">Suppression de l'article</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer cet article?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <form action="blog/deletearticle" method="POST">
                        <input type="hidden" name="id" value="<?= $article['id'] ?>">
                        <button type='submit' class='btn btn-primary'>Confirmer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach;

$deleteArticleModal = ob_get_clean();
