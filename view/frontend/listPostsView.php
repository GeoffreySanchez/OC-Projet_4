<?php
if (session_id() == '') {
   session_start();
}
$title = htmlspecialchars($book['title']);
ob_start();
?>
<div id="content" >
    <div id="retourRoman" class="animated shake">
        <a href="index.php?action=books">Retour à la liste des romans</a>
    </div>
    <?php
    if($_SESSION['permission'] == 1) {
    ?>
    <div id="addPost">
        <a class="animated shake" href="index.php?action=newPost&amp;bookId=<?= $_GET['id']?>">Ajouter un nouveau chapitre</a>
    </div>
    <?php
    }
    ?>
    <div class="reverse">
    <?php
    $nChapitre = 0;
    $arrTitle = array();
    $arrId = array();
    while ($data = $posts->fetch()) {
        if (strlen($data['content']) < 4000) {
            $nChapitre = $nChapitre + 1;
    ?>
        <div id="<?=$nChapitre ?>" class="chapter chapter<?= $data['id'] ?>">
            <h3>
                <?= htmlspecialchars($data['title']) ?>
                <br>
                <em>paru le <?= $data['creation_date_fr'] ?></em>
                <?php
                if ($_SESSION['permission'] == 1) {
                ?>
                <br>
                <a href="index.php?action=modifyPostPage&amp;postId=<?= $data['id'] ?>&amp;bookId=<?= $_GET['id'] ?>">Modifier</a> /
                <a class='delete' href="index.php?action=delete&amp;postId=<?= $data['id'] ?>&amp;book=<?= $_GET['id'] ?>" onclick="return confirm('Etes-vous sûr de vouloir supprimer ce chapitre ?');">Supprimer</a>
                <?php
                }
                ?>
            </h3>
            <div class="contenuChapitre">
                <?= $data['content'] ?>
                <em class="readMoreAndComment">
                    <a href="index.php?action=post&amp;id=<?= $data['id'] ?>&amp;book_id=<?= $book['id'] ?>&amp;user_id=<?= $_SESSION['id'] ?>">Commenter</a>
                </em>
            </div>
        </div>
        <?php
        } else {
            $nChapitre = $nChapitre + 1;
        ?>
        <div id="<?=$nChapitre ?>" class="chapter chapter<?= $data['id'] ?>">
            <h3>
                <?= htmlspecialchars($data['title']) ?>
                <br>
                <em>paru le <?= $data['creation_date_fr'] ?></em>
                <?php
                if ($_SESSION['permission'] == 1) {
                ?>
                <br>
                <a href="index.php?action=modifyPostPage&amp;postId=<?= $data['id'] ?>&amp;bookId=<?= $_GET['id'] ?>">Modifier</a> /
                <a class='delete' href="index.php?action=delete&amp;postId=<?= $data['id'] ?>&amp;book=<?= $_GET['id'] ?>">Supprimer</a>
                <?php
                }
                ?>
            </h3>
            <div class="contenuChapitre">
                <?= $data['contentMin'] ?>...
                <br />
                <em class="readMoreAndCommentMin">
                    <a href="index.php?action=post&amp;id=<?= $data['id'] ?>&amp;book_id=<?= $book['id'] ?>&amp;user_id=<?= $_SESSION['id'] ?>"> Lire la suite et commenter</a>
                </em>
            </div>
        </div>
        <?php
            }
        $arrTitle[] = htmlspecialchars($data['title']);
        $arrId[] = $nChapitre;
        }
        $posts->closeCursor();
        if (!empty($arrTitle)) {
        ?>
        <div id="searchMenu">
            <input id="checkBox" type="checkbox">
            <label id="loupe" class="checkBox" for="checkBox"></label>
            <div id="searchBar">
                <form method="post" action="redirectionChapitre.php">
                    <label for="deplacement">choississez votre chapitre</label>
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
        <?php
        } else {
        ?>
        <div id="workInProgressImg">
            <img src="public/images/work_in_progress.png" alt="Work in progress">
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
