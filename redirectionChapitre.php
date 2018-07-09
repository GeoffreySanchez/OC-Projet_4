<?php
if ( isset($_POST['ancre']) && !empty($_POST['ancre'])) {
    header("Location: ".$_POST['ancre']."");
}
else {
    header("Location: index.php");
}
?>
