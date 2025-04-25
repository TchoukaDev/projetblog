<?php
class LogoutController
{
    public function logout()
    {
        // Détruit toutes les variables de session
        $_SESSION = array();

        // Détruit le cookie de session
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/');
        }

        // Détruit la session
        session_destroy();

        // Supprime le cookie d'auto-login
        setcookie('autoLogin', '', time() - 3600, '/');

        // Redirection vers la page d'accueil
        header('location:accueil');
        exit();
    }
}
