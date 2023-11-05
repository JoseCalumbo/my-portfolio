var botao = document.querySelector(".btn");
var menu = document.querySelector(".menu");
var srcImg = document.querySelector(".img-menu")

botao.addEventListener('click',abrirMenu);

function abrirMenu (){
    if ( menu.classList.toggle("activar")) {
        srcImg.src="assets/img/close.svg"
    } else {
        srcImg.src="assets/img/menu.svg"
    }
}

