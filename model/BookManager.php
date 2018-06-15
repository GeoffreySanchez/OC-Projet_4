<?php
require_once("model/Manager.php");

class bookManager extends Manager
{
    public function getBooks()
    {
        $db = $this->dbConnect();
        $books = $db->query('
        SELECT id, title, summary
        FROM books');
        return $books;
    }

    public function getBook($bookId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('
        SELECT id, title
        FROM books
        WHERE id = ?');
        $req->execute(array($bookId));
        $book = $req->fetch();

        return $book;
    }
}
