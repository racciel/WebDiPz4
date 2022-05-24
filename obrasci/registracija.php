<?php
$putanja = getcwd();
include('../baza.class.php');
include('../dnevnik.class.php');
$b = new Baza();
$b->spojiDB();
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Kreirano: 26. ožujka 2022.">
    <meta name="keywords" content="HTML, CSS, zadaća">
    <meta name="author" content="Andreas Leja">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/aleja.css">
    <title>Registracija</title>
</head>
    <body id="tijelo">
        <header id="zaglavlje">
            <a href="../index.php"><img src="../materijali/foi-logo.jpg" alt="FOI logo" width="80" height="80"></a>
            <a href="#tijelo">
                
                <div class="naslov">
                    <h1>Registracija</h1>
                </div>
                
            </a>

            <a href="#zaglavlje">
                <img src="../materijali/menu.png" alt="Menu icon" width="60" height="60">
            </a>
            
        </header>

        <nav>
            <ul>
                <li>
                    <a href="../index.php">
                        Početna stranica
                    </a>
                </li>
                <li>
                    <a href="../multimedija.php">
                        Multimedija
                    </a>
                </li>
                <li>
                    <a href="../popis.php">
                        Popis
                    </a>
                </li>
                <li>
                    <a href="./obrazac.php">
                        Obrazac
                    </a>
                </li>
                <li>
                    <a href="./prijava.php">
                        Prijava
                    </a>
                </li>
                <li>
                    <a href="../era.php#tijelo">
                        ERA
                    </a>
                </li>
                <li>
                    <a href="../navigacijski.php#tijelo">
                        Navigacijski
                    </a>
                </li>
            </ul>
        </nav>
        
        <main>
            <div class="obrazac_registracije">
                <form method="get" action="registracija.php" id="rega" novalidate>
                    <label for="imeiprezime">Ime i prezime: </label>
                    <input type="text" id="imeiprezime" name="imeiprezime" autofocus required><br><br>
                    <label for="godinarod">Godina rođenja: </label>
                    <input type="text" id="godinarod" name="godinarod" required><br><br>
                    <label for="mail">E-mail: </label>
                    <input type="email" placeholder="ldap@foi.hr" id="mail" name="mail" required><br><br>
                    <label for="korime">Korisničko ime: </label>
                    <input type="text" id="korime" name="korime" maxlength="25" required><br><br>
                    <label for="lozinka">Lozinka: </label>
                    <input type="password" id="lozinka" name="lozinka" maxlength="50" required><br><br>
                    <label for="plozinka">Potvrda lozinke: </label>
                    <input type="password" id="plozinka" name="plozinka" maxlength="50" required><br><br>
                    <label for="kolacici">Kolačići: </label>
                    <select name="kolacici" id="kolacici">
                        <option value="0">nužni</option>
                        <option value="1">marketinški</option>
                        <option value="2">analitički</option>
                    </select><br><br>
                </form>
                <input type="submit" form="rega" value="POŠALJI">
            </div>
        </main>
        
        <footer>
            <address>
                Godina izrade: 2022<br>
                Izradio: &copy; <a class="poveznica" href="mailto:aleja@foi.hr">Andreas Leja</a><br>
                <a href="https://validator.w3.org/nu/?doc=https%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2021%2Fzadaca_02%2Faleja%2Fobrasci%2Fregistracija.php">
                    <img src="../materijali/HTML5.png" alt="HTM5" height="60" width="60">
                </a>
                <a href="https://jigsaw.w3.org/css-validator/validator?uri=https%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2021%2Fzadaca_02%2Faleja%2Findex.php&profile=css3svg&usermedium=all&warning=1&vextwarning=&lang=en">
                    <img src="../materijali/CSS3.png" alt="HTM5" height="60" width="60">
                </a>
            </address>
        </footer>
    </body>
