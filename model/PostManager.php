<?php
require_once("model/Manager.php");

class PostManager extends Manager
{
    public function getPosts($postsId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('
        SELECT id, title, content, SUBSTRING(content, 1, 2000) AS contentMin, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr
        FROM posts
        WHERE book_id = ?
        ORDER BY creation_date ASC LIMIT 0, 5');
        $req->execute(array($postsId));

        return $req;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('
        SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr
        FROM posts
        WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    public function deletePost($postId)
    {
        $db = $this->dbConnect();
        $dPost = $db->prepare('
        DELETE FROM posts
        WHERE id = ?');
        $dComments = $db->prepare('
        DELETE FROM comments
        WHERE post_id = ?');
        $deleteThisPost = $dPost->execute(array($postId));
        $deleteThisComments = $dComments->execute(array($postId));
        return $deleteThisPost;
        return $deleteThisComments;
    }
}
