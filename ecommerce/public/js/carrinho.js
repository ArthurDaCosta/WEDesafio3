/*-----------------------------------------------------------------*/
const primeira = document.getElementById('primeira');
primeira.addEventListener("mousemove", (e) =>{
    console.log(e);
    primeira.style.backgroundPositionX = (-e.screenX)/2 + "px";
    primeira.style.backgroundPositionY = (-e.screenY)/2 + "px";
});
/*--------------------------------------------------------------------------------botão menu------------------*/
document.getElementById("botao-menu").addEventListener("click", function() {
var menu = document.getElementById("menu-retratil");
if (menu.style.display === "" || menu.style.display === "none") {
menu.style.display = "block";
} else {
menu.style.display = "none";
}
});
