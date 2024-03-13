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
/*--------------------------------------------------------------------------------botões pagina------------------*/
function selectNext(){
  var select = document.getElementById("pagina");
  var value = select.options[select.selectedIndex].value;
  var next = parseInt(value) + 1;
  if(next > select.options[select.options.length - 1].value){
      next = select.options[select.options.length - 1].value;
  }
  select.value = next;
  selectChange();
}

function selectPrevious(){
  var select = document.getElementById("pagina");
  var value = select.options[select.selectedIndex].value;
  var previous = parseInt(value) - 1;
  if(previous < 1){
    previous = 1;
  }
  select.value = previous;
  selectChange();
}

function selectFirst(){
  var select = document.getElementById("pagina");
  select.value = 1;
  selectChange();
}

function selectLast(){
  var select = document.getElementById("pagina");
  select.value = select.options[select.options.length - 1].value;
  selectChange();
}