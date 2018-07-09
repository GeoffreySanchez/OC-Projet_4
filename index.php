<?php

require('controller/frontend.php');

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'books') {
            listBooks();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['comment'])) {
                    addComment($_GET['id'], $_GET['book_id'], $_POST['comment'], $_GET['user_id']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'reportComment') {
            if (isset($_GET['comment_id']) && $_GET['comment_id'] > 0) {
                reportComment($_GET['comment_id'], $_GET['id'], $_GET['book_id'], $_GET['user_id']);
            }
            else {
                throw new Exception('prout');
            }
        }
        elseif ($_GET['action'] == 'modify') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'delete') {
            if (isset($_GET['book_id']) && $_GET['book_id'] > 0) {
                if ($_SESSION['name'] == 'Invité') {
                    throw new Exception('Cette fonction est réservée aux administrateurs');
                }
                else {
                  deleteBook($_GET['book_id']);
                }
            }
            elseif (isset($_GET['post_id']) && $_GET['post_id'] > 0) {
                if ($_SESSION['name'] == 'Invité') {
                    throw new Exception('Cette fonction est réservée aux administrateurs');
                }
                else {
                  deletePost($_GET['post_id']);
                }
            }
            elseif (isset($_GET['commentId']) && $_GET['commentId'] > 0) {
                if ($_SESSION['name'] == 'Invité') {
                    throw new Exception('Cette fonction est réservée aux administrateurs');
                }
                else {
                  deleteComment($_GET['commentId']);
                }
            }
            else {
                throw new Exception('Il n\'y a rien à supprimer');
            }
        }
        elseif ($_GET['action'] == 'login') {
            login();
        }
        elseif ($_GET['action'] == 'logout') {
            logout();
        }
        elseif($_GET['action'] == 'adminPage') {
            if (session_id() == '') {
                session_start();
                }
            if ($_SESSION['name'] == 'Invité') {
               throw new Exception('Cette page est réservée aux administrateurs');
            }
            else {
                adminPage();
            }
        }
        elseif($_GET['action'] == 'adminComments') {
            if (session_id() == '') {
                session_start();
                }
            if ($_SESSION['name'] == 'Invité') {
               throw new Exception('Cette page est réservée aux administrateurs');
            }
            else {
                adminComments();
            }
        }
        elseif ($_GET['action'] == 'loginVerification') {
            if(isset($_POST['idField']) && isset($_POST['pwField'])) {
                loginVerification($_POST['idField'], $_POST['pwField']);
            }
        }
    }
    elseif(isset($_POST['ancre']) && !empty($_POST['ancre'])){
    header("Location: ".$_POST['ancre']."");
}
    else {
        home();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
