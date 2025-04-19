 <?php
    ob_start();
    foreach ($articles as $article): ?>

     <div class="modal fade " data-bs-backdrop="static" id="allReviewsModal<?= $article['id'] ?>" tabindex="-1" aria-labelledby="allReviewsModalLabel<?= $article['id'] ?>" aria-hidden="true">
         <div class="modal-dialog modal-xl">
             <div class="modal-content text-light">
                 <div class="modal-header bg-navbar border-none">
                     <h1 class="modal-title fs-5" id="allReviewsModalLabel<?= $article['id'] ?>"></h1>
                     <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body p-0 bg-darkuielement">
                     <?php
                        // Filtrer les commentaires de l'article par article
                        $articleReviews = array_filter($reviews, function ($review) use ($article) {
                            return $review['article_id'] == $article['id'];
                        }); ?>

                     <div class="d-flex flex-column bg-darkuielement  border-top border-bottom border-lightuielement align-self-center">
                         <h4 class="px-5 py-3 text-decoration-underline text-light2 text-center">Commentaires:</h4>

                         <?php if (count($articleReviews) === 0) : ?>
                             <div class="px-5 py-3 d-flex flex-column justify-content-start border-top border-bottom border-navbar text-light2">
                                 Il n'y a aucun commentaire.
                             </div>
                         <?php else: ?>
                             <?php
                                // Pour chaque commentaire de chaque article
                                foreach ($articleReviews as $review) :

                                    $reviewDate = new DateTime($review['creation_date']);
                                    $reviewDateFr = $reviewDate->format('d/m/Y H:i');
                                    $reviewContent = html_entity_decode($review['content']); ?>

                                 <!-- Affichage des commentaires -->

                                 <div class="px-5 py-3 d-flex flex-column justify-content-start border-top border-bottom border-navbar">
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
                     <div class="modal-footer allReviews border-none d-flex justify-content-center">
                         <button type="button" class="btn btn-lightuielement" data-bs-dismiss="modal">Retour</button>

                     </div>
                 </div>
             </div>
         </div>
     </div>
 <?php endforeach;
    $allReviewsModal = ob_get_clean();
