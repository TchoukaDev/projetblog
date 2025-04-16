<?php

class PageController
{

    public $usersModel;
    public $articlesModel;
    public $reviewsModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel;
        $this->articlesModel = new ArticlesModel;
        $this->reviewsModel = new ReviewsModel;
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
        $reviews = $this->reviewsModel->getArticleReviews();
        require_once 'views/fragments/blog/deleteArticleModal.php';
        require_once 'views/fragments/blog/deleteReviewModal.php';


        $datasPage = [
            "title" => "Blog",
            "view" => "views/pages/blogView.php",
            "layout" => "views/commons/template.php",
            "articles" => $articles,
            "reviews" => $reviews,
            "deleteArticleModal" => $deleteArticleModal,
            "deleteReviewModal" => $deleteReviewModal
        ];

        Utilities::renderPage($datasPage);
    }

    public function portfolioPage()
    {
        $datasPage = [
            "title" => "Portfolio",
            "view" => "views/pages/portfolioView.php",
            "layout" => "views/commons/template.php"
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
    }
}
