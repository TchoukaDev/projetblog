<?php
class LogoutController
{

    public function logout()
    {
        if ((isset($_SESSION['connected'])) && isset($_SESSION['firstName'])) {
            unset($_SESSION['connected'], $_SESSION['firstName']);
        }
        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }

        header('location:accueil');
        exit();
    }
}
