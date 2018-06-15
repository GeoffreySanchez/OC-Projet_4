<?php
require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('
        SELECT comments.id, comments.post_id, comments.user_id, comments.comment, DATE_FORMAT(comments.comment_date, \'%d/%m/%Y à %Hh%i\') AS comment_date_fr, users.id, users.name
        FROM users
        INNER JOIN comments
        ON comments.user_id = users.id
        WHERE post_id = ?
        ORDER BY comment_date DESC');
        $comments->execute(array($postId));
        return $comments;
    }

    public function postComment($postId, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('
        INSERT INTO comments(post_id, comment, user_id, comment_date)
        VALUES(?, ?, 3, NOW())');
        $affectedLines = $comments->execute(array($postId, $comment));
        return $affectedLines;
    }

    public function getComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('
        SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr
        FROM comments
        WHERE id = ?');
        $req->execute(array($id));
        $comment = $req->fetch();

        return $comment;
    }

    public function updateComment($comment, $id)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('
        UPDATE `comments`
        SET `comment`= "'.$comment.'" ,`comment_date`= NOW()
        WHERE id = "'.$id.'" ');
        $updateComment = $comments->execute(array($comment, $id));
        return $updateComment;
    }
}
