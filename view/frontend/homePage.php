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
           <div class="shadow">
                <p>Vero extra liberis et et orbos qua urbis vero quorundam nec et caelibes vile et credi quicquid qua caelibes aestimant.
                <br />
                <br />
                Vero extra liberis et et orbos qua urbis vero quorundam nec et caelibes vile et credi quicquid qua caelibes aestimant.
                <br />
                <br />
                Vero extra liberis et et orbos qua urbis vero quorundam nec et caelibes vile et credi quicquid qua caelibes aestimant. Vero extra liberis et et orbos qua urbis vero quorundam nec et caelibes vile et credi quicquid qua caelibes aestimant."</p>
            </div>
        </div>
    </div>
    <div>
        <div id="projetEnCours">
            <h2>Les projets en cours :</h2>
            <div id="projets">
                <?php
                while ($data = $publishedBooks->fetch()) {
                    if($data['publish'] == 1) {
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
                }
                $publishedBooks->closeCursor();
                ?>
            </div>
        </div>
        <div id="projetAVenir">
            <h2>Les projets à venirs :</h2>
            <div id="projets">
                <?php
                while ($data2 = $unpublishedBooks->fetch()) {
                    if($data2['publish'] == 0) {
                ?>
                <div class="projet">
                   <?php
                        if ($_SESSION['permission'] < 2) {
                        ?>
                    <h3 class="animated shake">
                        <a href="index.php?action=listPosts&amp;id=<?= $data2['id'] ?>"><?= htmlspecialchars($data2['title']) ?></a>
                    </h3>
                    <?php
                    } else {
                        ?>
                    <h3>
                        <?= htmlspecialchars($data2['title']) ?>
                    </h3>
                    <?php
                    }
                    ?>
                    <div>
                        <?= $data2['summary'] ?>
                    </div>
                </div>
                <?php
                    }
                }
                $unpublishedBooks->closeCursor();
                ?>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require('template.php');
?>
