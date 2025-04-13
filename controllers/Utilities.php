<?php

class Utilities
{
    public static function renderPage($datasPage)
    {

        extract($datasPage);
        ob_start();
        require($view);
        $content = ob_get_clean();
        require_once($layout);
    }

    public static function showArray($array)
    {
        echo '<pre>';
        print_r($array);
        echo 'pre>';
    }


    public static function validateForm($fieldsArray, $sessionError, $redirection)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fields = $fieldsArray;
            $validForm = true;
            foreach ($fields as $field) {
                if (empty($_POST[$field])) {
                    $validForm = false;
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    //vérifier l'email
    public static function validateEmail($email, $sessionError, $redirection)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL,)) {
            $_SESSION[$sessionError] = "Votre adresse email n'est pas valide.";
            header("location:" . $redirection);
            exit();
        } else
            return true;
    }

    public static function uploadImage()
    {
        // Définir le répertoire de destination
        $upload_dir = 'public/files/';

        // Créer le répertoire s'il n'existe pas
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Vérifier si un fichier a été envoyé
        if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
            $file = $_FILES['file'];

            // Vérifier la taille du fichier
            if ($file['size'] < 5000000) {

                // Obtenir l'extension du fichier
                $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

                // Liste des extensions autorisées
                $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

                // Vérifier l'extension
                if (in_array($fileExtension, $allowed_ext)) {
                    // Créer un nom de fichier unique
                    $new_filename = uniqid() . '.' . $file['name'];
                    $destination = $upload_dir . $new_filename;

                    // Déplacer le fichier téléchargé
                    if (move_uploaded_file($file['tmp_name'], $destination)) {
                        // Construire l'URL complète
                        $base_url = 'http://' . $_SERVER['HTTP_HOST'] . '/projetblog/';
                        $file_url = $base_url . $destination;

                        // Renvoyer l'URL au format JSON
                        header('Content-Type: application/json');
                        echo json_encode(['location' => $file_url]);
                        exit;
                    } else
                        throw new Exception("Le téléchargement de l'image a échoué.");
                } else
                    throw new Exception("Ce format d'image n'est pas valide.");
            } else
                throw new Exception("L'image sélectionnée est trop grande.");
        }
    }
}
