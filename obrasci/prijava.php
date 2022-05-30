<?php
// Radi: 3a, 3b, 3ci, 3cii
$putanja = dirname(getcwd());
include('../baza.class.php');
include('../dnevnik.class.php');
session_start();

$dnevnik = new Dnevnik(); 

$putanjaDnevnik = "$putanja/izvorne_datoteke/dnevnik.log";
$b = new Baza();
$b->spojiDB();
if(isset($_SESSION['username'])){
    $korisnik = $_SESSION['username'];
    $uloga = $_SESSION['tip'];
    $putanja = $_SERVER['PHP_SELF'];

    $tekst = $korisnik." ".$uloga." ".$putanja;
    
    $upit = "INSERT INTO dz4_dnevnik VALUES(default, '$korisnik', $uloga, '$putanja', NOW())";

    $b->updateDB($upit);

    $dnevnik->setNazivDatoteke($putanjaDnevnik);
    $dnevnik->spremiDnevnik($tekst);    
}


$b = new Baza();
$b->spojiDB();

if(!isset($_SERVER['HTTPS']) || $_SERVER["HTTPS"] != "on") {
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
    exit;
}

if(isset($_GET['remember']) && $_GET['remember'] == 'yes') {
    setcookie("korisnik", $_GET['korime'], false, "/", false);
}
else {
    setcookie("korisnik", "", time() - 3600, "/", false);
}

if(isset($_GET['gumbSubmit'])) {
    
    $korime = $_GET['korime'];
    
    $lozinka = $_GET['lozinka'];    

     echo 
     "<script>
        var xhr = new XMLHttpRequest();
        var url = './prijava_.php?username=$korime&password=$lozinka';
        
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var odgovor = this.responseText;
                if(odgovor != '')
                    alert(odgovor);
            }
        }
        xhr.open('GET', url, true);
        xhr.send();
        </script>";
}

if(isset($_SESSION['tip'])) {
    setcookie("korisnik", $korime, false, "/", false);
    setcookie("tip", $_SESSION['tip'], false, "/", false);

    header("Location: ./../index.php");
}
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
    <title>Prijava</title>
</head>
    <body id="tijelo">
        <header id="zaglavlje">
            <a href="../index.php"><img src="../materijali/foi-logo.jpg" alt="FOI logo" width="80" height="80"></a>
            <a href="#tijelo">
                
                <div class="naslov">
                    <h1>Prijava</h1>
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
                    <a href="./registracija.php">
                        Registracija
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

            <div class="obrazac_prijave">
                <form method="get" action="prijava.php" novalidate>
                    <label for="korime">Korisničko ime: </label><input type="text" name="korime" id="korime" maxlength="25" required><br><br>
                    <label for="lozinka">Lozinka: </label><input type="password" name="lozinka" id="lozinka" maxlength="50" required><br><br>
                    <label>Zapamti me: </label>
                    <input type="radio" name="remember" id="da" value="yes"><label for="da">Da</label> 
                    <input type="radio" name="remember" id="ne" value="no" checked><label for="ne">Ne</label><br><br>
                    <a href="../index.php">Zaboravljena lozinka?</a><br><br>
                    <input type="submit" name="gumbSubmit" value="POŠALJI">
                </form>
            </div>
            <div>
                <?php 
                    $upit = "SELECT * FROM korisnikprofil WHERE uloga_id = 1 LIMIT 1;";
                    $odgovor = $b->selectDB($upit);
                    if($odgovor){
                        $red = $odgovor->fetch_array();
                        $korisnicko = $red['korisnickoIme'];
                        $loz = $red['lozinka'];
                        echo "<b>Administrator:</b> <br>Korisničko ime: $korisnicko <br> Lozinka: $loz <br><br>";
                    }

                    $upit = "SELECT * FROM korisnikprofil WHERE uloga_id = 2 LIMIT 1;";
                    $odgovor = $b->selectDB($upit);
                    if($odgovor){
                        $red = $odgovor->fetch_array();
                        $korisnicko = $red['korisnickoIme'];
                        $loz = $red['lozinka'];
                        echo "<b>Moderator:</b> <br>Korisničko ime: $korisnicko <br> Lozinka: $loz <br><br>";
                    }

                    $upit = "SELECT * FROM korisnikprofil WHERE uloga_id = 3 LIMIT 1;";
                    $odgovor = $b->selectDB($upit);
                    if($odgovor){
                        $red = $odgovor->fetch_array();
                        $korisnicko = $red['korisnickoIme'];
                        $loz = $red['lozinka'];
                        echo "<b>Korisnik:</b> <br>Korisničko ime: $korisnicko <br> Lozinka: $loz <br><br>";
                    }
                ?>
            </div>
        </main>
        
        <footer>
            <address>
                Godina izrade: 2022<br>
                Izradio: &copy; <a class="poveznica" href="mailto:aleja@foi.hr">Andreas Leja</a><br>
                <a href="https://validator.w3.org/nu/?doc=https%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2021%2Fzadaca_02%2Faleja%2Fobrasci%2Fprijava.php">
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
    $b->zatvoriDB();
?>