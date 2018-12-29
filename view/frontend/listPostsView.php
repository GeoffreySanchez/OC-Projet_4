<?php
if (session_id() == '') {
   session_start();
}
$pageTitle = htmlspecialchars($book['title']);
ob_start();
?>
<div id="content" >
    <div id="retourPrecedent" class="animated pulse">
        <a href="liste-romans.html">Retour à la liste des romans</a>
    </div>
    <?php
    if($_SESSION['permission'] == 1) {
    ?>
    <div id="addPost">
        <a class="animated pulse" href="ajouter-chapitre-<?= $_GET['id']?>-<?= $_GET['title'] ?>.html">Ajouter un nouveau chapitre</a>
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
        $title = $data['title'];
        $titleEdit = str_replace(' ','',ucwords($title));
$nChapitre = $nChapitre + 1;
    ?>
        <div id="<?=$nChapitre ?>" class="chapter chapter<?= $data['id'] ?>">
           <div class="chapitreBorder">
                <h3>
                    <?= htmlspecialchars($data['title']) ?>
                    <br>
                    <em>paru le <?= $data['creation_date_fr'] ?></em>
                    <?php
                    if ($_SESSION['permission'] == 1) {
                    ?>
                    <br>
                    <a href="editer-chapitre-<?= $data['id'] ?>-<?= $titleEdit ?>-roman-<?= $_GET['id'] ?>-<?= $_GET['title'] ?>.html">Modifier</a> /
                    <a class='delete' href="index.php?action=delete&amp;postId=<?= $data['id'] ?>&amp;book_id=<?= $_GET['id'] ?>&amp;bookTitle=<?= $_GET['title'] ?>" onclick="return confirm('Etes-vous sûr de vouloir supprimer ce chapitre ?');">Supprimer</a>
                    <?php
                    }
                    ?>
                </h3>
                <div class="contenuChapitre">
                    <?= $data['summary'] ?>
                    <br />
                    <em class="readMoreAndComment">
                        <a class="animated pulse" href="roman-<?= $_GET['id'] ?>-<?= $_GET['title'] ?>-chapitre-<?= $data['id'] ?>-<?= $titleEdit ?>-<?= $_SESSION['id'] ?>.html"> Lire la suite et commenter</a>
                    </em>
                </div>
            </div>
        </div>
        <?php
        $arrTitle[] = htmlspecialchars($data['title']);
        $arrId[] = $nChapitre;
        }
        $posts->closeCursor();
        if (!empty($arrTitle)) {
            $title = $book['title'];
            $titleEdit = str_replace(' ','',ucwords($title));
        ?>
        <div id="searchMenu">
            <input id="checkBox" type="checkbox">
            <label id="loupe" class="checkBox" for="checkBox"></label>
            <div id="searchBar">
                <form method="post" action="index.php?action=goToChapter">
                    <label for="deplacement">choississez votre chapitre</label>
                    <select name="ancre" id="deplacement">
                    <?php
                    $i = 0;
                    while ( $i < count($arrTitle)){
                    ?>
                    <option value="roman-<?=$_GET['id'] ?>-<?=$titleEdit ?>.html#<?=$arrId[$i] ?>"><?=$arrTitle[$i] ?></option>
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
