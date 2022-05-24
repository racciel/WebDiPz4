function ucitajMulimediju() {
    const pretraga = $("#trazi");
    $("#problem").hide();
    pretraga.on('keyup', prijedlog);
}


function prijedlog() {
    const pretraga = $("#trazi");
    const problemMsg = $("#problem");

    let izvor = [];

    $.ajax({
        type: "GET",
        url: "./json/search.json",
        contentType: "application/json",
        dataType: "json",
        success: function(odgovor){
            for(let i = 0; i<odgovor.length; i++){
                izvor.push(odgovor[i]);
            }
        },
        error: function(odgovor){
            console.log(odgovor);
        }
    });

    pretraga.autocomplete({
        source: izvor,
      });

    let svi = $("[title]");
    let pogodak = false;

    for(let i = 0; i < svi.length; i++){
        if(svi[i].title.toLowerCase().includes(pretraga.val().toLowerCase())) {
            svi[i].style = "display: block";
            pogodak = true;
        }
        else{
            svi[i].style = "display: none";
        }
    }

    if(!pogodak) {
        problemMsg.show();
    }
    else {
        problemMsg.hide();
    }
}

function ucitajPopis() {

    obrisiKolac('name');
    obrisiKolac('surname');
    obrisiKolac('password');
    obrisiKolac('email');    

    var trazi = "all";
    if(dohvatiDioKolacaKojiTrebas('id') == ""){
        $.ajax({
            url: "https://barka.foi.hr/WebDiP/2021/materijali/zadace/dz3/userNameSurname.php",
            data: trazi,
            dataType: "xml",
            success : function(data) {
                $(data).find('user').each(function (){
                    let id = this['id'];
                    let username = $(this).find('username').text();
                    let tip = $(this).attr('tip');
                    let status = $(this).attr('status');
                    let flogin = $(this).find('failed_login').text();
                    let blUntil = $(this).find('blocked_until').text();
                    
                    let ime = $(this).find('name').text();
                    let prezime = $(this).find('surname').text();
                    let lozinka = $(this).find('password').text();
                    let email = $(this).find('email').text();
                    let slika = $(this).find('image').text();
                    let kod = $(this).find('code').text();

                    flogin = provjeriIzraz(flogin);
                    blUntil = provjeriIzraz(blUntil);
                    kod = provjeriIzraz(kod);

                    polje = [username, ime, prezime, lozinka, email];
                    let dohvaceno = username + ";" + prezime;

                    let zapis = "<tr><td><a href='./obrasci/registracija.php?id="+id+"' onclick=odabraniId('"+username+"','"+ime+"','"+prezime+"','"+lozinka+"','"+email+"');>" + id + "</a></td>" +
                                "<td>" + username + "</td>" +
                                "<td>" + tip + "</td>" +
                                "<td>" + status + "</td>" +
                                "<td>" + flogin + "</td>" +
                                "<td><a href='#' id='"+id+"' onclick=odabraniDatumVrijeme('"+dohvaceno+"',"+id+")>" + blUntil + "</a></td>" +
                                "<td>" + ime + "</td>" +
                                "<td>" + prezime + "</td>" +
                                "<td>" + lozinka + "</td>" +
                                "<td>" + email + "</td>" +
                                "<td>" + slika + "</td>" +
                                "<td>" + kod + "</td></tr>"; 
    
                    $("#tijeloTablice").append(zapis);
                });
                doradiZaglavlje();
            },
            fail: function(){
                $("#tijeloTablice").append("<tr><td colspan='6'>Podatak ne postoji!</td></tr>");
                doradiZaglavlje();
            }
        });
    }
    else {
        alert("fail");
    } 
}

function provjeriIzraz(izraz) {
    if(izraz == ""){
        return "Podatak ne postoji!";
    }
    return izraz;
}


function doradiZaglavlje() {
    $("#glavaTablice").append("<th>ime</th><th>prezime</th><th>lozinka</th><th>email</th><th>slika</th><th>kod</th>");
    $('#tabla').DataTable();
}

