// Apertura finestra dialogo => Fyle system
// Prendi l'elemento con id="luogo" e inserisci N <option> dal file
function caricaFile(){

}

// Verifica che il campo data sia corretto
function controlloData(){

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

// Esegui subito il calcolo di oggi
window.onload = getOggi;