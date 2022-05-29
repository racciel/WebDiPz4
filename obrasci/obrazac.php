<?php
include('../baza.class.php');
include('../dnevnik.class.php');
session_start();

$dnevnik = new Dnevnik(); 
$putanja = dirname(getcwd());
$putanjaDnevnik = "$putanja/izvorne_datoteke/dnevnik.log";

if(isset($_SESSION['username'])) {
    $korisnik = $_SESSION['username'];

    $tekst = $korisnik." ".$_SESSION['tip']." ".$_SERVER['PHP_SELF'];
    $dnevnik->setNazivDatoteke($putanjaDnevnik);
    $dnevnik->spremiDnevnik($tekst);
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
    <title>Obrazac</title>
    <link rel="stylesheet" href="../css/aleja.css">
    <script src="../js/aleja.js" type="text/javascript"></script>
    
</head>
    <body id="tijelo">
        <header id="zaglavlje">
            <a href="../index.php"><img src="../materijali/foi-logo.jpg" alt="FOI logo" width="80" height="80"></a>
            <a href="#tijelo">
                
                <div class="naslov">
                    <h1>Obrazac</h1>
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
                    <a href="./prijava.php">
                        Prijava
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

            <div class="obrazac_prikaza">
            <div id="vrijeme">

            </div>
                <form method="post" id="formaObrazac" action="http://barka.foi.hr/WebDiP/2021/materijali/zadace/ispis_forme.php" novalidate>
                    <label for="korime">ID: </label><input type="number" name="korime" id="korime" value="1" disabled >
                    
                    <label for="naziv">Naziv: </label><input type="file" name="naziv" id="naziv" required>
                    <label for="kategorija">Kategorija: </label>
                    <input type="text" name="kategorija" id="kategorija" list="lista" required>
                    <datalist id="lista">
                        <option> MBTI</option>
                        <option> Enneagram</option>
                        <option> Hogwarts</option>
                        <option> DISC</option>
                    </datalist>
                    <label for="datvrijeme">Datum i vrijeme: </label>
                    <input type="text" name="datvrijeme" id="datvrijeme" required>
                    <label for="opis">Opis: </label>
                    <textarea name="opis" id="opis" placeholder="Unesite opis..." required></textarea>
                    <input type="hidden" value="1000000">
                    

                    <label>Boja teme: </label><input type="color">
                    <label>Alergije: </label>
                    <input type="checkbox" name="orplodovi" id="orplodovi" value="orasasti">
                    <label for="orplodovi">Orašasti plodovi</label>
                    <input type="checkbox" name="agrumi" id="agrumi" value="agrumi">
                    <label for="agrumi">Agrumi</label>
                    <input type="checkbox" name="laktoza" id="laktoza" value="laktoza">
                    <label for="laktoza">Laktoza</label>
                    <input type="checkbox" name="gluten" id="gluten" value="gluten">
                    <label for="gluten">Gluten</label>
                    <input type="button" name="gumb" value="BESKORISTAN GUMB">
                    <input type="reset" value="RESETIRAJ">


                    <input type="submit" value="POŠALJI">
                </form>
            </div>

        </main>
        
        <footer>
            <address>
                Godina izrade: 2022<br>
                Izradio: &copy; <a class="poveznica" href="mailto:aleja@foi.hr">Andreas Leja</a><br>
                <a href="https://validator.w3.org/nu/?doc=https%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2021%2Fzadaca_02%2Faleja%2Fobrasci%2Fobrazac.php">
                    <img src="../materijali/HTML5.png" alt="HTM5" height="60" width="60">
                </a>
                <a href="https://jigsaw.w3.org/css-validator/validator?uri=https%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2021%2Fzadaca_02%2Faleja%2Findex.php&profile=css3svg&usermedium=all&warning=1&vextwarning=&lang=en">
                    <img src="../materijali/CSS3.png" alt="HTM5" height="60" width="60">
                </a>
            </address>
        </footer>
    </body>
</html>