function odabraniId(username, ime, prezime, password, email) {
    //document.cookie = 'id=' + polje[0];
    document.cookie = 'username=' + username;
    //document.cookie = 'tip=' + polje[2];
    //document.cookie = 'status=' + polje[3];
    //document.cookie = 'flogin=' + polje[4];
    //document.cookie = 'blockedUntil=' + polje[5];
    document.cookie = 'name=' + ime;
    document.cookie = 'surname=' + prezime;
    document.cookie = 'password=' + password;
    document.cookie = 'email=' + email;
    //document.cookie = 'image=' + polje[10];
    //document.cookie = 'code=' + polje[11];
}

function obrisiKolac(ime){
    document.cookie=ime+"="+dohvatiDioKolacaKojiTrebas(ime)+";max-age=0";
}

function dohvatiDioKolacaKojiTrebas(ime) {
    let kolacici = document.cookie;
    let polje = kolacici.split(";");
    let naziv;
    for(let i = 0; i < polje.length; i++){
        naziv = polje[i].split('=')[0];
        if(naziv[0] == ' '){
            naziv = naziv.substring(1);
        }
        if(ime == naziv){
            return polje[i].split("=")[1];
        }
    }
    return "";
}

function odabraniDatumVrijeme(dohvaceno, aidi) {
    let podatak = dohvaceno.split(";");

    let trazi = "username=" + podatak[0] + "&surname="+podatak[1];
    $.ajax({
        url: "https://barka.foi.hr/WebDiP/2021/materijali/zadace/dz3/userNameSurname.php",
        data: trazi,
        dataType: "xml",
        success : function(data) {
            console.log(data);
            $(data).find('users').each(function (){
                console.log(data);
                let found = $(this).find('found').text();
                let status = $(this).find('status').text();
                let code = $(this).find('code').text();
                let dateTime = Date.parse($(this).find('dateTime').text());
                let retultat = new Date(dateTime);
                
                let dani = 0;

                

                if(found != 0){
                    dani = prompt("Unesite X dana!");
                    dani = parseInt(dani);
                    retultat.setDate(retultat.getDate() + dani);

                    $("#"+aidi).html(retultat);
                    document.cookie = 'found=' + found;
                    document.cookie = 'status=' + status;
                    document.cookie = 'code=' + code;
                    document.cookie = 'dateTime=' + retultat;
                }    
            });
            
        }
    });
}

function provjeravanjeJasonDerulo() {
    let pogodak = false;
    if(dohvatiDioKolacaKojiTrebas('username') != "" && dohvatiDioKolacaKojiTrebas('email') != ""){
        $.ajax({
            type: "GET",
            url: "../json/users.json",
            contentType: "application/json",
            dataType: "json",
            success: function(odgovor){
                for(let i = 0; i<odgovor.length; i++){
                    
                    if(odgovor[i]['username'] == dohvatiDioKolacaKojiTrebas('username') && odgovor[i]['email'] == dohvatiDioKolacaKojiTrebas('email')){
                        console.log(odgovor[i]['password'] == $("#plozinka").val());
                        if($("#plozinka").val() == odgovor[i]['password']){
                            $("#imeiprezime").removeAttr("disabled");
                            $("#mail").removeAttr("disabled");
                            $("#korime").removeAttr("disabled");
                            $("#lozinka").removeAttr("disabled");
                        }
                        else {
                            $("#imeiprezime").attr("disabled", "disabled");
                            $("#mail").attr("disabled", "disabled");
                            $("#korime").attr("disabled", "disabled");
                            $("#lozinka").attr("disabled", "disabled");
                        }
                    }
                }
            }
        });
    }else {
        provjeriIspravnostUnosa();  
    }
}

var polja = [false, false, false, false, false, false];

