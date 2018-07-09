<?php
if (session_id() == '') {
   session_start();
}
?>
<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<div id="content">
    <div id="retourRoman" class="animated shake">
        <a href="index.php?action=listPosts&amp;id=<?= $_GET['book_id']?>">Retour à la liste des chapitres</a>
    </div>
    <div class="chapter">
        <h3>
            <?= htmlspecialchars($post['title']) ?>
                <em>paru le <?= $post['creation_date_fr'] ?></em>
        </h3>

        <p>
            <?= nl2br(htmlspecialchars($post['content'])) ?>
        </p>
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
    ?>

        <div id="<?= $comment['commentId']?>" class="comment">
            <p><strong><?= htmlspecialchars($comment['name']) ?></strong> le
                <?= $comment['comment_date_fr'] ?>
                    <br />
                    <?= nl2br(htmlspecialchars($comment['comment'])) ?><br>
            </p>
            <a href="index.php?action=reportComment&amp;id=<?= $_GET['id']?>&amp;book_id=<?= $_GET['book_id']?>&amp;user_id=<?= $_GET['user_id']?>&amp;comment_id=<?= $comment['commentId']?>">Signaler le commentaire</a>
        </div>

        <?php
}
?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
