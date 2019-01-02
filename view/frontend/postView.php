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
$pageTitle = htmlspecialchars($post['title']);
ob_start();
?>
<div id="content">
    <div id="retourPrecedent" class="animated pulse">
        <a href="roman-<?= $_GET['book_id'] ?>-<?= $_GET['book_title'] ?>.html">Retour à la liste des chapitres</a>
    </div>
    <div class="chapter">
        <h3>
            <?= htmlspecialchars($post['title']) ?>
            <em>paru le <?= $post['creation_date_fr'] ?></em>
        </h3>
        <div class="contenuChapitre">
            <?= $post['content'] ?>
        </div>
    </div>
    <h2>Commentaires</h2>
    <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>&amp;book_id=<?= $_GET['book_id'] ?>&amp;user_id=<?= $_SESSION['id'] ?>&amp;book_title=<?= $_GET['book_title'] ?>&amp;post_title=<?= $_GET['title'] ?>" method="post">
        <div>
            <label for="commentWriter">Veuillez saisir votre commentaire</label>
            <textarea id="commentWriter" name="comment" required></textarea>
        </div>
        <div>
            <input type="submit" />
        </div>
    </form>
    <?php
    while ($comment = $comments->fetch()) {
        if ($comment['report'] > 0) {
    ?>
    <div id="<?= $comment['commentId']?>" class="comment">
    <?php
        } else {
    ?>
        <div id="<?= $comment['commentId']?>" class="comment">
        <?php
        }
        ?>
            <div class="commentDate">
                <strong><?= htmlspecialchars($comment['name']) ?></strong> le
                <?= $comment['comment_date_fr'] ?>
            </div>
            <div>
                <?= nl2br(htmlspecialchars($comment['comment'])) ?>
            </div>
            <?php
            if ($comment['report'] > 0) {
            ?>
            <div class="reportCommentSeparation">
                <p class="delete">Ce commentaire a déjà été signalé</p>
            </div>
            <?php
            } else {
            ?>
            <div class="reportCommentSeparation">
                <a href="index.php?action=reportComment&amp;id=<?= $_GET['id']?>&amp;book_id=<?= $_GET['book_id']?>&amp;user_id=<?= $_GET['user_id']?>&amp;comment_id=<?= $comment['commentId']?>&amp;book_title=<?= $_GET['book_title'] ?>&amp;post_title=<?= $_GET['title'] ?>" class="redUnderline">Signaler le commentaire</a>
            </div>
            <?php
                }
            ?>
        </div>
        <?php
        }
        ?>
    </div>
</div>
<?php
$content = ob_get_clean();
require('template.php');
?>
