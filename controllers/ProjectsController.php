<?php
require_once 'models/ProjectsModel.php';

class ProjectsController extends PageController
{
    public function addProject()
    {

        //validation du formulaire
        $fields = ['title', 'name', 'first_name', 'content', 'link'];
        if (Utilities::validateForm($fields, 'projectsError', 'portfolio')) {
            $title = htmlspecialchars($_POST['title']);
            $name = htmlspecialchars($_POST['name']);
            $firstName = htmlspecialchars($_POST['first_name']);
            $content = htmlspecialchars($_POST['content']);
            $link = htmlspecialchars($_POST['link']);

            if (!filter_var($link, FILTER_VALIDATE_URL)) {
                $_SESSION['projectsError'] = "Cette adresse URL n'est pas valide.";
                header('location: portfolio');
                exit();
            }
            //ajout du projet
            $result = $this->projectsModel->addProjectDb($title, $name, $firstName, $content, $link);

            //Affichage du résultat
            if ($result === false) {
                $_SESSION['projectsError'] = "Erreur: Un problème est survenu lors de l'ajout de votre projet";
                header("location:" . ROOT . "portfolio");
                exit();
            } else {
                $_SESSION['projectsSuccess'] = "Votre projet a été créé avec succès.";
                header("location:" . ROOT . "portfolio");
                exit();
            }
        }
    }

    public function updateProject()
    {
        $fields = ['title', 'content', 'link', 'id'];
        if (Utilities::validateForm($fields, 'projectsError', 'portfolio')) {
            $title = htmlspecialchars($_POST['title']);
            $content = htmlspecialchars($_POST['content']);
            $link = htmlspecialchars($_POST['link']);
            $id = htmlspecialchars($_POST['id']);

            if (!filter_var($link, FILTER_VALIDATE_URL)) {
                $_SESSION['projectError'] = "Cette adresse URL n'est pas valide.";
                header('location: portfolio');
                exit();
            }

            $result = $this->projectsModel->updateProjectDb($title, $content, $link, $id);

            if ($result === false) {
                $_SESSION['projectsError'] = "Erreur: Un problème est survenu lors de la modification de votre projet";
                header("location:" . ROOT . "portfolio");
                exit();
            } else {
                $_SESSION['projectsSuccess'] = "Votre projet a été modifié avec succès.";
                header("location:" . ROOT . "portfolio");
                exit();
            }
        }
    }
    public function deleteProject()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (!empty($_POST['id'])) {
                $id = htmlspecialchars($_POST['id']);

                $result = $this->projectsModel->deleteProjectDb($id);
                if ($result === false) {
                    $_SESSION['projectsError'] = "Erreur: Un problème est survenu lors de la supression de votre projet";
                    header("location:" . ROOT . "portfolio");
                    exit();
                } else {
                    $_SESSION['projectsSuccess'] = "Votre projet a été supprimé avec succès.";
                    header("location:" . ROOT . "portfolio");
                    exit();
                }
            }
        }
    }
}
