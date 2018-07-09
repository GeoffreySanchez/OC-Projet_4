<?php
if (session_id() == '') {
   session_start();
}
$title = htmlspecialchars($book['title']); ?>

<?php ob_start(); ?>

<div id="content" class="reverse">
    <?php
$nChapitre = 0;
$arrTitle = array();
$arrId = array();
while ($data = $posts->fetch()) {
    if (strlen($data['content']) < 2000){
        $nChapitre = $nChapitre + 1;
?>
        <div id="<?=$nChapitre ?>" class="chapter chapter<?= $data['id'] ?>">
            <h3>
                <?= htmlspecialchars($data['title']) ?><br><em>paru le <?= $data['creation_date_fr'] ?></em>
            </h3>
            <p>
                <?= nl2br(htmlspecialchars($data['content'])) ?><br />
                    <em>
                    <a href="index.php?action=post&amp;id=<?= $data['id'] ?>&amp;book_id=<?= $book['id'] ?>&amp;user_id=<?= $_SESSION['id'] ?>">commenter</a>
                </em>
            </p>
        </div>
        <?php
    } else{
        $nChapitre = $nChapitre + 1;
     ?>
            <div id="<?=$nChapitre ?>" class="chapter chapter<?= $data['id'] ?>">
                <h3>
                    <?= htmlspecialchars($data['title']) ?><br><em>paru le <?= $data['creation_date_fr'] ?></em></h3>
                <p>
                    <?= nl2br(htmlspecialchars($data['contentMin'])) ?> ...
                        <br />
                        <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>&amp;book_id=<?= $book['id'] ?>&amp;user_id=<?= $_SESSION['id'] ?>">Lire la suite et commenter</a></em>
                </p>
            </div>
            <?php
    }
    $arrTitle[] = htmlspecialchars($data['title']);
    $arrId[] = $nChapitre;
    ?>
                <?php
}
$posts->closeCursor();
?>

                <div id="searchMenu">
                    <input id="checkBox" type="checkbox">
                    <label id="loupe" class="checkBox" for="checkBox"></label>
                    <div id="searchBar">
                       <form method="post" action="redirectionChapitre.php">
                        <label for="recherche">choississez votre chapitre</label>
                        <select name="ancre" id="deplacement">
                        <?php
                            $i = 0;
                            while ( $i < count($arrTitle)){
                             ?>
                             <option value="index.php?action=listPosts&amp;id=<?=$book['id']?>#<?=$arrId[$i] ?>"><?=$arrTitle[$i] ?></option>
                            <?php
                            $i++;
                            }
                            ?>
                        </select>
                        <input type="submit" value="Naviguer" title="validez pour naviguer au chapitre">
                        </form>
                    </div>
                </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
