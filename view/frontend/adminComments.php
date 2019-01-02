<?php
$pageTitle = 'Administration des commentaires';
ob_start();
?>
<div id="content">
    <div>
        <h1>Panneau d'administration des commentaires</h1>
    </div>
    <div id="messageAccueil">
        <h2> bonjour <?= $_SESSION['name'] ?></h2>
    </div>
    <div id="infosAdmin">
        <div class='section'>
            <h3>Edition / Suppréssion</h3>
        </div>
        <h4>Liste des commentaires signalé(s) :</h4>
        <div id="listeRomansAdmin">
            <?php
                while($reportedComment = $reportedComments->fetch()) {
            ?>
            <div class="comment">
                <div class="commentDate">
                <strong><?= htmlspecialchars($reportedComment['name']) ?></strong> le
                <?= $reportedComment['comment_date_fr'] ?>
            </div>
            <div>
                <?= nl2br(htmlspecialchars($reportedComment['comment'])) ?>
            </div>
                <div class="linkPosition dotLine">
                    <a href="index.php?action=validComment&amp;commentId=<?= $reportedComment['id'] ?>" class="redUnderline">Accepter le commentaire</a>
                    <a href="index.php?action=delete&amp;commentId=<?= $reportedComment['id'] ?>" onclick="return confirm('Etes-vous sûr de vouloir supprimer ce commentaire ?');" class="redUnderline">Supprimer</a>
                </div>
            </div>
            <?php
                }
            $reportedComments->closeCursor();
            ?>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require('template.php');
?>
