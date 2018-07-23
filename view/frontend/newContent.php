<?php
if (session_id() == '') {
   session_start();
}
$title = 'Administration'; ?>


    <?php ob_start(); ?>
    <div id="content">
        <div id="PageTitle">
            <h1>Ajouter un nouveau
            <?php
                if ($_GET['action'] == 'newBook') {
            ?>
             roman
            <?php
                } else if ($_GET['action'] == 'newPost') {
            ?>
             chapitre
            <?php
                }
            ?>
            </h1>
        </div>
        <div id="explication">
            <p>Pour ajouter un nouveau
            <?php
                if ($_GET['action'] == 'newBook') {
            ?>
             roman, veuillez saisir son titre ainsi qu'un extrait de celui-ci.
            <?php
                } else if ($_GET['action'] == 'newPost') {
            ?>
             chapitre, veuillez saisir son titre ainsi que le contenu de celui-ci.
            <?php
                }
            ?>
            </p>
        </div>
        <div id='addContentForm'>
            <form action="
                <?php
                    if ($_GET['action'] == 'newBook') {
                ?>
                index.php?action=addNewBook
                <?php
                    } else if ($_GET['action'] == 'newPost') {
                ?>
                index.php?action=addNewPost&amp;bookId=<?= $_GET['bookId']?>
                <?php
                    }
                ?>
                " method='post'>
                <label for="contentTitle">Titre du
                <?php
                    if ($_GET['action'] == 'newBook') {
                ?>
                 roman
                <?php
                    } else if ($_GET['action'] == 'newPost') {
                ?>
                 chapitre
                <?php
                    }
                ?>
               :</label><input type="text" name="contentTitle" id="contentTitle" required>
                <label for="contentToAdd">
                <?php
                    if ($_GET['action'] == 'newBook') {
                ?>
                 extrait du roman
                <?php
                    } else if ($_GET['action'] == 'newPost') {
                ?>
                 contenu du chapitre
                <?php
                    }
                ?>
                :</label><textarea name="contentToAdd" id="contentToAdd" cols="30" rows="10"></textarea>
                <div id='alignNewContentBtn'>
                <input id='createNewContent' type="submit" value="
                <?php
                if ($_GET['action'] == 'newBook') {
                ?>
                Créer nouveau roman
                <?php
                    } else if ($_GET['action'] == 'newPost') {
                ?>
                Créer nouveau chapitre
                <?php
                    }
                ?>
                ">
                </div>
            </form>
        </div>
    </div>
    <?php $content = ob_get_clean(); ?>

    <?php require('template.php'); ?>
    <script>
        tinymce.init({
            selector: 'textarea',
            height: 500,
            theme: 'modern',
            plugins: 'lists advlist image imagetools'
        });
    </script>
