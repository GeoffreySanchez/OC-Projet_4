<?php
require_once("model/Manager.php");

class LoginManager extends Manager
{
    // Récupère toutes les données des utilisateurs de la base de donnée //
    public function getUsers()
    {
        $db = $this->dbConnect();
        $users = $db->query('
        SELECT id, name, permission, password
        FROM users ');
        return $users;
    }

    // Récupère l'id suivant le nom d'un utilisateur //
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

    // Récupère les permissions d'un utilisateur grâce a son nom //
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

    // Vérifie sur un utilisateur existe dans la base de donnée suivant un nom et un mot de passe //
    public function loginVerification($name)
    {
        $db = $this->dbConnect();
        $verification = $db->prepare('
        SELECT password
        FROM users
        WHERE name = ? ');
        $verification->execute(array($name));
        $dataVerification = $verification->fetch();
        return $dataVerification;
    }

    // Permet d'ajouter de nouveaux utilisateurs sans accès par défaut//
    public function addUser($identifiant, $passwordHash)
    {
        $db = $this->dbConnect();
        $insertUser = $db->prepare('
        INSERT INTO users (name, permission, password)
        VALUES (?, 3, ?)');
        $pushUser  = $insertUser->execute(array($identifiant, $passwordHash));
        return $pushUser;
    }
}

