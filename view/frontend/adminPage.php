<?php
if (session_id() == '') {
   session_start();
}
$title = 'Administration'; ?>

    <?php ob_start(); ?>
    <div id="content">
        <div>
            <h1>Panneau d'administration</h1>
        </div>
        <div id="messageAccueil">
            <h2> bonjour
                <?= $_SESSION['name'] ?>
            </h2>
        </div>
        <div id="infosAdmin">
            <div class='section'>
                <h3>Consultation / Création / édition / suppréssion</h3>
            </div>
            <h4>Liste des romans :</h4>
            <div id="listeRomansAdmin">
                <?php
                    while ($data = $books->fetch()) {
                ?>
                    <div class="projet" id="<?= $data['id']?>">
                        <h3 class="animated shake">
                            <a href="index.php?action=listPosts&amp;id=<?= $data['id'] ?>">
                                <?= htmlspecialchars($data['title']) ?>
                            </a>
                        </h3>
                        <p>
                            <?= nl2br(htmlspecialchars($data['summaryMin'])) ?> ...
                        </p>
                        <div class="linkPosition">
                            <a class="modify" href="a">Modifier</a>
                            <a class="delete" href="index.php?action=delete&amp;bookId=<?= $data['id'] ?>">Supprimer</a>
                        </div>
                    </div>
                    <?php
                    }
                $books->closeCursor();
                ?>
                        <div id='boutonAjout'>
                            <a href="">Ajouter un roman<i id='ajoutRomanBouton' class="fas fa-plus-circle fa-4x"></i></a>
                        </div>
            </div>
            <div id="reportedComments">
                <h4>Commentaire(s) signalé(s) :</h4>
                <?php
                $reportCount = 0;
                 while($reportedComment = $reportedComments->fetch()) {
                    if ($reportedComment['report'] >= 1){
                        $reportCount = $reportCount + 1;
                    }
                }
                $reportedComments->closeCursor();
                if ($reportCount > 0) {
            ?>
                    <a href="index.php?action=adminComments">Vous avez <?= $reportCount?> commentaire(s) à modérer.</a>
                    <?php
                }
                else {
            ?>
                        <p>Vous n'avez aucun commentaire à modérer.</p>
                        <?php
                }
            ?>
            </div>
        </div>
    </div>
    <?php $content = ob_get_clean(); ?>

    <?php require('template.php'); ?>
