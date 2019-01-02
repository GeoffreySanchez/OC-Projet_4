<?php
if (session_id() == '') {
   session_start();
}
if (!isset($_SESSION['name'])) {
    $_SESSION['name'] = 'Visiteur';
}
if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = '4';
}
if (!isset($_SESSION['permission'])) {
    $_SESSION['permission'] = '3';
}
$pageTitle = 'Identifiez vous';
ob_start();
?>
<div id="content">
    <?php
    if ($_SESSION['name'] == 'Visiteur') {
    ?>
    <div id="presentationAdmin">
        <p>
            Cette page de connexion est réservée à Jean Forteroche ainsi que son équipe de modération.
            <br />
            Cliquez sur le lien ci-dessous pour retrouver votre chemin.
        </p>
        <div id="retourMainPage">
            <a href="index.html" class="animated pulse">Retour à l'accueil</a>
        </div>
    </div>
    <hr />
    <div id="formulaireConnexion">
        <form method="post" action="index.php?action=loginVerification">
            <label for="idField">Identifiant</label>
            <input type="text" id="idField" name="idField" required>
            <label for="pwField">Mot de passe</label>
            <div id="pwInput">
                <input type="password" id="pwField" name="pwField" required>
                <div id="afficherMdpBox">
                    <div id="afficherMdp"></div>
                    <div id="masquerMdp"></div>
                </div>
            </div>
            <label for="envoyerConnexion" id="envoyerConnexionAlign">
            <input id="envoyerConnexion" type="submit"></label>
        </form>
    </div>
    <?php
    } else {
    ?>
    <div id="accesPannelAdmin">
        <p>Bienvenue <?= $_SESSION['name'];?></p>
        <a href="index.php?action=adminPage">Accès au pannel d'administration</a>
    </div>
    <?php
    }
    ?>
</div>
<?php
$content = ob_get_clean();
require('template.php');
?>
