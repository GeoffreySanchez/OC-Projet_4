<?php
if ($_GET['action'] == 'modifyBookPage') {
    $pageTitle = 'Modification du roman';
} else if ($_GET['action'] == 'modifyPostPage') {
    $pageTitle = 'Modification du chapitre';
}
ob_start();
?>
<script>
    tinymce.init({
        selector: 'textarea',
        height: 500,
        theme: 'modern',
        plugins: 'lists advlist image imagetools',
        language_url : 'public/langs/fr_FR.js'
    });
</script>
<div id="content">
    <div id="PageTitle">
        <h1>Mise à jour du
        <?php
        if ($_GET['action'] == 'modifyBookPage') {
        ?>
            roman
        <?php
        } else if ($_GET['action'] == 'modifyPostPage') {
        ?>
            chapitre
        <?php
            }
        ?>
        </h1>
    </div>
    <div id="explication">
        <p>
            Pour modifier un
            <?php
            if ($_GET['action'] == 'modifyBookPage') {
            ?>
            roman, veuillez saisir un nouveau titre ou texte si necessaire.
            <?php
            } else if ($_GET['action'] == 'modifyPostPage') {
            ?>
            chapitre, veuillez saisir son nouveau titre, résumé ou contenu si necessaire.
            <?php
                }
            ?>
        </p>
    </div>
    <div id='addContentForm'>
        <?php
        if ($_GET['action'] == 'modifyBookPage') {
        ?>
        <form action="index.php?action=modifyBook&amp;bookId=<?= $_GET['bookId']?>" method='post'>
            <label for="contentTitle" class="blackUnderline">Titre du roman :</label>
            <input type="text" name="contentTitle" id="contentTitle" value="<?= $returnBook['title']?>" required>
            <label for="contentToAdd" class="blackUnderline">Extrait du roman :</label>
            <textarea name="contentToAdd" id="contentToAdd" cols="30" rows="10"><?= $returnBook['summary']?></textarea>
            <div id='alignNewContentBtn'>
            <input id='createNewContent' type="submit" value="Modifier roman">
            </div>
        </form>
        <?php
        } elseif ($_GET['action'] == 'modifyPostPage') {
        ?>
        <form action="index.php?action=modifyPost&amp;postId=<?= $_GET['postId']?>&amp;bookId=<?= $_GET['bookId']?>&amp;bookTitle=<?= $_GET['bookTitle']?>" method='post'>
            <label for="contentTitle" class="blackUnderline">Titre du chapitre :</label>
            <input type="text" name="contentTitle" value="<?= $returnPost['title']?>" id="contentTitle" required>
            <label for="chapterSummary" class="blackUnderline">Contenu du résumé :</label>
            <textarea name="chapterSummary" id="chapterSummary" cols="30" rows="10"><?= $returnPost['summary']?></textarea>
            <label for="contentToAdd" class="contentToAddMargin blackUnderline">Contenu du chapitre :</label>
            <textarea name="contentToAdd" id="contentToAdd" cols="30" rows="10"><?= $returnPost['content']?></textarea>
            <div id='alignNewContentBtn'>
            <input id='createNewContent' type="submit" value="Modifier chapitre">
            </div>
        </form>
        <?php
            }
        ?>
    </div>
</div>
<?php
$content = ob_get_clean();
require('template.php');
?>
