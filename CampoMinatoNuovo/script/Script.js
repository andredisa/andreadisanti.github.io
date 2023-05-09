
function generaCampo() {
  $('#stato').text(" ");
  let mine = 0;
  let diff = document.getElementById("difficoltà").value;
  let dim = 0;
  if (diff == 1) {
    dimCampo = 25;
    mine = 15;
  } else if (diff == 2) {
    dimCampo = 15;
    mine = 20;
  }
  else if (diff == 3) {
    dimCampo = 15;
    mine = 25;
  }
  else if (diff == 4) {
    dimCampo = 10;
    mine = 30;
  }


  grandezza = (dimCampo * 55);

  $('#griglia').css("width", + grandezza + "px");
  $('#griglia').css("height", $('#griglia').width() + "px");



  const campo = new Campo(dimCampo, mine);
  $('#griglia').html("");
  campo.creaCampo();
  campo.posizionaMine();
  $('#reset').click(function () {
    campo.reset();
  });



  $('.cella').click(function () {

    if (campo.gioco) {
      let r = parseInt($(this).attr("data-row"));
      let c = parseInt($(this).attr("data-col"));
      if (!campo.controlla(r, c)) {
        // ha perso
        campo.gioco = false;
        $('#stato').html("Hai perso!");
        alert("Hai Perso!");
      } else if (campo.n * campo.n - campo.cAperte <= campo.mine) {
        // hai vinto
        campo.gioco = false;
        $('#stato').html("Hai vinto!");
        alert("Hai Vinto!");
      }
      if (!campo.gioco)
        campo.scopriMine();
    } else {
      alert("Gioco finito!");
    }
  });

  $("#griglia").on('contextmenu', function (e) {

    e.preventDefault();
    let clickedElement = $(e.target);

    //prendo riga e colonna

    let r = parseInt(clickedElement.attr("data-row"));

    let c = parseInt(clickedElement.attr("data-col"));

    campo.flag(r, c);

  });
}


