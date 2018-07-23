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

function addComment($postId, $bookId, $comment, $userId) {
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->postComment($postId, $comment, $userId);
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id='.$postId.'&book_id='.$bookId.'&user_id='.$userId);
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
    $_SESSION['id'] = '3';
    $_SESSION['permission'] = '3';
    header('Location: index.php');
}

function loginVerification ($name, $password) {
    $loginManager = new LoginManager();
    $verification = $loginManager->loginVerification($name, $password);
    $recuperationId = $loginManager->getUserId($name);
    $recuperationPermission = $loginManager->getUserPermission($name);
    if ($verification == true) {
                    session_start();
                    $_SESSION['name'] = $name;
                    $_SESSION['password'] = MD5($password);
                    $_SESSION['id'] = $recuperationId;
                    $_SESSION['permission'] = $recuperationPermission;
                    header('Location: index.php?action=adminPage');
                }
                else {
                    throw new Exception('Mauvais identifiant ou mot de passe');
                }
}

function adminPage() {
    if ($_SESSION['permission'] < 3) {
        $bookManager = new bookManager();
        $books = $bookManager->getBooks();
        $commentManager = new CommentManager();
        $reportedComments = $commentManager->getReportedComments();
        require('view/frontend/adminPage.php');
    }
    else {
        require('view/frontend/homePage.php');
    }
}

function adminComments() {
    if ($_SESSION['permission'] < 3) {
        $bookManager = new bookManager();
        $books = $bookManager->getBooks();
        $commentManager = new CommentManager();
        $reportedComments = $commentManager->getReportedComments();
        require('view/frontend/adminComments.php');
    }
    else {
        require('view/frontend/homePage.php');
    }
}

function deleteComment($id) {
    if ($_SESSION['permission'] < 3) {
        $commentManager = new CommentManager();
        $deleteComment = $commentManager->deleteComments($id);
        header('Location: index.php?action=adminComments');
    }
    else {
        require('view/frontend/homePage.php');
    }
}

function reportComment($commentId, $id, $book_id, $user_id) {
    $commentManager = new CommentManager();
    $addReport = $commentManager->reportComment($commentId);
    header('Location: index.php?action=post&id='.$id.'&book_id='.$book_id.'&user_id='.$user_id.'');
}

function acceptReportedComment($id) {
    $commentManager = new CommentManager();
    $addReport = $commentManager->acceptComment($id);
    header('Location: index.php?action=adminPage');
}

function deleteBook($bookId) {
    $bookManager = new bookManager();
    $books = $bookManager->deleteBook($bookId);
    header('Location: index.php?action=adminPage');
}

function deletePost($postId, $bookId) {
    $postManager = new PostManager();
    $post = $postManager->deletePost($postId);
    header('Location: index.php?action=listPosts&id='.$bookId.'');
}

function newBookPage() {
    require('view/frontend/newContent.php');
}

function addNewBook($bookTitle, $bookSummary) {
    $bookManager = new bookManager();
    $books = $bookManager->addNewBook($bookTitle, $bookSummary);
    if ($pushBook === false) {
        throw new Exception('Impossible d\'ajouter le nouveau roman');
    }
    else {
        header('Location: index.php?action=adminPage');
    }
}

function newPostPage() {
    require('view/frontend/newContent.php');
}

function addNewPost($bookId, $postTitle, $postContent) {
    $postManager = new PostManager();
    $addPost = $postManager->addNewPost($bookId, $postTitle, $postContent);
    if ($pushPost === false) {
        throw new Exception('Impossible d\'ajouter le nouveau chapitre');
    }
    else {
        header('Location: index.php?action=adminPage');
    }
}
