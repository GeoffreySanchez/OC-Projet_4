<?php
require_once("model/Manager.php");

class BookManager extends Manager
{
    // Récupère l'intégralité des roman dans la base de donnée //
    public function getBooks()
    {
        $db = $this->dbConnect();
        $books = $db->query('
        SELECT id, title, summary
        FROM books');
        return $books;
    }

    // Récupère un roman suivant son id //
    public function getBook($bookId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('
        SELECT id, title, summary
        FROM books
        WHERE id = ?');
        $req->execute(array($bookId));
        $book = $req->fetch();
        return $book;
    }

    // Supprime un roman ainsi que les chapitres associés suivant son id //
    public function deleteBook($bookId)
    {
        $db = $this->dbConnect();
        $book = $db->prepare('
        DELETE FROM books
        WHERE id = ?');
        $posts = $db->prepare('
        DELETE FROM posts
        WHERE book_id = ?');
        $deleteBook = $book->execute(array($bookId));
        $deletePosts = $posts->execute(array($bookId));
        return $deleteBook;
        return $deletePosts;
        return $deleteComments;
    }

    // Ajoute un nouveau roman //
    public function addNewBook($bookTitle, $bookSummary)
    {
        $db = $this->dbConnect();
        $addBook = $db->prepare('
        INSERT INTO books (title, summary)
        VALUES (?, ?)');
        $pushBook = $addBook->execute(array($bookTitle, $bookSummary));
        return $pushBook;
    }

    // Modifie les données d'un roman avec son id //
    public function modifyBook($bookTitle, $bookSummary, $bookId)
    {
        $db = $this->dbConnect();
        $bookToModify = $db->prepare('
        UPDATE books
        SET title = ?, summary = ?
        WHERE id = ?');
        $modifyBook = $bookToModify->execute(array($bookTitle, $bookSummary, $bookId));
        return $modifyBook;
    }

}
