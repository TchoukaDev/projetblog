<?php

require_once 'models/UsersModel.php';
class LoginController extends PageController
{

    public function login()
    {
        if (isset($_SESSION['connected'])) {
            header('location: accueil');
            exit();
        }

        $fields = ['email', 'password'];
        if (Utilities::validateForm($fields, "loginError", "login")) {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            Utilities::validateEmail($email, 'loginError', 'login');
            $this->checkEmail($email);
            if ($this->checkPassword($email, $password)) {
                $this->openSessions($email);
            }
        }
    }


    private function checkEmail($email)
    {

        $result = $this->usersModel->countEmail($email);
        if ($result === 0) {
            $_SESSION['loginError'] = "Adresse email ou mot de passe invalide.";
            header('location:login');
            exit();
        }
    }
    private function checkPassword($email, $password)
    {
        $user = $this->usersModel->selectUserbyEmail($email);
        $hashedPassword = $user['password'];

        if (!password_verify($password, $hashedPassword)) {
            $_SESSION['loginError'] = "Adresse email ou mot de passe invalide.";
            header("location:login");
            exit();
        } else {
            return true;
        }
    }
    private function openSessions($email)
    {
        $user = $this->usersModel->selectUserbyEmail($email);
        $firstName = $user['first_name'];
        $name = $user['name'];
        $isAdmin = $user['is_admin'];
        $_SESSION['connected'] = true;
        $_SESSION['firstName'] = $firstName;
        $_SESSION['name'] = $name;
        if ($isAdmin === 1) {
            $_SESSION['admin'] = true;
        }
        header('location:login');
        exit();
    }
}
