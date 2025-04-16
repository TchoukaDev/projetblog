<?php
require_once 'PdoModel.php';
class UsersModel extends PdoModel
{
    public function createUser($name, $firstName, $email, $password, $isAdmin)
    {
        $db = $this->setdb();
        $req = $db->prepare('INSERT INTO users (name, first_name, email, password, is_Admin) VALUES (?,?,?,?,?)');
        $result =  $req->execute([$name, $firstName, $email, $password, $isAdmin]);
        return $result;
    }

    public function selectUsers()
    {
        $db = $this->setdb();
        $req = $db->prepare('SELECT * FROM users');
        $req->execute();
        $users = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $users;
    }

    public function countEmail($email)
    {
        $db = $this->setdb();
        $req = $db->prepare('SELECT COUNT(*) as NumberEmail FROM users WHERE email=?');
        $req->execute([$email]);
        $result = $req->fetchColumn();
        $req->closeCursor();
        return $result;
    }

    public function selectUserbyEmail($email)
    {
        $db = $this->setdb();
        $req = $db->prepare('SELECT * from users WHERE email=? ');
        $req->execute([$email]);
        $user = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $user;
    }
}
