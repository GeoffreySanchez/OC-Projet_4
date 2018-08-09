<?php
require_once("model/Manager.php");

class BookManager extends Manager
{
    // Récupère l'intégralité des romans publiés dans la base de donnée //
    public function getBooks()
    {
        $db = $this->dbConnect();
        $books = $db->query('
        SELECT id, title, summary, publish
        FROM books');
        return $books;
    }

    // Récupère l'intégralité des romans publiés dans la base de donnée //
    public function getPublishedBooks()
    {
        $db = $this->dbConnect();
        $PublishedBooks = $db->query('
        SELECT id, title, summary, publish
        FROM books
        WHERE publish = 1');
        return $PublishedBooks;
    }

    // Récupère l'intégralité des romans non publiés dans la base de donnée //
    public function getUnpublishedBooks()
    {
        $db = $this->dbConnect();
        $unpublishedBooks = $db->query('
        SELECT id, title, summary, publish
        FROM books
        WHERE publish = 0');
        return $unpublishedBooks;
    }

    // Récupère un roman suivant son id //
    public function getBook($bookId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('
        SELECT id, title, summary, publish
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
        $deleteBook = $book->execute(array($bookId));
        return $deleteBook;
    }

    // Ajoute un nouveau roman //
    public function addNewBook($bookTitle, $bookSummary)
    {
        $db = $this->dbConnect();
        $addBook = $db->prepare('
        INSERT INTO books (title, summary, publish)
        VALUES (?, ?, 0)');
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

    // Publie un roman //
    public function publishBook($bookId)
    {
        $db = $this->dbConnect();
        $bookToModify = $db->prepare('
        UPDATE books
        SET publish = 1
        WHERE id = ?');
        $publishBook = $bookToModify->execute(array($bookId));
        return $publishBook;
    }

}
