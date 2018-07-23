<?php
if (session_id() == '') {
   session_start();
}
$title = 'Identifiez vous'; ?>

<?php ob_start(); ?>
<div id="content">
    <?php
    if ($_SESSION['name'] == 'Invité'){
      ?>
        <div id="presentationAdmin">
            <p>
                Cette page de connexion est réservée à Jean Forteroche ainsi que son équipe de modération.
                <br /> Cliquez sur le lien ci-dessous pour retrouver votre chemin.
            </p>
            <div id="retourMainPage">
                <a href="index.php" class="animated shake">Retour à l'accueil</a>
            </div>
        </div>
        <hr />
        <div id="formulaireConnexion">
            <form method="post" action="index.php?action=loginVerification">
                <label for="idField">Identifiant</label><input type="text" id="idField" name="idField" required>
                <label for="pwField">Mot de passe</label><input type="password" id="pwField" name="pwField" required>
                <label for="envoyerConnexion" id="envoyerConnexionAlign">
            <input id="envoyerConnexion" type="submit"></label>
            </form>
        </div>
        <?php
    }
    else {
     ?>
        <div id="accesPannelAdmin">
            <p>Bienvenue
                <?= $_SESSION['name'];?>
            </p>
            <a href="index.php?action=adminPage">Accès au pannel d'administration</a>
        </div>
        <?php
    }
    ?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
