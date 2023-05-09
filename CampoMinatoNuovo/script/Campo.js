

class Campo {
    constructor(grand, min) {
        this.n = grand;
        this.mine = min;
        this.campo = [];
        this.cAperte = 0;
        this.gioco = true;
        this.mineScoperte=0;
        this.contatoreMine=min;

    }

    reset(){
        location.reload();
    }

    creaCampo() {
        $('#numMine').text("mine: " + this.mine);
        //crea la tabella
        $('#griglia').css("height", $('#griglia').width() + "px");

        for (let r = 0; r < this.n; r++) {
            this.campo[r] = [];
            for (let c = 0; c < this.n; c++) {
                this.campo[r][c] = new Cella();
                $('#griglia').append('<div class="cella" data-row="' + r + '" data-col="' + c + '">&nbsp;</div>');
            }
            //$('#griglia').append("<br>");
        }
        $('.cella').css("line-height", $('.cella').width() + "px");
        $('.cella').css("font-size", (32 / 50) * $('.cella').width() + "px");

    }

    //mette le mine a caso
    posizionaMine() {

        //mette le mine a caso
        let m = 0;
        while (m < this.mine) {
            let pr = Math.round((this.n - 1) * Math.random());
            let pc = Math.round((this.n - 1) * Math.random());
            if (!this.campo[pr][pc].mina) {
                this.campo[pr][pc].mina = true;
                for (let i = -1; i <= 1; i++)
                    for (let j = -1; j <= 1; j++) {
                        let dr = pr + i;
                        let dc = pc + j;
                        if (dr >= 0 && dc >= 0 && dr < this.n && dc < this.n) {
                            this.campo[dr][dc].cont++;
                        }
                    }
                m++;
            }
        }
    }

    //controlla se c'è una mina sulla casella scelta ed eventualmente su quelle vicine
    controlla(r, c) {

        if (this.campo[r][c].aperta)
            return true;

            if(  this.campo[r][c].flag==true){
                this.campo[r][c].flag=false;
                $('.cella[data-row=' + r + '][data-col=' + c + ']').removeClass("bandiera");
                 this.contatoreMine++;
                 this.aggiornaDisplayMine();
            }
        this.campo[r][c].aperta = true;
        this.cAperte++;

        $('.cella[data-row=' + r + '][data-col=' + c + ']').html(this.campo[r][c].cont ? this.campo[r][c].cont : "&nbsp;");
        
        $('.cella[data-row=' + r + '][data-col=' + c + ']').addClass("aperta");

      
        if (!this.campo[r][c].mina && !this.campo[r][c].cont) {

            //controlla le zone vicino
            for(var dr=r-1;dr<=r+1;dr++)
            for(var dc=c-1;dc<=c+1;dc++)
                if(dc >= 0 && dr >= 0 && dc < this.n && dr < this.n)
                    this.controlla(dr,dc);

        } else if (this.campo[r][c].mina) {
            // qui mettiamo la mina
            $('.cella[data-row=' + r + '][data-col=' + c + ']').html('<i class="fa fa-bomb"></i>');
            $('.cella[data-row=' + r + '][data-col=' + c + ']').addClass("mina");
            return false;
        }

        return true;

    }
//serve per far vedere tutte le mine una volta che si ha perso
    scopriMine() {
        for (let r = 0; r < this.n; r++)
            for (let c = 0; c < this.n; c++)
                if (this.campo[r][c].mina) {
                    this.campo[r][c].aperta = true;
                    if(this.campo[r][c].flag==true){
                        $('.cella[data-row=' + r + '][data-col=' + c + ']').removeClass("bandiera");
                    }
                    $('.cella[data-row=' + r + '][data-col=' + c + ']').html('<i class="fa fa-bomb"></i>');
                    $('.cella[data-row=' + r + '][data-col=' + c + ']').addClass("mina");
                }
    }




    flag(r, c){
    
        if(this.gioco==true){
            if (this.campo[r][c].aperta)
            return true;
    
    
         

            this.campo[r][c].flag =!this.campo[r][c].flag;
    

            if(this.contatoreMine>0){
                if(  this.campo[r][c].flag==true){
                    $('.cella[data-row=' + r + '][data-col=' + c + ']').addClass("bandiera");
                    this.contatoreMine--;
                    
                    
            }
            if(this.campo[r][c].mina && this.campo[r][c].flag){
                this.mineScoperte++;
            }
            



            }
            if(  this.campo[r][c].flag==false){
                $('.cella[data-row=' + r + '][data-col=' + c + ']').removeClass("bandiera");
                this.contatoreMine++;
                   this.mineScoperte--;
            }

            if(this.mine==this.mineScoperte){
                $('#stato').text("Hai vinto!");
                alert("Hai Vinto!");
                this.scopriMine();
                this.gioco=false;
            }
            this.aggiornaDisplayMine();

           
        }
        }
        
     aggiornaDisplayMine(){
        $('#numMine').text("mine: "+this.contatoreMine);
     }
}


