<?php
require_once("model/Manager.php");

class bookManager extends Manager
{
    public function getBooks()
    {
        $db = $this->dbConnect();
        $books = $db->query('SELECT id, title, summary FROM books');
        return $books;
    }
}
