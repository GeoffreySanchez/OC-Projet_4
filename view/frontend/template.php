<?php
if(!isset($_SESSION['name'])) {
    $_SESSION['name'] = 'Invité';
}
if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = '3';
}
if (!isset($_SESSION['permission'])) {
    $_SESSION['permission'] = '3';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=tsai70jk82c8slzi04uo143un10s7dpj8ltaiehcysqp3ymq"></script>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <link href="public/css/style.css" rel="stylesheet" />
    <link href="public/css/animate.css" rel="stylesheet" type="text/css" />
    <link href="https://use.fontawesome.com/releases/v5.0.3/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cardo:400,700" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <ul id="public">
                <li class="animated pulse"><a href="index.html"><i class="fas fa-home"></i> Acceuil</a></li>
                <li class="animated pulse"><a href="liste-romans.html"><i class="fas fa-book"></i> Liste des romans</a></li>
                <li id="hautePage" class="animated pulse"><a href=""><i class="fas fa-arrow-up"></i> haut de page</a></li>
            </ul>
            <?php
            if($_SESSION['name'] == 'Invité') {
            ?>
            <ul id="admin">
                <li class="animated pulse"><a href="identification.html"><i class="fas fa-sign-in-alt"></i> Connexion</a></li>
            </ul>
            <?php
            }
            else {
                ?>
            <ul id="admin">
                <li class="animated pulse"><a href="administration.html"><i class="fas fa-sign-in-alt"></i> Administration</a></li>
                <li class="animated pulse"><a href="index.php?action=logout"><i class="fas fa-sign-in-alt"></i> Déconnexion</a></li>
            </ul>
                <?php
            }
            ?>
        </nav>
    </header>
    <?= $content ?>
    <footer>
         <div id="contact">
            <div id="contactTitle">
                <img src="public/images/unicorn_dab.png" alt="clin d'oeil">
                <h4>Informations de contact: </h4>
            </div>
            <div id="infosContact">
                <div id="contactMail">
                    <img src="public/images/mail.png" alt="icone de mail" />
                    <p>: Jean.forteroche@contact.fr</p>
                </div>
                <div id="contactCourrier">
                    <img src="public/images/adresse.png" alt="icone de courrier" />
                    <div>
                        <a href="https://www.google.com.br/maps/place/109+Rue+du+Bac,+75007+Paris/@48.8523109,2.323076,18z/data=!3m1!4b1!4m5!3m4!1s0x47e671d48f41b323:0xd28da53e242a5cba!8m2!3d48.8523099!4d2.3237267">: <span class="underline">Auto-édition Forteroche - 109 Rue du bac - 2e étage - 75007 Paris</span></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
