<?php

class MainController
{

    public $user = null;
    public $usersModel;

    public function __construct()
    {

        $this->usersModel = new UsersModel();

        $this->autoLogin();
    }

    private function autoLogin()
    {

        if (!isset($_SESSION['connected']) && isset($_COOKIE['autoLogin'])) {
            $secret = htmlspecialchars($_COOKIE['autoLogin']);
            $user = $this->usersModel->selectUserbySecret($secret);
            if ($user) {
                $_SESSION['connected'] = true;
                $_SESSION['name'] = $user['name'];
                $_SESSION['firstName'] = $user['first_name'];
                if ($user['is_admin'] === 1) {
                    $_SESSION['admin'] = true;
                } else
                    $_SESSION['connected'] = null;
            }
        }
    }
}
