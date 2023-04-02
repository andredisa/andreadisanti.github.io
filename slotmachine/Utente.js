class Utente {
    constructor() {
        this.credito = 10;
    }

    accredita(tipoVincita, numero) {
        if (tipoVincita == "jackpot") {
            this.credito += 50 * (numero + 1);
        } else if (tipoVincita == "coppia") {
            this.credito += 20 * (numero + 1);
        } else if (tipoVincita == "singola") {
            this.credito = this.credito;
        }
    }
}