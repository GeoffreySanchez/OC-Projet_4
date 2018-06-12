<?php $title = 'Mes romans'; ?>

<?php ob_start(); ?>


<div id="content">
    <div id="books">
        <?php
while ($data = $books->fetch())
    if ($data['summary'] != "Projet à venir") {
?>
            <div id="book">
                <div id="book_title">
                    <h3>
                        <?= htmlspecialchars($data['title']) ?>
                    </h3>
                </div>
                <p id="summary">
                    <?= nl2br(htmlspecialchars($data['summary'])) ?>
                        <br />
                </p>
                <div id="listeChapitre" class="animated shake">
                    <em><a href="index.php?action=listPosts&amp;id=<?= $data['id'] ?>">Accès aux chapitres</a></em>
                </div>
            </div>
            <?php
}
        else {
            ?>
            <div id="workInProgress">
                <div id="book_title">
                    <h3>
                        <?= htmlspecialchars($data['title']) ?>
                    </h3>
                </div>
                <p id="summary">
                    <?= nl2br(htmlspecialchars($data['summary'])) ?>
                        <br />
                </p>
            </div>
            <?php
        }
$books->closeCursor();
?>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
