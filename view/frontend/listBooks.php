<?php
if (session_id() == '') {
   session_start();
}
$title = 'Mes romans';
ob_start();
?>
<div id="content" class="bookList">
    <div id="books">
        <?php
        while ($data = $books->fetch())
            if (strlen($data['summary']) > 400) {
        ?>
        <div id="book">
            <div id="book_title">
                <h3><?= htmlspecialchars($data['title']) ?></h3>
            </div>
            <div>
                <?= $data['summary'] ?>
                <br />
            </div>
            <div id="listeChapitre" class="animated shake">
                <em>
                    <a href="index.php?action=listPosts&amp;id=<?= $data['id'] ?>">Accès aux chapitres</a>
                </em>
            </div>
        </div>
        <?php
        } else {
        ?>
        <div id="workInProgress">
            <div id="book_title">
                <h3>
                    <?= htmlspecialchars($data['title']) ?>
                </h3>
            </div>
            <div>
                <?= $data['summary'] ?>
                <br />
                <?php
                if ($_SESSION['permission'] == 1) {
                ?>
                <div id="listeChapitre" class="animated shake">
                    <em>
                        <a href="index.php?action=listPosts&amp;id=<?= $data['id'] ?>">Accès aux chapitres</a>
                    </em>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        <?php
        }
        $books->closeCursor();
        ?>
    </div>
</div>
<?php
$content = ob_get_clean();
require('template.php');
?>
