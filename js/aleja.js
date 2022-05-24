var greske = [false, false, false, false, false, false, false];
var brojacGresakaUTekstu = 0;
var orijentacija;


function ucitaj() {
    const inputDatoteke = document.getElementById("naziv");
    const forma = document.getElementById("formaObrazac");
    const tekst = document.getElementById("opis");
    const odabir = document.getElementById("kategorija");
    

    odabir.addEventListener("change", promjenaOdabira);

    orijentacija = true;
    promijeniOrijentaciju();

    pocetakVremena();
    inputDatoteke.addEventListener("change", provjeriDatoteku);


    tekst.addEventListener("blur", provjeriTekst);


    forma.addEventListener("submit", function(event){
    
    greske[0] = false;
    greske[1] = false;
    const inputDatVrijeme = document.getElementById("datvrijeme");

    let datumVrijeme = inputDatVrijeme.value;

    if(datumVrijeme == ""){
        greske[0] = true;
    }

    provjeriTekst();
    provjeriDatoteku();

    let datum = datumVrijeme.substring(0,11).split(".");

    datumVrijeme.split(" ");
    let vrijeme = datumVrijeme.substring(12).split(":");
    var neispravanFormat = datum[0] == null || datum[1] == null || datum[2] == null || datum[3] != "" || 
                           vrijeme[0] == null || vrijeme[1] == null || vrijeme[2] == null || vrijeme[3] != null || 
                           datum[0].length != 2 || datum[1].length != 2 || datum[2].length != 4 || 
                           vrijeme[0].length != 2 || vrijeme[1].length != 2 || vrijeme[2].length != 2;

    if(neispravanFormat){
        greske[0] = true;
    }

    var nevazeciDatum = parseInt(datum[0][0]) > 3 || parseInt(datum[0][0]) < 0 ||
                        parseInt(datum[0][1]) < 1 ||
                        parseInt(datum[1][0]) > 1 || parseInt(datum[1][0]) < 0 ||
                        parseInt(datum[1][1]) < 1 ||
                        parseInt(vrijeme[0][0]) < 0 || parseInt(vrijeme[0][0]) > 2 ||
                        parseInt(vrijeme[1][0]) < 0 || parseInt(vrijeme[1][0]) > 5 || 
                        parseInt(vrijeme[2][0]) < 0 || parseInt(vrijeme[2][0]) > 5;

    if(nevazeciDatum) {
        greske[1] = true;
    }

    if(greske.includes(true)){
        let povratnaInfo = "";
        if(greske[0] == true){
            povratnaInfo+= "Neispravan format datuma\n";
        }
        if(greske[1] == true){
            povratnaInfo+= "Nevažeći datum\n";
        }
        if(greske[2] == true){
            povratnaInfo+= "Opis prekratak\n";
        }
        if(greske[3] == true){
            povratnaInfo+= "Broj nedozvoljenih znakova u opisu: " + brojacGresakaUTekstu + "\n";
        }
        if(greske[4] == true){
            povratnaInfo+= "Dozvoljeni formati su: pdf, png, jpg, mp3 i mp4\n";
        }
        if(greske[5] == true){
            povratnaInfo+= "Veličina datoteke mora biti manja od 1 MB\n";
        }

        alert(povratnaInfo);

        let lblDatoteka, lblOpis, lblDatum;

        labels = document.getElementsByTagName('label');
        for(let s in labels){           
            for( var i = 0; i < labels.length; i++ ) {
                if (labels[i].htmlFor == "naziv")
                    lblDatoteka = labels[i];
                if(labels[i].htmlFor == "opis")
                    lblOpis = labels[i];
                if(labels[i].htmlFor == "datvrijeme")
                    lblDatum = labels[i];
            }
        }


        if(greske[0] == true || greske[1] == true){
            lblDatum.innerHTML = "*Datum i vrijeme: ";
            lblDatum.style.color = "red";
        }
        else{
            lblDatum.innerHTML = "Datum i vrijeme: ";
            lblDatum.style.color = "";
        }
        if(greske[2] == true || greske[3] == true){
            lblOpis.innerHTML = "*Opis: ";
            lblOpis.style.color = "red";
        }
        else {
            lblOpis.innerHTML = "Opis: ";
            lblOpis.style.color = "";
        }
        if(greske[4] == true || greske[5] == true){
            lblDatoteka.innerHTML = "*Naziv:";
            lblDatoteka.style.color = "red";
        }
        else {
            lblDatoteka.innerHTML = "Naziv: ";
            lblDatoteka.style.color = "";
        }

        event.preventDefault();
    }
    });

}

var minute = 0;
var sekunde = 0;

var ispis = "";
var timer;

function pocetakVremena() {
    if(minute == 10){
        minute = 0;
        sekunde = 0;
        osvjeziObrazac();
    }
    if(sekunde > 59){
        sekunde = 0;
        minute++;
    }
    if(minute<10){
        ispis = "0" + minute + ":";
    }
    else{
        ispis = minute + ":";
    }
    
    if(sekunde<10){
        ispis += "0" + sekunde;
    }
    else{
        ispis += sekunde;
    }
    document.getElementById("vrijeme").innerHTML = ispis;
    sekunde++;
    timer = setTimeout("pocetakVremena()", 1000);
}

function osvjeziObrazac(){
    document.getElementById("formaObrazac").reset();
}


function provjeriTekst() {
    const tekst = document.getElementById("opis");
    const unos = tekst.value;

    brojacGresakaUTekstu = 0;
    greske[2] = false;
    greske[3] = false;

    if(unos.length < 100 ) {
        greske[2] = true;
    }

    const nedopusteni = ["'", '"', '<', '>'];

    for (var i in unos) {
        if(nedopusteni.includes(unos[i])){
            brojacGresakaUTekstu++;
            greske[3] = true;
        }
    }
    

}


function provjeriDatoteku() {
    greske[4] = false;
    greske[5] = false;
    const inputDatoteke = document.getElementById("naziv");
    var naziv = inputDatoteke.value;
    var ekstenzija = naziv.substring(naziv.lastIndexOf('.')+1);
    var dopusteni_formati = ["pdf", "png", "jpg", "mp3", "mp4"];
    let velicina = inputDatoteke.files[0].size;
    velicina /= 1024*1024;
    if(!(dopusteni_formati.includes(ekstenzija))){
        greske[4] = true;
    }
    if(velicina>1){
        greske[5] = true;
    }
    /*if(dopusteni_formati.includes(ekstenzija) && velicina<1){
        
    }
    else{
        inputDatoteke.value = null;
    }*/
}

function promjenaOdabira() {
    const odabir = document.getElementById("kategorija");
    if(odabir.value == "MBTI" || odabir.value == "Hogwarts") {
        orijentacija = true;
    }
    else {
        orijentacija = false;
    }
    promijeniOrijentaciju();
}

function promijeniOrijentaciju() {
    const forma = document.getElementById("formaObrazac");
    if(orijentacija) {
        for(let i = 0; i < forma.length; i++) {
            
            forma[i].style.display = "cell";
            forma[i].style = "";
        }
        document.getElementsByClassName("obrazac_prikaza")[0].style.width = "95%";
    }
    else {
        for(let i = 0; i < forma.length; i++) {
            forma[i].style.display = "block";
            forma[i].style.margin = "5px auto";
        }
        document.getElementsByClassName("obrazac_prikaza")[0].style.width = "30%";
    }    
}

if(document['title'] == "Obrazac")
    document.addEventListener("DOMContentLoaded", ucitaj);


