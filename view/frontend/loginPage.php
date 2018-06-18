<?php $title = 'Identifiez vous'; ?>

<?php ob_start(); ?>
<div id="content">
    <div id="presentationAdmin">
        <p>
            Cette page de connexion est réservée à Jean Forteroche ainsi que son équipe de modération.
            <br /> Cliquez sur le lien ci-desous pour retrouver votre chemin.
        </p>
        <div id="retourMainPage" class="animated shake">
            <a href="index.php">Retour à l'accueil</a>
        </div>
    </div>
    <div id="formulaireConnexion">
            <form action="post" action="">
                <label for="idField">Identifiant</label><input type="text" id="idField">
                <label for="pwField">Mot de passe</label><input type="text" id="pwField">
                <input type="submit">
            </form>
        </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
