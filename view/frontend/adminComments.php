<?php
if (session_id() == '') {
   session_start();
}
$title = 'Administration des commentaires'; ?>

    <?php ob_start(); ?>
    <div id="content">
        <div>
            <h1>Panneau d'administration des commentaires</h1>
        </div>
        <div id="messageAccueil">
            <h2> bonjour
                <?= $_SESSION['name'] ?>
            </h2>
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
                    <div id="comment">
                        <p>
                            <strong><?= htmlspecialchars($reportedComment['name']) ?></strong> le
                            <?= $reportedComment['comment_date_fr'] ?>
                                <br />
                                <?= nl2br(htmlspecialchars($reportedComment['comment'])) ?>
                        </p>
                        <div class="linkPosition">
                            <a href="">Modifier</a>
                            <a href="index.php?action=delete&amp;commentId=<?= $reportedComment['id'] ?>">Supprimer</a>
                        </div>
                    </div>
                    <?php
                    }
                $reportedComments->closeCursor();
                ?>
            </div>
        </div>
    </div>
    <?php $content = ob_get_clean(); ?>

    <?php require('template.php'); ?>
