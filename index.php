<?php
session_start();

//Définir constant ROOT qui contient la racine du site
define('ROOT', str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']));

require_once 'controllers/Pagecontroller.php';
require_once 'controllers/Utilities.php';
require_once 'models/UsersModel.php';
require_once 'models/ArticlesModel.php';
require_once 'models/ArticleReviewsModel.php';
require_once 'models/ProjectsModel.php';
require_once 'models/ProjectsReviewsModel.php';
$pageController = new PageController();

try {
    if (empty($_GET['page'])) {
        $url[0] = "accueil";
    } else {
        //Mettre dans un tableau les différentes parties de l'URL qui sont séparées par les /
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
    }
    switch ($url[0]) {
        case "accueil":
            $pageController->homePage();
            break;
        case "blog":
            if (isset($url[1])) {
                require_once 'controllers/ArticlesController.php';
                require_once 'controllers/ArticleReviewsController.php';
                $articlesController = new ArticlesController();
                $reviewsController = new ArticleReviewsController();
                switch ($url[1]) {
                    case "addarticle":
                        $articlesController->addArticle();
                        break;
                    case "updatearticle":
                        $articlesController->updateArticle();
                        break;
                    case "deletearticle":
                        $articlesController->deleteArticle();
                        break;
                    case "addarticlereview";
                        $reviewsController->addArticleReview();
                        break;
                    case "deletearticlereview":
                        $reviewsController->deleteArticleReview();
                        break;
                    default:
                        $pageController->blogPage();
                        break;
                }
            } else {
                $pageController->blogPage();
            }
            break;
        case "portfolio":
            if (isset($url[1])) {
                require_once 'controllers/ProjectsController.php';
                require_once 'controllers/ProjectReviewsController.php';
                $projectsController = new ProjectsController();
                $reviewsController = new ProjectReviewsController;
                switch ($url[1]) {
                    case "addproject":
                        $projectsController->addProject();
                        break;
                    case "updateproject":
                        $projectsController->updateProject();
                        break;
                    case "deleteproject":
                        $projectsController->deleteProject();
                        break;
                    case "addprojectreview":
                        $reviewsController->addProjectReview();
                        break;
                    case "deleteprojectreview":
                        $reviewsController->deleteProjectReview();
                        break;
                    default:
                        $pageController->portfolioPage();
                        break;
                }
            } else {
                $pageController->portfolioPage();
            }
            break;
        case "signup":
            require "controllers/signUpController.php";
            $signUpController = new SignUpController();
            $signUpController->signUp();
            $pageController->signUpPage();
            break;
        case "login":
            require "controllers/loginController.php";
            $loginController = new LoginController();
            $loginController->login();
            $pageController->loginPage();
            break;
        case "logout":
            require "controllers/LogoutController.php";
            $logoutController = new LogoutController();
            $logoutController->logout();
            break;
        case "upload":
            try {
                Utilities::uploadImage();
            } catch (Exception $e) {
                // Si une exception est lancée, on l'affiche en JSON
                header('Content-Type: application/json');
                echo json_encode(['error' => $e->getMessage()]);
                exit;
            }
            break;
        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    $pageController->errorPage($e->getMessage());
}
