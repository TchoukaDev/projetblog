<?php

class SignUpController extends PageController
{

    public function signUp()
    {
        if (isset($_SESSION['connected'])) {
            header('location: accueil');
            exit();
        }

        $fields = ['name', 'first_name', 'email', 'password', 'password2'];
        if (Utilities::validateForm($fields, 'signUpError', 'signup')) {
            $name = htmlspecialchars($_POST['name']);
            $firstName = htmlspecialchars($_POST['first_name']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $password2 = htmlspecialchars($_POST['password2']);

            Utilities::validateEmail($email, "signUpError", "signup");
            $this->emailExists($email);
            if ($this->validatePassword($password, $password2)) {
                $password = $this->hashPassword($password);
            }
            $this->addUser($name, $firstName, $email, $password);
        }
    }

    //vérifier si l'email existe déjà
    private function emailExists($email)
    {
        require_once 'models/UsersModel.php';

        $result = $this->usersModel->countEmail($email);
        if ($result > 0) {
            $_SESSION['signUpError'] = "Cette adresse email est déjà utilisée.";
            header('location:signup');
            exit();
        }
    }


    //vérifier le mot de passe
    private function validatePassword($password, $password2)
    {
        if ($password !== $password2) {
            $_SESSION['signUpError'] = "Veuillez saisir deux mots de passe identiques.";
            header('location: signup');
            exit();
        } else {
            if (strlen($password) < 8) {
                $_SESSION['signUpError'] = "Le mot de passe doit contenir au moins 8 caractères";
                header('location: signup');
                exit();
            } else
                return true;
        }
    }
    //sécuriser le mot de passe
    private function hashPassword($password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        return $password;
    }

    //ajouter l'utilisateur
    private function addUser($name, $firstName, $email, $password)
    {
        require_once 'models/UsersModel.php';
        $isAdmin = $name === "admin" && $firstName === "admin" ? 1 : 0;
        $result = $this->usersModel->createUser($name, $firstName, $email, $password, $isAdmin);
        if ($result === false) {
            $_SESSION['signUpError'] = 'Erreur: Votre inscription n\'a pas pu être finalisée';
        } else {
            $_SESSION['signUpSuccess'] = "Votre inscription est validée avec succès. Vous pouvez maintenant vous connecter.";
        }
        header('location: signup');
        exit();
    }
}
