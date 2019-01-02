<?php
if (session_id() == '') {
   session_start();
}
if (!isset($_SESSION['name'])) {
    $_SESSION['name'] = 'Visiteur';
}
if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = '4';
}
if (!isset($_SESSION['permission'])) {
    $_SESSION['permission'] = '3';
}
if ($_GET['action'] == 'newBook') {
    $pageTitle = 'Nouveau roman';
} else if ($_GET['action'] == 'newPost') {
    $pageTitle = 'Nouveau chapitre';
}
ob_start();
?>
<script>
    tinymce.init({
        selector: 'textarea',
        height: 300,
        theme: 'modern',
        plugins: 'lists advlist image imagetools',
        language_url : 'public/langs/fr_FR.js'
    });
</script>
<div id="content">
    <div id="PageTitle">
        <h1>
            Ajouter un nouveau
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
        <p>
            Pour ajouter un nouveau
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
        index.php?action=addNewPost&amp;bookId=<?= $_GET['bookId']?>&amp;bookTitle=<?= $_GET['bookTitle']?>
        <?php
            }
        ?>
        " method='post'>
            <label for="contentTitle" class="blackUnderline">
                Titre du
                <?php
                if ($_GET['action'] == 'newBook') {
                ?>
                roman :
                <?php
                } else if ($_GET['action'] == 'newPost') {
                ?>
                chapitre :
                <?php
                    }
                ?>
            </label>
            <input type="text" name="contentTitle" id="contentTitle" required>
            <?php
            if ($_GET['action'] == 'newPost') {
            ?>
            <label for="chapterSummary" class="blackUnderline">Résumé du chapitre :</label>
            <textarea name="chapterSummary" id="chapterSummary" cols="30" rows="10"></textarea>
            <?php
            }
            ?>
            <label for="contentToAdd" class="contentToAddMargin blackUnderline">
                <?php
                if ($_GET['action'] == 'newBook') {
                ?>
                extrait du roman :
                <?php
                } else if ($_GET['action'] == 'newPost') {
                ?>
                contenu du chapitre :
                <?php
                    }
                ?>
            </label>
            <textarea name="contentToAdd" id="contentToAdd" cols="30" rows="10"></textarea>
            <div id='alignNewContentBtn'>
                <input id='createNewContent' type="submit" value="
                <?php
                if ($_GET['action'] == 'newBook') {
                ?>
                Créer un nouveau roman
                <?php
                } else if ($_GET['action'] == 'newPost') {
                ?>
                Créer un nouveau chapitre
                <?php
                    }
                ?>
                ">
            </div>
        </form>
    </div>
</div>
<?php
$content = ob_get_clean();
require('template.php');
?>
