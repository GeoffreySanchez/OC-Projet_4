<?php
if (session_id() == '') {
   session_start();
}
?>
<?php $title = htmlspecialchars($post['title']);
ob_start();
?>
<div id="content">
    <div id="retourRoman" class="animated shake">
        <a href="index.php?action=listPosts&amp;id=<?= $_GET['book_id']?>">Retour à la liste des chapitres</a>
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
    <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>&amp;book_id=<?= $_GET['book_id'] ?>&amp;user_id=<?= $_GET['user_id'] ?>" method="post">
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
    <div style="background-color : rgba(255,0,0,0.3);" id="<?= $comment['commentId']?>" class="comment">
    <?php
        } else {
    ?>
        <div id="<?= $comment['commentId']?>" class="comment">
        <?php
        }
        ?>
            <p>
                <strong><?= htmlspecialchars($comment['name']) ?></strong> le
                <?= $comment['comment_date_fr'] ?>
                <br />
                <?= nl2br(htmlspecialchars($comment['comment'])) ?><br>
            </p>
            <?php
            if ($comment['report'] > 0) {
            ?>
            <p>Ce commentaire a déjà été signalé</p>
            <?php
            } else {
            ?>
            <a href="index.php?action=reportComment&amp;id=<?= $_GET['id']?>&amp;book_id=<?= $_GET['book_id']?>&amp;user_id=<?= $_GET['user_id']?>&amp;comment_id=<?= $comment['commentId']?>">Signaler le commentaire</a>
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
