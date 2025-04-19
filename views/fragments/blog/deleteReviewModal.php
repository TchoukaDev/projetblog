 <?php
    ob_start();
    foreach ($reviews as $review) :
    ?>

     <div class="modal fade" data-bs-backdrop="static" id="deleteReviewModal<?= $review['id'] ?>" tabindex="-1" aria-labelledby="deleteReviewModal<?= $review['id'] ?>" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h1 class="modal-title fs-5" id="DeleteReviewModalLabel<?= $review['id'] ?>">Suppression du commentaire</h1>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     Êtes-vous sûr de vouloir supprimer ce commentaire?
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                     <form action="blog/deletereview" method="POST">
                         <input type="hidden" name="id" value="<?= $review['id'] ?>">
                         <button type='submit' class='btn btn-primary'>Confirmer</button>
                     </form>
                 </div>
             </div>

         </div>
     </div>
 <?php
    endforeach;
    $deleteReviewModal = ob_get_clean();
