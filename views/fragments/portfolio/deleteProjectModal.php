<?php ob_start();

foreach ($projects as $project): ?>

    <div class="modal fade" data-bs-backdrop="static" id="deleteProjectModal<?= $project['id'] ?>" tabindex="-1" aria-labelledby="deleteProjectModalLabel<?= $project['id'] ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteProjectModalLabel<?= $project['id'] ?>">Suppression du projet</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer ce projet?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <form action="portfolio/deleteproject" method="POST">
                        <input type="hidden" name="id" value="<?= $project['id'] ?>">
                        <button type='submit' class='btn btn-primary'>Confirmer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach;

$deleteProjectModal = ob_get_clean();
