<?php
$pageTitle = 'Administration';
ob_start();
?>
<div id="content">
    <div>
        <h1>Panneau d'administration</h1>
    </div>
    <div id="messageAccueil">
        <h2> bonjour <?= $_SESSION['name'] ?></h2>
    </div>
    <div id="infosAdmin">
        <div class='section'>
            <?php
            if ($_SESSION['permission'] == 1) {
            ?>
            <h3>Consultation / Création / Edition / Suppression</h3>
            <?php
            } else {
            ?>
            <h3>Consultation / Modération</h3>
            <?php
            }
            ?>
        </div>
        <h4>Liste des romans :</h4>
        <div id="listeRomansAdmin">
            <?php
            while ($data = $books->fetch()) {
                $title = $data['title'];
                $titleEdit = str_replace(' ','',ucwords($title));
            ?>
            <div class="projet" id="<?= $data['id']?>">
                <?php
                if ($_SESSION['permission'] == 1 || $data['publish'] == 1) {
                ?>
                <h3 class="animated pulse" >
                    <a href="roman-<?= $data['id'] ?>-<?= $titleEdit?>.html">
                        <?= htmlspecialchars($data['title']) ?>
                    </a>
                </h3>
                <?php
                } else {
                ?>
                <h3>
                    <?= htmlspecialchars($data['title']) ?>
                </h3>
                <?php
                }
                ?>
                <div>
                    <?= $data['summary'] ?>
                </div>
                <?php
                if ($_SESSION['permission'] == 1) {
                ?>
                <div class="linkPosition">
                    <a class="modify animated pulse" href="editer-roman-<?= $data['id'] ?>-<?= $titleEdit ?>.html">Modifier</a>
                    <?php
                    if ($data['publish'] == 0) {
                    ?>
                    <a class="publish animated pulse" href="index.php?action=publish&amp;bookId=<?= $data['id'] ?>" onclick="return confirm('Etes-vous sûr de vouloir publier ce roman ?');">Publier</a>
                    <?php
                    }
                    ?>
                    <a class="delete animated pulse" href="index.php?action=delete&amp;bookId=<?= $data['id'] ?>" onclick="return confirm('Etes-vous sûr de vouloir supprimer ce roman ?');">Supprimer</a>
                </div>
                <?php
                }
                ?>
            </div>
            <?php
            }
            $books->closeCursor();
            if ($_SESSION['permission'] == 1) {
            ?>
            <div id='boutonAjout'>
                <a href="ajouter-roman.html">Ajouter un roman<i id='ajoutRomanBouton' class="fas fa-plus-circle fa-4x"></i></a>
            </div>
            <?php
            }
            ?>
        </div>
        <div id="reportedComments">
            <h4>Commentaire(s) signalé(s) :</h4>
            <?php
            $reportCount = 0;
            while($reportedComment = $reportedComments->fetch()) {
                if ($reportedComment['report'] >= 1) {
                    $reportCount = $reportCount + 1;
                }
            }
            $reportedComments->closeCursor();
            if ($reportCount > 0) {
            ?>
            <a href="administration-commentaires.html">Vous avez <?= $reportCount?> commentaire(s) à modérer.</a>
            <?php
            } else {
            ?>
            <p>Vous n'avez aucun commentaire à modérer.</p>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require('template.php');
?>
