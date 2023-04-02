class SlotMachine {
    constructor() {
        this.numero1 = 0;
        this.numero2 = 0;
        this.numero3 = 0;
        this.numeroVincente = "";
        this.tipoVincita = "";
    }

    spin() {
        let estrazione = Math.floor(Math.random() * 9) + 1;
        this.numero1 = estrazione;

        estrazione = Math.floor(Math.random() * 9) + 1;
        this.numero2 = estrazione;

        estrazione = Math.floor(Math.random() * 9) + 1;
        this.numero3 = estrazione;

        if (this.numero1 == this.numero2 && this.numero2 == this.numero3) {
            this.numeroVincente = this.numero1;
            this.tipoVincita = "jackpot";
        }
        else if (this.numero1 == this.numero2 || this.numero2 == this.numero3) {
            if (this.numero1 == this.numero2)
                this.numeroVincente = this.numero1;
            else if (this.numero2 == this.numero3) 
                this.numeroVincente = this.numero2;
            this.tipoVincita = "coppia";
        } else {
            this.numeroVincente = this.numero1;
            this.tipoVincita = "singola";
        }
    }

    reset() {
        this.numero1 = 0;
        this.numero2 = 0;
        this.numero3 = 0;
        this.numeroVincente = "";
        this.tipoVincita = "";
    }
}