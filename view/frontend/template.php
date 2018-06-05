<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="public/css/style.css" rel="stylesheet" />
    </head>

    <body>
       <header>
          <nav>
               <ul id="public">
                   <li><a href="">Acceuil</a></li>
                   <li><a href="">Liste des romans</a></li>
               </ul>
               <ul id="admin">
                   <li ><a href="">Connexion</a></li>
               </ul>
           </nav>
       </header>
        <?= $content ?>
        <footer>
            <div id="contact">
              <h4>Informations de contact: </h4>
               <div id="contactMail">
                    <img src="../../public/images/mail.png" alt="icone de mail" />
                    <p>: Jean.forteroche@contact.fr</p>
                </div>
                <div id="contactCourrier">
                    <img src="../../public/images/adresse.png" alt="icone de courrier" />
                    <a href="https://www.google.com.br/maps/place/109+Rue+du+Bac,+75007+Paris/@48.8523109,2.323076,18z/data=!3m1!4b1!4m5!3m4!1s0x47e671d48f41b323:0xd28da53e242a5cba!8m2!3d48.8523099!4d2.3237267">: <span class="underline">Auto-édition Forteroche - 109 Rue du bac - 2e étage - 75007 Paris</span></a>
                </div>
            </div>
        </footer>
    </body>
</html>
