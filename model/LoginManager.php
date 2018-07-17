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

    public function getUserId($name)
    {
        $db = $this->dbConnect();
        $userId = $db->prepare('
        SELECT id
        FROM users
        WHERE name = ?');
        $userId->execute(array($name));
        $id = $userId->fetch();
        return $id['id'];
    }

    public function getUserPermission($name)
    {
        $db = $this->dbConnect();
        $userPermission = $db->prepare('
        SELECT permission
        FROM users
        WHERE name = ?');
        $userPermission->execute(array($name));
        $permission = $userPermission->fetch();
        return $permission['permission'];
    }

    public function loginVerification($name, $password)
    {
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

