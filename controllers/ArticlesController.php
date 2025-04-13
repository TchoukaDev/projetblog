<?php
require_once 'models/ArticlesModel.php';
class ArticlesController extends PageController
{

    public function addArticle()
    {
        $name = $firstName = $content = '';

        //validation du formulaire
        $fields = ['name', 'first_name', 'content'];
        if (Utilities::validateForm($fields, 'articlesError', 'blog')) {
            $name = htmlspecialchars($_POST['name']);
            $firstName = htmlspecialchars($_POST['first_name']);
            $content = htmlspecialchars($_POST['content']);

            //ajout de l'article
            $result = $this->articlesModel->addArticleDb($name, $firstName, $content);

            //Affichage du résultat
            if ($result === false) {
                $_SESSION['articlesError'] = "Erreur: Un problème est survenu lors de l'ajout de votre article";
                header("location:" . ROOT . "blog");
                exit();
            } else {
                $_SESSION['articlesSuccess'] = "Votre article a été créé avec succès.";
                header("location:" . ROOT . "blog");
                exit();
            }
        }
    }

    public function updateArticle()
    {
        $fields = ['content', 'id'];
        if (Utilities::validateForm($fields, 'articleError', 'blog')) {
            $content = htmlspecialchars($_POST['content']);
            $id = htmlspecialchars($_POST['id']);

            $result = $this->articlesModel->updateArticleDb($content, $id);
            if ($result === false) {
                $_SESSION['articlesError'] = "Erreur: Un problème est survenu lors de la modification de votre article";
                header("location:" . ROOT . "blog");
                exit();
            } else {
                $_SESSION['articlesSuccess'] = "Votre article a été modifié avec succès.";
                header("location:" . ROOT . "blog");
                exit();
            }
        }
    }
    public function deleteArticle()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (!empty($_POST['id'])) {
                $id = htmlspecialchars($_POST['id']);
                $result = $this->articlesModel->deleteArticleDb($id);
                if ($result === false) {
                    $_SESSION['articlesError'] = "Erreur: Un problème est survenu lors de la supression de votre article";
                    header("location:" . ROOT . "blog");
                    exit();
                } else {
                    $_SESSION['articlesSuccess'] = "Votre article a été supprimé avec succès.";
                    header("location:" . ROOT . "blog");
                    exit();
                }
            }
        }
    }
}
