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
        while ($data = $publishedBooks->fetch()) {
            if ($data['publish'] == 1) {
        ?>
        <div id="book">
            <div class="book_title">
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
            }
        }
        $publishedBooks->closeCursor();
        while ($data2 = $unpublishedBooks->fetch()) {
            if($data2['publish'] == 0) {
        ?>
        <div id="workInProgress">
            <div class="book_title">
                <h3>
                    <?= htmlspecialchars($data2['title']) ?>
                </h3>
            </div>
            <div>
                <?= $data2['summary'] ?>
                <br />
                <?php
                if ($_SESSION['permission'] == 1) {
                ?>
                <div id="listeChapitre" class="animated shake">
                    <em>
                        <a href="index.php?action=listPosts&amp;id=<?= $data2['id'] ?>">Accès aux chapitres</a>
                    </em>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        <?php
            }
        }
        $unpublishedBooks->closeCursor();
        ?>
    </div>
</div>
<?php
$content = ob_get_clean();
require('template.php');
?>
