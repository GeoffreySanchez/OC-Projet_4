  /*--------------------------------------------------------------*/
 /* Gère l'affichage du mot de passe saisie sur la page de login */
/*--------------------------------------------------------------*/
var oeilBtnActive = document.getElementById("afficherMdp");
var oeilBtnDesactive = document.getElementById("masquerMdp");
var champMdp = document.getElementById("pwField");



/* Gère les clics avec une souris */
document.getElementById("afficherMdp").addEventListener("mousedown", function() {
    champMdp.type='text';
    oeilBtnActive.style.display = 'none';
    oeilBtnDesactive.style.display = 'inline';
})

document.getElementById("masquerMdp").addEventListener("mouseup", function() {
    champMdp.type='password';
    oeilBtnDesactive.style.display = 'none';
    oeilBtnActive.style.display = 'inline';
})



/* Gère les evenements sur écran tactile */
document.getElementById("afficherMdp").addEventListener("touchstart", function() {
    champMdp.type='text';
    oeilBtnActive.style.display = 'none';
    oeilBtnDesactive.style.display = 'inline';
})

document.getElementById("masquerMdp").addEventListener("touchend", function() {
    champMdp.type='password';
    oeilBtnDesactive.style.display = 'none';
    oeilBtnActive.style.display = 'inline';
})
