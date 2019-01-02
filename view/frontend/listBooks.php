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
$pageTitle = 'Mes romans';
ob_start();
?>
<div id="content" class="bookList">
    <div id="books">
        <?php
        while ($data = $publishedBooks->fetch()) {
            if ($data['publish'] == 1) {
                $title = $data['title'];
                $titleEdit = str_replace(' ','',ucwords($title));
        ?>
        <div id="book">
            <div class="book_title">
                <h3><?= htmlspecialchars($data['title']) ?></h3>
            </div>
            <div>
                <?= $data['summary'] ?>
                <br />
            </div>
            <div id="listeChapitre" class="animated pulse">
                <em>
                    <a href="roman-<?= $data['id'] ?>-<?= $titleEdit ?>.html">Accès aux chapitres</a>
                </em>
            </div>
        </div>
        <?php
            }
        }
        $publishedBooks->closeCursor();
        while ($data2 = $unpublishedBooks->fetch()) {
            if($data2['publish'] == 0) {
                $title = $data2['title'];
                $titleEdit = str_replace(' ','',ucwords($title));
        ?>
        <div class="workInProgress">
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
                <div id="listeChapitre" class="animated pulse">
                    <em>
                        <a href="roman-<?= $data2['id'] ?>-<?= $titleEdit?>.html">Accès aux chapitres</a>
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
