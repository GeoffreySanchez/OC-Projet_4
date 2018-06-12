<?php $title = htmlspecialchars($book['title']); ?>

<?php ob_start(); ?>


<div id="content">
    <?php
while ($data = $posts->fetch())
{
    if (strlen($data['content']) < 2000){
    ?>
        <div class="chapter chapter<?= $data['id'] ?>">
            <h3>
                <?= htmlspecialchars($data['title']) ?><br><em>paru le <?= $data['creation_date_fr'] ?></em>
            </h3>
            <p>
                <?= nl2br(htmlspecialchars($data['content'])) ?><br />
                    <em>
                    <a href="index.php?action=post&amp;id=<?= $data['id'] ?>&amp;book_id=<?= $book['id'] ?>">commenter</a>
                </em>
            </p>
        </div>
        <?php
    } else{
     ?>
            <div class="chapter chapter<?= $data['id'] ?>">
                <h3>
                    <?= htmlspecialchars($data['title']) ?><br><em>paru le <?= $data['creation_date_fr'] ?></em></h3>
                <p>
                    <?= nl2br(htmlspecialchars($data['contentMin'])) ?> ...
                        <br />
                        <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>&amp;book_id=<?= $book['id'] ?>">Lire la suite et commenter</a></em>
                </p>
            </div>
            <?php
    }
    ?>
                <?php
}
$posts->closeCursor();
?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
