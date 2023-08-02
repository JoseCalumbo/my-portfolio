const a = document.querySelector(".curriculo")

a.addEventListener("click",as)

function as(){

  const content = document.querySelector(".sobre1")

  var options = {
    margin: 1,
    image:{ type: 'jpeg', quality: 0.98 },
    html2canvas:{ scale: 4 },
    filename: "curriclo.pdf",
    html2canvas: { scale: 2 },
    jsPDF: { unit: "in", format: "letter", orientation: "portrait" },
  };


  html2pdf().set(options).from(content).save();
}


