<?php

require('controller/frontend.php');

try {
      //-----------------------------------------------------------------------------------------------//
     // Conditions qui executent des fonctions si une ACTION est présente dans la barre de navigation //
    //-----------------------------------------------------------------------------------------------//
    if (isset($_GET['action'])) {

          //------------------------------------//
         // Conditions d'affichage + visiteurs //
        //------------------------------------//

        // Conditions qui affiche tout les chapitres d'un roman //
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }

        // Condition qui affiche un chapitre en particulier //
        elseif ($_GET['action'] == 'post') {
            // On vérifie sur l'id du chapitre est bien présent //
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                throw new Exception('Le lien est mort');
            }
        }

        // Condition qui affiche tout les romans de la base de donnée //
        elseif ($_GET['action'] == 'books') {
            listBooks();
        }

        // Condition qui permet d'ajouter un commentaire //
        elseif ($_GET['action'] == 'addComment') {
            // On vérifie si l'id du chapitre est bien présent //
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                addComment($_GET['id'], $_GET['book_id'], $_POST['comment'], $_GET['user_id'], $_GET['book_title'], $_GET['post_title']);
            }
            else {
                throw new Exception('Le lien est mort');
            }
        }

        // Condition qui permet de signaler un commentaire //
        elseif ($_GET['action'] == 'reportComment') {
            // On vérifie si l'id du commentaire est bien présent  //
            if (isset($_GET['comment_id']) && $_GET['comment_id'] > 0) {
                reportComment($_GET['comment_id'], $_GET['id'], $_GET['book_id'], $_GET['user_id'], $_GET['book_title'], $_GET['post_title']);
            }
            else {
                throw new Exception('Ce commentaire n\'existe pas.');
            }
        }



          //--------------------------------------//
         // Conditions d'administration de roman //
        //--------------------------------------//

        // Condition qui permet d'afficher la page pour ajouter un nouveau roman //
        elseif ($_GET['action'] == "newBook") {
            // On lance une session si nous n'en avons aucune d'ouverte //
            if (session_id() == '') {
                session_start();
                }
            if ($_SESSION['permission'] > 1) {
                    throw new Exception('Cette fonction est réservée aux écrivains');
                }
                else {
                    newBookPage();
                }
        }

        // Condition qui permet d'ajouter un nouveau roman dans la base de donnée //
        elseif ($_GET['action'] == "addNewBook") {
            addNewBook($_POST['contentTitle'], $_POST['contentToAdd']);
        }

        // Condition qui permet d'afficher la page pour modifier un roman existant //
        elseif ($_GET['action'] == "modifyBookPage") {
            // On lance une session si nous n'en avons aucune d'ouverte //
            if (session_id() == '') {
                session_start();
                }
            if ($_SESSION['permission'] > 1) {
                    throw new Exception('Cette fonction est réservée aux écrivains');
                }
                else {
                    modifyBookPage($_GET['bookId']);
                }
        }

        // Condition qui permet de modifier les données d'un roman //
        elseif ($_GET['action'] == "modifyBook") {
            modifyBook($_POST['contentTitle'], $_POST['contentToAdd'], $_GET['bookId']);
        }

        // Condition qui permet de publier un roman //
        elseif ($_GET['action'] == "publish") {
            publishBook($_GET['bookId']);
        }



          //-----------------------------------------//
         // Conditions d'administration de chapitre //
        //-----------------------------------------//

        // Condition qui permet d'afficher la page pour ajouter un nouveau chapitre //
        elseif ($_GET['action'] == "newPost") {
            // On lance une session si nous n'en avons aucune d'ouverte //
            if (session_id() == '') {
                session_start();
                }
            if ($_SESSION['permission'] > 1) {
                    throw new Exception('Cette fonction est réservée aux écrivains');
                }
                else {
                    newPostPage();
                }
        }

        // Condition qui permet d'ajouter un nouveau chapitre dans la base de donnée //
        elseif ($_GET['action'] == "addNewPost") {
            addNewPost($_GET['bookId'], $_POST['contentTitle'], $_POST['contentToAdd']);
        }

        // Condition qui permet d'afficher la page pour modifier un nouveau chapitre //
        elseif ($_GET['action'] == "modifyPostPage") {
            // On lance une session si nous n'en avons aucune d'ouverte //
            if (session_id() == '') {
                session_start();
                }
            if ($_SESSION['permission'] > 1) {
                    throw new Exception('Cette fonction est réservée aux écrivains');
                }
                else {
                    modifyPostPage($_GET['postId']);
                }
        }

        // Condition qui permet de modifier les données d'un chapitre //
        elseif ($_GET['action'] == "modifyPost") {
            modifyPost($_POST['contentTitle'], $_POST['contentToAdd'], $_GET['postId'], $_GET['bookId'], $_GET['bookTitle']);
        }



          //--------------------------------------------//
         // Conditions d'administration de commentaire //
        //--------------------------------------------//

        // Condition d'accès à la page d'administration des commentaires signalés //
        elseif($_GET['action'] == 'adminComments') {
            // On lance une session si nous n'en avons aucune d'ouverte //
            if (session_id() == '') {
                session_start();
                }
            if ($_SESSION['permission'] > 2) {
               throw new Exception('Cette page est réservée aux administrateurs');
            }
            else {
                adminComments();
            }
        }

        // Condition pour valider un commentaire qui a été signalé //
        elseif ($_GET['action'] == 'validComment') {
            // On lance une session si nous n'en avons aucune d'ouverte //
            if (session_id() == '') {
                session_start();
                }
            if ($_SESSION['permission'] > 2) {
               throw new Exception('Cette page est réservée aux administrateurs');
            }
            else {
            acceptReportedComment($_GET['commentId']);
            }
        }



          //--------------------------------------------//
         // Conditions d'administration de suppression //
        //--------------------------------------------//

         // Condition global de suppression //
        //---------------------------------//
        elseif ($_GET['action'] == 'delete') {
            // On lance une session si nous n'en avons aucune d'ouverte //
            if (session_id() == '') {
                session_start();
                }
            // Supprime un roman si on retrouve son id dans la barre d'adresse //
            if (isset($_GET['bookId']) && $_GET['bookId'] > 0) {
                if ($_SESSION['permission'] > 1) {
                    throw new Exception('Cette fonction est réservée aux écrivains');
                }
                else {
                    deleteBook($_GET['bookId']);
                }
            }

            // Supprime un chapitre si on retrouve son id dans la barre d'adresse //
            elseif (isset($_GET['postId']) && $_GET['postId'] > 0) {
                if ($_SESSION['permission'] > 1) {
                    throw new Exception('Cette fonction est réservée aux administrateurs');
                }
                else {
                    deletePost($_GET['postId'], $_GET['book_id'], $_GET['bookTitle']);
                }
            }

            // Supprime un commentaire si on retrouve son id dans la barre d'adresse //
            elseif (isset($_GET['commentId']) && $_GET['commentId'] > 0) {
                if ($_SESSION['permission'] > 2) {
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

          //-----------------------------//
         // Conditions d'administration //
        //-----------------------------//

        // Condition de connexion //
        elseif ($_GET['action'] == 'login') {
            login();
        }

        // Condtion de vérification des identifiants saisis //
        elseif ($_GET['action'] == 'loginVerification') {
            if(isset($_POST['idField']) && isset($_POST['pwField'])) {
                loginVerification($_POST['idField'], $_POST['pwField']);
            }
        }

        // Condition de déconnexion //
        elseif ($_GET['action'] == 'logout') {
            logout();
        }

        // Condition d'accès a la page d'administration //
        elseif($_GET['action'] == 'adminPage') {
            // On lance une session si nous n'en avons aucune d'ouverte //
            if (session_id() == '') {
                session_start();
                }
            if ($_SESSION['permission'] > 2) {
               throw new Exception('Cette page est réservée aux administrateurs');
            }
            else {
                adminPage();
            }
        }
    }



      //----------------------//
     // Affiche la home page //
    //----------------------//
    else {
        home();
    }
}

      //--------------------------------//
     // Affiche les potentiels erreurs //
    //--------------------------------//
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
    echo '<div id="content"><a href="index.php">Retour sur la page d\'accueil</a>';
}

