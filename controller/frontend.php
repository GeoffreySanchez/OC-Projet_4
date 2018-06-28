<?php
// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/BookManager.php');
require_once('model/LoginManager.php');

function listBooks() {
    $bookManager = new bookManager();
    $books = $bookManager->getBooks();
    require('view/frontend/listBooks.php');
}

function listPosts() {
    $postManager = new PostManager();
    $bookManager = new bookManager();
    $posts = $postManager->getPosts($_GET['id']);
    $book = $bookManager->getBook($_GET['id']);
    require('view/frontend/listPostsView.php');
}

function post() {
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    require('view/frontend/postView.php');
}

function addComment($postId, $bookId, $comment) {
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->postComment($postId, $comment);
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id='.$postId.'&book_id='.$bookId);
    }
}

function comment() {
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

function home() {
    $bookManager = new bookManager();
    $books = $bookManager->getBooks();
    require('view/frontend/homePage.php');
}

function login() {
    $usersManager = new LoginManager();
    $users = $usersManager->getUsers();
    require('view/frontend/loginPage.php');
}

function logout() {
    session_start();
                    $_SESSION['name'] = 'Invité';
                    $_SESSION['password'] = '';
                    header('Location: index.php');
}

function loginVerification ($name, $password) {
    $loginManager = new LoginManager();
    $verification = $loginManager->loginVerification($name, $password);
    if ($verification == true) {
                    session_start();
                    $_SESSION['name'] = $name;
                    $_SESSION['password'] = $password;
                    header('Location: index.php');
                }
                else {
                    throw new Exception('Mauvais identifiant ou mot de passe');
                }
}
