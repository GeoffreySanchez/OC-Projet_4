<?php
/* on vérifie que l'information "menu_destination" existe ET qu'elle n'est pas vide : */
if ( isset($_POST['ancre']) && !empty($_POST['ancre'])) {
    header("Location: ".$_POST['ancre']."");
}
else {
    header("Location: index.php");
}
?>
