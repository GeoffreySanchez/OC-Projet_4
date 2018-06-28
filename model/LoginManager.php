<?php
require_once("model/Manager.php");

class LoginManager extends Manager
{

    public function getUsers()
    {
        $db = $this->dbConnect();
        $users = $db->query('
        SELECT id, name, permission, password
        FROM users ');
        return $users;
    }

    public function loginVerification($name, $password) {
        $db = $this->dbConnect();
        $verification = $db->prepare('
        SELECT COUNT(*) AS result
        FROM users
        WHERE name = ? AND password = MD5(?)');
        $verification->execute(array($name, $password));
        $dataVerification = $verification->fetch();
        if($dataVerification['result'] == 1) {
            return true;
        } else{
            return false;
        }
    }
}

