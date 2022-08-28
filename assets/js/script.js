

const card = document.querySelectorAll('[data-animar]');

const classAnime = 'anime';

function animarScroll(){
    const posicaScroll = window.pageYOffset + 500;
    card.forEach(function(e){
        if(posicaScroll > e.offsetTop){
            e.classList.add(classAnime);
        }
        console.log(e.offsetTop);
    })
}

window.addEventListener('scroll',function(){
    animarScroll();
})