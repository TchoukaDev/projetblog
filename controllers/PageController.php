<?php
require_once 'MainController.php';
class PageController extends MainController
{

    public $usersModel;
    public $articlesModel;
    public $projectsModel;
    public $reviewsModel;


    public function __construct()
    {
        parent::__construct();
        $this->articlesModel = new ArticlesModel;
        $this->projectsModel = new ProjectsModel;
    }
    public function homePage()
    {
        $datasPage = [
            "title" => "Page d'accueil",
            "view" => "views/pages/homeView.php",
            "layout" => "views/commons/template.php"
        ];

        Utilities::renderPage($datasPage);
    }
    public function blogPage()
    {
        $articles = $this->articlesModel->getAllArticles();
        $this->reviewsModel = new ReviewsModel('article_reviews', 'article_id');
        $reviews = $this->reviewsModel->getReviews();
        require_once 'views/fragments/blog/deleteArticleModal.php';
        require_once 'views/fragments/blog/deleteArticleReviewModal.php';
        require_once 'views/fragments/blog/allArticleReviewsModal.php';


        $datasPage = [
            "title" => "Blog",
            "view" => "views/pages/blogView.php",
            "layout" => "views/commons/template.php",
            "articles" => $articles,
            "reviews" => $reviews,
            "deleteArticleModal" => $deleteArticleModal,
            "deleteArticleReviewModal" => $deleteArticleReviewModal,
            "allArticleReviewsModal" => $allArticleReviewsModal
        ];

        Utilities::renderPage($datasPage);
    }

    public function portfolioPage()
    {
        $projects = $this->projectsModel->getAllprojects();
        $this->reviewsModel = new ReviewsModel('project_reviews', 'project_id');
        $reviews = $this->reviewsModel->getReviews();
        require_once 'views/fragments/portfolio/deleteProjectModal.php';
        require_once 'views/fragments/portfolio/deleteProjectReviewModal.php';
        require_once 'views/fragments/portfolio/allProjectReviewsModal.php';

        $datasPage = [
            "title" => "Portfolio",
            "view" => "views/pages/portfolioView.php",
            "layout" => "views/commons/template.php",
            "projects" => $projects,
            'reviews' => $reviews,
            "deleteProjectModal" => $deleteProjectModal,
            "deleteProjectReviewModal" => $deleteProjectReviewModal,
            "allProjectReviewsModal" => $allProjectReviewsModal
        ];
        Utilities::renderPage($datasPage);
    }

    public function signUpPage()
    {

        $datasPage = [
            "title" => "Inscription",
            "view" => "views/pages/signUpView.php",
            "layout" => "views/commons/template.php"
        ];
        Utilities::renderPage($datasPage);
    }

    public function loginPage()
    {
        $datasPage = [
            "title" => "Connexion",
            "view" => "views/pages/loginView.php",
            "layout" => "views/commons/template.php"
        ];

        Utilities::renderPage($datasPage);
    }
    public function errorPage($message)
    {
        $datasPage = [
            "title" => "Erreur",
            "view" => "views/pages/errorView.php",
            "layout" => "views/commons/template.php",
            "message" => $message
        ];
        Utilities::renderPage($datasPage);
    }
}
