var inicio = 0;
var slides = document.querySelectorAll('.item-slides')
var tx = document.querySelector('.tx')
var next = document.querySelector('.next')
var prev = document.querySelector('.prev')

tx.addEventListener('mouseenter',entrar)
tx.addEventListener('mouseout',sair)

showSlides();

function showSlides(){

   for(let i=0; i < slides.length; i++){
      slides[i].style.display = 'none';
   }
   inicio ++
      if (inicio > slides.length) {
            inicio=1
      }

      slides[inicio-1].style.display ="block";

     // console.log(slides[inicio-1]);

      setTimeout(showSlides,5500)

   next.addEventListener('click',function(){
         alert("ola next")
   });
}  

function entrar(){
      
      tx.classList.add('an');
      tx.innerText ='Tecnologias HTML, CSS3, Flutter, NodeJs, Linguagen Dart, JavaScript, PHP e Java'
      }

function sair(){
      tx.innerText ='Desenvolvedor front-end, designer de experiencia, interacao,UI e UX,designs limpos e modernos';
}