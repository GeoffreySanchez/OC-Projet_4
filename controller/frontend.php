<?php
// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/BookManager.php');

function listBooks()
{
    $bookManager = new bookManager();
    $books = $bookManager->getBooks();
    require('view/frontend/listBooks.php');
}

function listPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();
    require('view/frontend/listPostsView.php');
}

function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->postComment($postId, $author, $comment);
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function comment()
{
    $commentManager = new CommentManager();
    $comment = $commentManager->getComment($_GET['id']);
    require('view/frontend/modifyComment.php');
}

function updateComment($comment, $id)
{
    $commentManager = new CommentManager();
    $update = $commentManager->updateComment($comment, $id);
    if ($updateComment === false) {
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
        header('Location: index.php');
    }
}

function home()
{
   require('view/frontend/homePage.php');
}

