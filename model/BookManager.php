<?php
require_once("model/Manager.php");

class bookManager extends Manager
{
    public function getBooks()
    {
        $db = $this->dbConnect();
        $books = $db->query('
        SELECT id, title, summary, SUBSTRING(summary,1,100) AS summaryMin
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

    public function deleteBook($bookId) {
        $db = $this->dbConnect();
        $book = $db->prepare('
        DELETE FROM books
        WHERE id = ?');
        $post = $db->prepare('
        DELETE FROM posts
        WHERE book_id = ?');
        $deleteBook = $book->execute(array($bookId));
        $deletePosts = $post->execute(array($bookId));
        return $deletBook;
        return $deletePosts;
    }
}
