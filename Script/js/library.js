// Apertura finestra dialogo => Fyle system
// Prendi l'elemento con id="luogo" e inserisci N <option> dal file
// Utilizzo l'API di FileSystemHandle: https://developer.mozilla.org/en-US/docs/Web/API/FileSystemHandle
async function caricaFile1(){
    // Apertura finestra di dialogo
    let [fileHandle] = await window.showOpenFilePicker();  // let[nome] => Destructuring => struttura al contrario di un oggetto
    let fileData = await fileHandle.getFile();

    // Testo da file
    let text = await fileData.text();
    let Elementi = text.split("\r\n");
    console.log(); 
    
    // Creazione del select
    const select = document.getElementById("luogo");
    select.innerHTML = "";
    for(let i=0; i<Elementi.length; i++){
        let option = document.createElement("option");
        option.textContent = Elementi[i].replace(";", " - ");
        select.appendChild(option);
    }

    select.disabled = false;
}

function caricaFile(input){
    // Testo da file
    let inputfile = input.files[0];
    if (inputfile){
        const lettore = new FileReader();
        lettore.readAsText(inputfile);
        lettore.onload = function (){
            var testo = lettore.result;
            let Elementi = text.split("/\r?\n/");
            
            // Creazione del select
            const select = document.getElementById("luogo");
            select.innerHTML = "";
            for(let i=0; i<Elementi.length; i++){
                let option = document.createElement("option");
                option.textContent = Elementi[i].replace(";", " - ");
                select.appendChild(option);
            }

            select.disabled = false;
        }
    }
}

function controlloNome(input) {
    const regex = /^[A-Za-zÀ-ÖØ-öø-ÿ' ]{0,50}$/; // 0–50 lettere, spazi o apostrofi

    if (!regex.test(input.value)) {
        alert("Errore: il nominativo può contenere solo lettere, spazi o apostrofi (max 50 caratteri).");
        input.value = input.value.slice(0, -1); // Rimuovo l'ultimo carattere inserito
    }
}

function controlloCAP(input) {
    const regex = /^[0-9]{0,5}$/; // fino a 5 cifre decimali

    if (!regex.test(input.value)) {
        alert("Errore: il CAP deve contenere solo numeri (max 5 cifre).");
        input.value = input.value.slice(0, -1); // Rimuovo l'ultimo carattere inserito
    }
}

// Calcola il giorno attuale => max per data di nascita
function getOggi(){
    // Data di oggi in formato string AAAA-MM-GG
    // split T così non prendo l'orario
    const oggi = new Date().toISOString().split("T")[0];
    document.getElementById("nascita").setAttribute("max", oggi);
}

// Attiva - disattiva textArea
function attivaTextArea(){
    const checkbox = document.getElementById("stud-lav");
    const textarea = document.getElementById("desc");

    textarea.disabled = !checkbox.checked;
}

function invio(event){
    event.preventDefault();

    const form = document.getElementById("form");
    form.preventDefault;

    // 1. Nominativo non vuoto (non composto solo da spazi)
    const nominativo = document.getElementById("nominativo").value.trim();
    if(nominativo == ""){
        alert("Errore: il nominativo non può essere vuoto.");
        return;
    }

    // Controlli già fatti da HTML5
    // 2. Sesso selezionato => required
    // 3. Data di nascita selezionata => required + max oggi
    // 4. Ateneo selezionato => obbligatorio in un select

    // Controllo textArea se attiva
    const checkbox = document.getElementById("stud-lav");
    const textarea = document.getElementById("desc");

    if((checkbox.checked && textarea == null) ||(checkbox.checked && textarea.value.trim() == "")){
        alert("Errore: se sei uno studente lavoratore, devi compilare la descrizione.");
        return;
    }

    // Controllo luogo di nascita
    const luogo = document.getElementById("luogo");
    if(luogo.value == "" || luogo.disabled){
        alert("Errore: devi selezionare un luogo di nascita.");
        return;
    }

    // Conferma finale prima dell'invio (dialog)
    const conferma = confirm("Sei sicuro di voler inviare il modulo?");
    if (!conferma) {
        alert("Invio annullato.");
        return;
    }

    form.submit();
}

// Esegui subito il calcolo di oggi
window.onload = getOggi;