<?php
require_once("model/Manager.php");

class PostManager extends Manager
{
    // Récupère tout les chapitre suivant l'id d'un roman //
    public function getPosts($postsId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('
        SELECT id, title, content, summary, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr
        FROM posts
        WHERE book_id = ?
        ORDER BY creation_date ASC');
        $req->execute(array($postsId));
        return $req;
    }

    // Récupère un chapitre grâce a son id //
    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('
        SELECT id, title, summary, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr
        FROM posts
        WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();
        return $post;
    }

    // Permet de supprimer un chapitre grâce a son id //
    public function deletePost($postId)
    {
        $db = $this->dbConnect();
        $dPost = $db->prepare('
        DELETE FROM posts
        WHERE id = ?');
        $deleteThisPost = $dPost->execute(array($postId));
        return $deleteThisPost;
    }

    // Ajoute un nouveau chapitre dans la base de donnée //
    public function addNewPost($bookId, $postTitle, $postSummary, $postContent)
    {
        $db = $this->dbConnect();
        $addPost = $db->prepare('
        INSERT INTO posts (book_id, title, summary, content, creation_date)
        VALUES (?, ?, ?, ?, NOW())');
        $pushBook = $addPost->execute(array($bookId, $postTitle, $postSummary, $postContent));
        return $pushPost;
    }

    // Modifie un chapitre grâce a son id //
    public function modifypost($postTitle, $chapterSummary, $postContent, $postId)
    {
        $db = $this->dbConnect();
        $bookToModify = $db->prepare('
        UPDATE posts
        SET title = ?, summary = ?, content = ?
        WHERE id = ?');
        $modifyPost = $bookToModify->execute(array($postTitle, $chapterSummary, $postContent, $postId));
        return $modifyPost;
    }
}
