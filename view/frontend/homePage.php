<?php
if (session_id() == '') {
   session_start();
}
$title = 'Bienvenue sur le blog de Jean Forteroche';
ob_start();
?>
<div id="content">
    <h1>Bienvenue lecteurs !</h1>
    <div id="presentation">
        <div id="photoAuteur">
            <img src="public/images/man-person-black-and-white-hair-white-photography-1384121-pxhere.com.jpg" alt="photo ecrivain">
        </div>
        <div id="texteAuteur">
            <p>Vero extra liberis et et orbos qua urbis vero quorundam nec et caelibes vile et credi quicquid qua caelibes aestimant.</p>
            <p>Vero extra liberis et et orbos qua urbis vero quorundam nec et caelibes vile et credi quicquid qua caelibes aestimant.</p>
            <p>Vero extra liberis et et orbos qua urbis vero quorundam nec et caelibes vile et credi quicquid qua caelibes aestimant. Vero extra liberis et et orbos qua urbis vero quorundam nec et caelibes vile et credi quicquid qua caelibes aestimant."</p>
        </div>
    </div>
    <div>
        <div id="projetEnCours">
            <h2>Les projets en cours :</h2>
            <div id="projets">
                <?php
                while ($data = $books->fetch())
                    if(strlen($data['summary']) > 400) {
                ?>
                <div class="projet">
                    <h3 class="animated shake">
                        <a href="index.php?action=listPosts&amp;id=<?= $data['id'] ?>"><?= htmlspecialchars($data['title']) ?></a>
                    </h3>
                    <div>
                        <?= $data['summary'] ?>
                    </div>
                </div>
                <?php
                }
                $books->closeCursor();
                ?>
            </div>
        </div>
        <div id="projetAVenir">
            <h2>Les projets à venirs :</h2>
            <p>C'est vous qui aurez le dernier mot, profitez-en !</p>
            <i>Fin des votes le 1 septembre 2018</i>
            <form action="vote.php" method="post">
                <div id="choixProjet">
                    <label for="1"><input type="radio" name="roman" value="1" id="1"/>Billet simple pour l'Amazonie</label>
                    <label for="2"><input type="radio" name="roman" value="2" id="2"/>Billet simple pour l'Himalaya</label>
                    <label for="3"><input type="radio" name="roman" value="3" id="3"/>Billet simple pour la Siberie </label>
                    <label for="4"><input type="radio" name="roman" value="4" id="4"/>Billet simple pour le Botswana</label>
                </div>
                <div id="validationFormulaire">
                    <input type="submit" value="Valider">
                </div>
            </form>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require('template.php');
?>
