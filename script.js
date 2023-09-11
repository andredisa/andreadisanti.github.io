// Inizializza l'array per i consumi mensili
let consumiMensili = [];

// Carica i dati salvati, se presenti
window.onload = function () {
    const storedData = localStorage.getItem('consumiMensili');
    if (storedData) {
        consumiMensili = JSON.parse(storedData);
        visualizzaConsumiMensili();
    }
};

// Funzione per aggiornare il massimo numero di giorni in base al mese selezionato
function aggiornaGiorni() {
    const monthSelect = document.getElementById("month");
    const dayInput = document.getElementById("day");
    const selectedMonth = monthSelect.value;

    switch (selectedMonth) {
        case "04":
        case "06":
        case "09":
        case "11":
            dayInput.setAttribute("max", "30");
            break;
        case "02":
            const currentYear = new Date().getFullYear();
            const isLeapYear = (currentYear % 4 === 0 && currentYear % 100 !== 0) || (currentYear % 400 === 0);
            dayInput.setAttribute("max", isLeapYear ? "29" : "28");
            break;
        default:
            dayInput.setAttribute("max", "31");
            break;
    }
}
// Funzione per calcolare le emissioni di CO2
function calcolaEmissioniCO2() {
    const selectedMonth = document.getElementById("month").value;

    // Calcolo delle emissioni in base ai dati inseriti
    const emissioniCO2Mensili = consumiMensili
        .filter((consumo) => consumo.month === selectedMonth)
        .reduce((totalEmissioniCO2, consumo) => {
            // Fattore di emissione medio per la carne (in grammi di CO2 per grammo di carne)
            // Questo è solo un valore di esempio, dovresti utilizzare dati più precisi per un calcolo accurato
            const fattoreEmissioniCarne = 25; // Esempio di valore

            // Calcolo delle emissioni di CO2 per questo consumo specifico
            const emissioniConsumo = consumo.grams * fattoreEmissioniCarne;

            // Aggiungi le emissioni di questo consumo al totale mensile
            return totalEmissioniCO2 + emissioniConsumo;
        }, 0);

    // Recupera il nome del mese selezionato per scopi di visualizzazione
    const selectedMonthName = document.getElementById("month").options[document.getElementById("month").selectedIndex].text;

    // Mostra il risultato nel tuo HTML
    const risultatoEmissioniCO2 = document.getElementById("emissioniCO2");
    risultatoEmissioniCO2.innerHTML = `
        Emissioni di CO2 nel mese di ${selectedMonthName}: ${emissioniCO2Mensili.toFixed(2)} grammi.
    `;
}


// Aggiungi un consumo alla lista
function aggiungiConsumo() {
    const month = document.getElementById("month").value;
    const day = document.getElementById("day").value;
    const food = document.getElementById("food").value;
    const grams = document.getElementById("grams").value;

    if (!month || !day || !food || !grams) {
        alert("Compila tutti i campi.");
        return;
    }

    const consumo = {
        month,
        day,
        food,
        grams: parseInt(grams)
    };

    consumiMensili.push(consumo);
    visualizzaConsumiMensili();
}

// Visualizza i consumi mensili
function visualizzaConsumiMensili() {
    const listaConsumi = document.getElementById("consumiMensili");
    listaConsumi.innerHTML = '';

    for (let i = 0; i < consumiMensili.length; i++) {
        const consumo = consumiMensili[i];

        const listItem = document.createElement("li");
        listItem.innerHTML = `
                    ${consumo.month}/${consumo.day}: ${consumo.food} - ${consumo.grams}g
                    <button onclick="rimuoviConsumo(${i})">Rimuovi</button>
                `;

        listaConsumi.appendChild(listItem);
    }
}

// Rimuovi un consumo dalla lista
function rimuoviConsumo(index) {
    if (confirm("Sei sicuro di voler rimuovere questo consumo?")) {
        consumiMensili.splice(index, 1);
        visualizzaConsumiMensili();
    }
}

// Salva i dati in locale
function salvaDati() {
    localStorage.setItem('consumiMensili', JSON.stringify(consumiMensili));
    alert("Dati salvati con successo.");
}

aggiornaGiorni();