</html>
<?php
if(!isset($_GET['id'])) {
    
    if(isset($_GET['korime'])) {
    
        $imeiprezime = $_GET['imeiprezime'];
        $godinarodenja = $_GET['godinarod'];
        $mail = $_GET['mail'];
        $korime = $_GET['korime'];
        $lozinka = $_GET['lozinka'];
        $plozinka = $_GET['plozinka'];
        $kolacici = $_GET['kolacici'];

        $losidatum = array(
            false, false,  // DD
            false,         // .
            false, false,  // MM
            false,         // .
            false, false, false, false, // GGGG
            false          // .
    );

        $varijanta = strlen($godinarodenja);

        if(strlen($godinarodenja) !== 11)
            $losidatum = [true];

        if((int)$godinarodenja[0] > 3)
            $losidatum[0] = true;
        if(!is_numeric((int)$godinarodenja[1]))
            $losidatum[1] = true;
        if($godinarodenja[2] !== ".")
            $losidatum[2] = true;
        if((int)$godinarodenja[3] > 1)
            $losidatum[3] = true;
        if(!is_numeric((int)$godinarodenja[4]))
            $losidatum[4] = true;
        if($godinarodenja[5] !== ".")
            $losidatum[5] = true;
        if(!is_numeric((int)$godinarodenja[6]))
            $losidatum[6] = true;
        if(!is_numeric((int)$godinarodenja[7]))
            $losidatum[7] = true;
        if(!is_numeric((int)$godinarodenja[8]))
            $losidatum[8] = true;
        if(!is_numeric((int)$godinarodenja[9]))
            $losidatum[9] = true;
        if($godinarodenja[10] !== ".")
            $losidatum[10] = true;

        if(in_array(true, $losidatum))
            echo '
            <script>
                alert("Krivi datum");
            </script>
            ';

        $query = "SELECT * FROM korisnikprofil WHERE korisnickoIme like'$korime'";

        $rezultat = $b->selectDB($query);
        echo "<script>";
        echo 'let polje = document.getElementById("rega");';
        echo 'let polje2 = document.getElementsByTagName("label");';
        if($rezultat){
            if($rezultat->fetch_array()){
                echo'
                for(let i = 0; i < polje.length-1 ; i++) {
                    polje[i].style.border = "4px solid red";
                }
                for(let i in polje2){
                    polje2[i].style.color = "red";
                }
                ';
            }
            else {
                echo'
                for(let i = 0; i < polje.length-1 ; i++) {
                    polje[i].style.border = "4px solid green";
                }
                for(let i in polje2){
                    polje2[i].style.color = "green";
                }
                ';
            } 
        }
        echo "</script>";

        $b->zatvoriDB();
    }
}
else {

    $upit = "SELECT * FROM korisnikprofil JOIN korisnikopci ON korisnikopci.id = korisnikprofil.id WHERE korisnikopci.id =".$_GET['id'];

    $odgovor = $b->selectDB($upit);

    if($odgovor) {
        while($red = $odgovor->fetch_array()){
            $imeiprezime = $red['ime']." ".$red['prezime'];
            $godinarod = $red['datumRodenja'];
            $mail = $red['email'];
            //$kolacici = $red['kolacici'];
        }
    }

    
    //document.getElementById('kolacici').value = $kolacici;

    echo "
        <script>
            alert('$imeiprezime' + ' ' + '$godinarod' + ' ' + '$mail');
            document.getElementById('imeiprezime').value = '$imeiprezime';
            document.getElementById('godinarod').value = '$godinarod';
            document.getElementById('mail').value = '$mail';
            
            
            function provjeriIspravnost() {
                var xhr = new XMLHttpRequest();
                var url = 'provjera.php';
                xhr.open('GET', url, true);
    
                xhr.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                        var odgovor = this.responseText;
                    }
                }
            
            }

            document.getElementById('korime').addEventListener('blur', provjeriIspravnost);
            document.getElementById('lozinka').addEventListener('blur', provjeriIspravnost);

        </script>
    ";
}

?>