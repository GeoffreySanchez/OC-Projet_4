<?php
require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('
        SELECT comments.id AS commentId , comments.post_id, comments.user_id, comments.comment, DATE_FORMAT(comments.comment_date, \'%d/%m/%Y à %Hh%i\') AS comment_date_fr, users.id, users.name
        FROM users
        INNER JOIN comments
        ON comments.user_id = users.id
        WHERE post_id = ?
        ORDER BY comment_date DESC');
        $comments->execute(array($postId));
        return $comments;
    }

    public function postComment($postId, $comment, $userId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('
        INSERT INTO comments(post_id, comment, user_id, comment_date, report)
        VALUES(?, ?, ?, NOW(), 0)');
        $affectedLines = $comments->execute(array($postId, $comment, $userId));
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

    public function getReportedComments()
    {
        $db = $this->dbConnect();
        $reportedComments = $db->prepare('
        SELECT comments.id, comments.post_id, comments.user_id, comments.comment, DATE_FORMAT(comments.comment_date, \'%d/%m/%Y à %Hh%i\') AS comment_date_fr, comments.report, users.name
        FROM users
        INNER JOIN comments
        ON comments.user_id = users.id
        WHERE comments.report >= 1
        ORDER BY comment_date DESC');
        $reportedComments->execute(array());
        return $reportedComments;
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

    public function deleteComments($id)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('
        DELETE FROM comments WHERE id = ?');
        $deleteComment = $comments->execute(array($id));
        return $deleteComments;
    }

    public function reportComment($id) {
        $db = $this->dbConnect();
        $comments = $db->prepare('
        UPDATE comments
        SET report = 1
        WHERE id = ?');
        $addReport = $comments->execute(array($id));
        return $addReport;
    }
}
