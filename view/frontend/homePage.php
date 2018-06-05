<?php $title = 'Bienvenue sur le blog de Jean Forteroche'; ?>

<?php ob_start(); ?>
<div id="content">
    <h1>Bienvenue lecteurs !</h1>
    <div id="presentation">
        <div id="photoAuteur">
            <img src="../../public/images/man-person-black-and-white-hair-white-photography-1384121-pxhere.com.jpg" alt="photo ecrivain">
        </div>
        <div id="texteAuteur">
            <p>Je vous souhaite à toutes et à tous la bienvenue sur mon tout nouveau blog.</p>
            <p>Je m'appelle Jean Forteroche, j'ai 54 ans et je suis né à Paris. Je suis passionné d'écriture depuis mon enfance et j'achevais ma première nouvelle à l'âge de 14 ans.</p>
            <p>Vous trouverez sur ce tout nouveau blog les prochains chapitres sur lesquelles je travaille actuellement ainsi que mes futurs romans de la même série "Billet simple pour ..."</p>
        </div>
    </div>
    <div id="projets">
        <div id="projetEnCours">
            <h2>Les projets en cours :</h2>
            <div class="projet">
                <h3>Billet simple pour l'Alaska</h3>
                <p>Ce roman raconte le parcours d'un musher français parti en Alaska, que va-t-il lui arriver ?</p>
            </div>
        </div>
        <div id="projetAVenir">
            <h2>Les projets à venirs :</h2>
            <p>C'est vous qui aurez le dernier mot, profitez-en !</p>
            <i>Fin des votes le 1 septembre 2018</i>
            <form action="vote.php" method="post">
                <div id="choixProjet">
                    <label for="1"><input type="radio" name="roman" value="1" />Billet simple pour l'Amazonie</label>
                    <label for="2"><input type="radio" name="roman" value="2" />Billet simple pour l'Himalaya</label>
                    <label for="3"><input type="radio" name="roman" value="3" />Billet simple pour la Siberie </label>
                    <label for="4"><input type="radio" name="roman" value="4" />Billet simple pour le Botswana</label>
                </div>
                <div id="validationFormulaire">
                    <input type="submit" value="Valider">
                </div>
            </form>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
