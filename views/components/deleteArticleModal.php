 <?php ob_start(); ?>

 <div class="modal fade" data-bs-backdrop="static" id="deleteArticleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h1 class="modal-title fs-5" id="DeleteArticleModalLabel">Suppression de l'article</h1>
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
 <?php
    $deleteArticleModal = ob_get_clean();