function provjeriIspravnostUnosa() {
    let nejm = $("#imeiprezime");
    let dejt = $("#godinarod");
    let imejl = $("#mail");
    let krime = $("#korime");
    let loz = $("#lozinka");
    let ploz = $("#plozinka");

    let re = /^[a-zA-Z][a-zA-Z_]*[a-zA-z0-9_ ]{0,23}$/gm;

    polja[0] = nejm.val().match(re) == null || nejm.val() == "";
    polja[1] = dejt.val() == "";
    polja[2] = imejl.val() == "";
    polja[3] = krime.val().match(re) == null || krime.val() == "";


    // provjeri lozinku

    let reLoz = /^(?!.*(.)\1)(?=.*\d{2})(?=.*[A-Z]{2})(?=.*[a-z]{2})(?=.*\d{2})(?=.*[!#$%&? "_]{2}).{15,50}$/;
    polja[4] = loz.val().match(reLoz) == null || loz.val() == "";
    if(loz.val() !== ploz.val()){
        polja[5] = true;
    }
}



function ucitajRegu() {

    console.log($("#rega"));

    let nejm = $("#imeiprezime");
    let dejt = $("#godinarod");
    let imejl = $("#mail");
    let krime = $("#korime");
    let loz = $("#lozinka");
    let ploz = $("#plozinka");


    console.log(document.cookie);
    let izraz = dohvatiDioKolacaKojiTrebas('name') != "" && 
                dohvatiDioKolacaKojiTrebas('surname') != "" &&
                dohvatiDioKolacaKojiTrebas('username') != "" &&
                dohvatiDioKolacaKojiTrebas('password') != "" &&
                dohvatiDioKolacaKojiTrebas('email') != "";

    if(izraz) {

        $("#imeiprezime").val(dohvatiDioKolacaKojiTrebas('name') + " " + dohvatiDioKolacaKojiTrebas('surname')).attr("disabled", "disabled");
        $("#mail").val(dohvatiDioKolacaKojiTrebas('email')).attr("disabled", "disabled");
        $("#korime").val(dohvatiDioKolacaKojiTrebas('username')).attr("disabled", "disabled");
        $("#lozinka").val(dohvatiDioKolacaKojiTrebas('password')).attr("disabled", "disabled");
    }

    $("#plozinka").on('keyup', provjeravanjeJasonDerulo);


    $("#rega").submit(function(e) {
    
    polja = [false, false, false, false, false, false];
    provjeriIspravnostUnosa();  
    console.log(polja);
    if(polja.includes(true)){
        e.preventDefault();
        if(polja[0])
            nejm.css("background-color", "red");
        else
            nejm.css("background-color", "");
        if(polja[1])
            dejt.css("background-color", "red");
        else
            dejt.css("background-color", "");
        if(polja[2])
            imejl.css("background-color", "red");
        else
            imejl.css("background-color", "");
        if(polja[3])
            krime.css("background-color", "red");
        else
            krime.css("background-color", "");
        if(polja[5]){
            loz.css("background-color", "red");
            ploz.css("background-color", "red");
        }
        else {
            loz.css("background-color", "");
            ploz.css("background-color", "");
        }
        if(polja[4])
            loz.css("background-color", "red");
        else
            loz.css("background-color", "");
        
    }
    else{
        let imeprezime = $("#imeiprezime").val();
        let polja = imeprezime.split(" ");
        let trazi = "username=" + $("#korime").val() + "&surname=" + polja[1];
        $.ajax({
            url: "https://barka.foi.hr/WebDiP/2021/materijali/zadace/dz3/userNameSurname.php",
            data: trazi,
            dataType: "xml",
            success : function(data) {
                $(data).find('users').each(function (){
                    let found = $(this).find('found').text();
                    let status = $(this).find('status').text();
                    let code = $(this).find('code').text();
                    let dateTime = Date.parse($(this).find('dateTime').text());
                    if(found == 0){
                        document.cookie = 'name=' + polja[0];
                        document.cookie = 'surname=' + polja[1];
                        document.cookie = 'password=' + loz.val();
                        document.cookie = 'email=' + imejl.val();
                        document.cookie = 'it_type=3';
                        document.cookie = 'id_status=-1';
                        document.cookie = 'code=null';
                    }
                    else {
                        document.cookie = 'found=' + found;
                        document.cookie = 'status=' + status;
                        document.cookie = 'code=' + code;
                        document.cookie = 'dateTime=' + dateTime;
                    }  
                });
            }
        });
    }
    });
}

if(document['title'] == "Multimedija")
    document.addEventListener("DOMContentLoaded", ucitajMulimediju);

if(document['title'] == "Popis")
    document.addEventListener("DOMContentLoaded", ucitajPopis);

if(document['title'] == "Registracija")
    document.addEventListener("DOMContentLoaded", ucitajRegu);
    

    
