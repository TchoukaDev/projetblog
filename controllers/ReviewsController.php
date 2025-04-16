<?php
require_once 'models/ReviewsModel.php';

class ReviewsController extends PageController
{

    public function addReview()
    {
        //validation du formulaire
        $fields = ['articleId', 'name', 'firstName', 'content'];
        if (Utilities::validateForm($fields, 'reviewsError', 'blog')) {
            $articleId = $_POST['articleId'];
            $name = htmlspecialchars($_POST['name']);
            $firstName = htmlspecialchars($_POST['firstName']);
            $content = htmlspecialchars($_POST['content']);

            //ajout de l'article
            $result = $this->reviewsModel->addReviewDb($articleId, $name,  $firstName, $content);
            //Affichage du résultat
            if ($result === false) {
                $_SESSION['reviewsError'] = "Erreur: Un problème est survenu lors de l'ajout de votre commentaire";
                header("location:" . ROOT . "blog");
                exit();
            } else {
                $_SESSION['reviewsSuccess'] = "Votre commentaire a été ajouté avec succès.";
                header("location:" . ROOT . "blog");
                exit();
            }
        }
    }

    public function deleteReview()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (!empty($_POST['id'])) {
                $id = htmlspecialchars($_POST['id']);
                $result = $this->reviewsModel->deleteReviewDb($id);
                if ($result === false) {
                    $_SESSION['reviewsError'] = "Erreur: Un problème est survenu lors de la supression de ce commentaire";
                    header("location:" . ROOT . "blog");
                    exit();
                } else {
                    $_SESSION['reviewsSuccess'] = "Ce commentaire a été supprimé.";
                    header("location:" . ROOT . "blog");
                    exit();
                }
            }
        }
    }
}
