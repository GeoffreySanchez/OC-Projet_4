<?php

  //------------------------//
 // Chargement des classes //
//------------------------//

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/BookManager.php');
require_once('model/LoginManager.php');



  //-------------------------------//
 // Fonctions liées à BookManager //
//-------------------------------//

// Affiche tout les livres de la base de donnée //
function listBooks() {
    $bookManager = new BookManager;
    $books = $bookManager->getBooks();
    require('view/frontend/listBooks.php');
}

// Affiche la page de création de contenu //
function newBookPage() {
    require('view/frontend/newContent.php');
}

// Permet d'ajouter un nouveau roman à la base de donnée //
function addNewBook($bookTitle, $bookSummary) {
    $bookManager = new BookManager;
    $books = $bookManager->addNewBook($bookTitle, $bookSummary);
    if ($pushBook === false) {
        throw new Exception('Impossible d\'ajouter le nouveau roman');
    }
    else {
        header('Location: index.php?action=adminPage');
    }
}

// Affiche la page de modification de contenu et insère les données existantes liées au roman selectionné //
function modifyBookPage($bookId) {
    $bookManager = new BookManager;
    $returnBook = $bookManager->getBook($bookId);
    require('view/frontend/modifyContent.php');
}

// Modifie dans la base de donnée les éléments saisies dans le formulaire //
function modifyBook($bookTitle, $bookSummary, $bookId) {
    $bookManager = new BookManager;
    $returnBook = $bookManager->modifyBook($bookTitle, $bookSummary, $bookId);
    if ($modifyBook === false) {
        throw new exception('Impossible de modifier ce roman');
    }
    else {
       header('Location: index.php?action=adminPage');
    }
}

// Permet à l'écrivain de pouvoir supprimer l'intégralité d'un roman //
function deleteBook($bookId) {
    $bookManager = new BookManager;
    $books = $bookManager->deleteBook($bookId);
    header('Location: index.php?action=adminPage');
}



  //-------------------------------//
 // Fonctions liées à PostManager //
//-------------------------------//

// Affiche les chapitres liés au roman selectionné //
function listPosts() {
    $postManager = new PostManager();
    $bookManager = new BookManager;
    $posts = $postManager->getPosts($_GET['id']);
    $book = $bookManager->getBook($_GET['id']);
    require('view/frontend/listPostsView.php');
}

// Affiche le chapitre selectionné ainsi que tout les commentaires liés à celui-ci //
function post() {
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    require('view/frontend/postView.php');
}

// Affiche la page de création de contenu //
function newPostPage() {
    require('view/frontend/newContent.php');
}

// Permet d'ajouter un nouveau chapitre au roman selectionné //
function addNewPost($bookId, $postTitle, $postContent) {
    $postManager = new PostManager();
    $addPost = $postManager->addNewPost($bookId, $postTitle, $postContent);
    if ($pushPost === false) {
        throw new Exception('Impossible d\'ajouter le nouveau chapitre');
    }
    else {
        header('Location: index.php?action=listPosts&id='.$bookId.'');
    }
}

// Affiche la page de modification de contenu et insère les données existantes liées au chapitre selectionné //
function modifyPostPage($postId) {
    $postManager = new PostManager();
    $returnPost = $postManager->getPost($postId);
    require('view/frontend/modifyContent.php');
}

// Modifie dans la base de donnée les éléments saisies dans le formulaire //
function modifyPost($postTitle, $postContent, $postId,$postBookId) {
    $postManager = new PostManager();
    $returnPost = $postManager->modifyPost($postTitle, $postContent, $postId);
    if ($modifyPost === false) {
        throw new exception('Impossible de modifier ce roman');
    }
    else {
       header('Location: index.php?action=listPosts&id='.$postBookId.'');
    }
}

// Permet à l'écrivain de pouvoir supprimer l'intégralité d'un chapitre //
function deletePost($postId, $bookId) {
    $postManager = new PostManager();
    $post = $postManager->deletePost($postId);
    header('Location: index.php?action=listPosts&id='.$bookId.'');
}



  //----------------------------------//
 // Fonctions liées à CommentManager //
//----------------------------------//

// Affiche les commentaires en fonction du chapitre //
function comment() {
    $commentManager = new CommentManager();
    $comment = $commentManager->getComment($_GET['id']);
    require('view/frontend/modifyComment.php');
}

// Permet de poster un commentaire sur un chapitre //
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

// Permet de signaler un commentaire indésirable //
function reportComment($commentId, $id, $book_id, $user_id) {
    $commentManager = new CommentManager();
    $addReport = $commentManager->reportComment($commentId);
    header('Location: index.php?action=post&id='.$id.'&book_id='.$book_id.'&user_id='.$user_id.'');
}

// Permet d'accéder à la page d'administration des commentaires et affiche uniquement ceux qui sont signalés //
function adminComments() {
    if ($_SESSION['permission'] < 3) {
        $bookManager = new BookManager;
        $books = $bookManager->getBooks();
        $commentManager = new CommentManager();
        $reportedComments = $commentManager->getReportedComments();
        require('view/frontend/adminComments.php');
    }
    else {
        require('view/frontend/homePage.php');
    }
}

// Permet de supprimer de la base de donnée le commentaire selectionné //
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

// Retire l'état 'signalé" d'un commentaire pour le laisser affiché normalement sous le chapitre //
function acceptReportedComment($id) {
    $commentManager = new CommentManager();
    $addReport = $commentManager->acceptComment($id);
    header('Location: index.php?action=adminPage');
}



  //--------------------------------//
 // Fonctions liées à LoginManager //
//--------------------------------//

// Affiche la page d'identification en récupérant dans la base de donnée l'intégralité des utilisateurs //
function login() {
    $usersManager = new LoginManager();
    $users = $usersManager->getUsers();
    require('view/frontend/loginPage.php');
}

// Vérifie les données saisies dans le formulaire d'identification avec celle de la base de donnée //
function loginVerification ($name, $password) {
    $loginManager = new LoginManager();
    $verification = $loginManager->loginVerification($name, $password);
    $recuperationId = $loginManager->getUserId($name);
    $recuperationPermission = $loginManager->getUserPermission($name);
    if ($verification == true) {
                    session_start();
                    $_SESSION['name'] = $name;
                    $_SESSION['id'] = $recuperationId;
                    $_SESSION['permission'] = $recuperationPermission;
                    header('Location: index.php?action=adminPage');
                }
                else {
                    throw new Exception('Mauvais identifiant ou mot de passe');
                }
}

// Déconnecte l'utilisateur et modifie ses $_SESSION //
function logout() {
    session_start();
    $_SESSION['name'] = 'Invité';
    $_SESSION['id'] = '3';
    $_SESSION['permission'] = '3';
    header('Location: index.php');
}

// Affiche la page d'administration //
function adminPage() {
    if ($_SESSION['permission'] < 3) {
        $bookManager = new BookManager;
        $books = $bookManager->getBooks();
        $commentManager = new CommentManager();
        $reportedComments = $commentManager->getReportedComments();
        require('view/frontend/adminPage.php');
    }
    else {
        require('view/frontend/homePage.php');
    }
}



  //-----------------//
 // Autre fonctions //
//-----------------//

// Affiche la page d'accueil avec les projets en cours //
function home() {
    $bookManager = new BookManager;
    $books = $bookManager->getBooks();
    require('view/frontend/homePage.php');
}
