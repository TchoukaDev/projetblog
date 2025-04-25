<?php
require_once 'models/ReviewsModel.php';

class ReviewsController extends PageController
{
    private string $contentId;
    private string $redirection;
    private string $table;
    private string $idColumn;

    public function __construct($contentId, $redirection, $table, $idColumn)
    {

        $this->contentId = $contentId;
        $this->redirection = $redirection;
        $this->table = $table;
        $this->idColumn = $idColumn;
    }


    public function addReview()
    {
        //validation du formulaire
        $fields = [$this->contentId, 'name', 'firstName', 'content'];
        if (Utilities::validateForm($fields, 'reviewsError', 'blog')) {
            $id = $_POST[$this->contentId];
            $name = htmlspecialchars($_POST['name']);
            $firstName = htmlspecialchars($_POST['firstName']);
            $content = htmlspecialchars($_POST['content']);

            //ajout de l'article
            $this->reviewsModel = new ReviewsModel($this->table, $this->idColumn);
            $result = $this->reviewsModel->addReviewDb($id, $name,  $firstName, $content);
            //Affichage du résultat
            if ($result === false) {
                $_SESSION['reviewsError'] = "Erreur: Un problème est survenu lors de l'ajout de votre commentaire";
                header("location:" . ROOT . $this->redirection);
                exit();
            } else {
                $_SESSION['reviewsSuccess'] = "Votre commentaire a été ajouté avec succès.";
                header("location:" . ROOT . $this->redirection);
                exit();
            }
        }
    }

    public function deleteReview()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (!empty($_POST['id'])) {
                $id = htmlspecialchars($_POST['id']);
                $this->reviewsModel = new ReviewsModel($this->table, $this->idColumn);
                $result = $this->reviewsModel->deleteReviewDb($id);
                if ($result === false) {
                    $_SESSION['reviewsError'] = "Erreur: Un problème est survenu lors de la supression de ce commentaire";
                    header("location:" . ROOT . $this->redirection);
                    exit();
                } else {
                    $_SESSION['reviewsSuccess'] = "Ce commentaire a été supprimé.";
                    header("location:" . ROOT . $this->redirection);
                    exit();
                }
            }
        }
    }
}
