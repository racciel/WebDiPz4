<?php

// Radi 5a, pola 5b, 5d
include('../baza.class.php');
include('../dnevnik.class.php');
session_start();
ob_start();

$dnevnik = new Dnevnik(); 
$putanja = dirname(getcwd());
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
    <style>
        form>* {
            display: cell;
        }
        .obrazac_prikaza {
            width: 95%;
        }
    </style>    
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
                <form method="GET" id="formaObrazac" action="./obrazac.php" novalidate>
                    <label>Orijentacija</label>
                    <select name="orijentacija">
                        <option value = 0>
                            Odaberi
                        </option>
                        <option value = 1>
                            Vodoravno
                        </option>
                        <option value = 2>
                            Okomito
                        </option>
                    </select>
                    
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
                    

                    <label>Boja teme: </label><input type="color" name="boja">
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
                    <input type="hidden" name="salji" value="da">

                    <input type="submit" value="POŠALJI">
                </form>

                <?php
                if(isset($_GET['salji']))
                {
                if(!empty($_GET['orijentacija']) &&
                    !empty($_GET['korime']) &&
                    !empty($_GET['naziv']) &&
                    !empty($_GET['kategorija']) &&
                    !empty($_GET['datvrijeme']) &&
                    !empty($_GET['opis']) &&
                    !empty($_GET['naziv'])
                )
                {
                    $sveoke = true;
                }
                else {
                    $sveoke = false;
                    echo
                    "
                    <script>
                        alert('Sva polja moraju biti popunjena!');
                    </script>
                    ";
                }




                if($_GET['orijentacija'] != 0) {
                    $sveoke = true;
                    echo "<style>";
                    if($_GET['orijentacija'] == 2 || $_COOKIE['orijentacija'] == 2) {
                        echo "form>*{
                            display: block;
                        }
                        .obrazac_prikaza {
                            width: 30%;
                        }
                        ";
                    }
                    echo "</style>";
                }
                else {
                    $sveoke = false;
                    echo
                    "
                    <script>
                        alert('Morate odabrati orijentaciju!');
                    </script>
                    ";
                }
                
                if(!empty($_GET['naziv'])){
                $naziv = $_GET['naziv'];
                $provjera = explode(".", $naziv);
                $dozvoljeni = array("pdf", "png", "jpg", "mp3", "mp4");
                if(!in_array($provjera[count($provjera)-1], $dozvoljeni)) {
                    $sveoke = false;
                    echo 
                    "
                    <script>
                        alert('Pogresna ekstenzija');
                    </script>
                    ";
                }
                else {
                    echo
                    "
                    <script>
                    var xhr = new XMLHttpRequest();
                    var url = './datoteka.php?naziv=$naziv;
                    
                    xhr.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            console.log(this.responseText);
                            var odgovor = JSON.parse(this.responseText);
                            if(odgovor == 't'){
                                
                            }
                            else {
                                
                            }

                        }
                    </script>
                    ";
                }
            }

            if($sveoke) {
                $datoteka = $_GET['naziv'];
                $kategorija = $_GET['kategorija'];
                $datumVrijeme = $_GET['datvrijeme'];
                $opis = $_GET['opis'];
                $boja = $_GET['boja'];
                $orasasti = NULL;
                $agrumi = NULL;
                $laktoza = NULL;
                $gluten = NULL;

                if(isset($_GET['orasasti']))
                    $orasasti = 1;
                if(isset($_GET['agrumi']))
                    $agrumi = 1;
                if(isset($_GET['laktoza']))
                    $laktoza = 1;  
                if(isset($_GET['gluten']))
                    $gluten = 1;
                
                $b = new Baza();
                $b->spojiDB();

                $preslozeno = $datumVrijeme[6].$datumVrijeme[7].$datumVrijeme[8].$datumVrijeme[9]."-".$datumVrijeme[0].$datumVrijeme[1]."-".$datumVrijeme[3].$datumVrijeme[4]." ".$datumVrijeme[12].$datumVrijeme[13].":".$datumVrijeme[14].$datumVrijeme[15].":".$datumVrijeme[16].$datumVrijeme[17];

                $upit = "INSERT INTO dz4_obrazac VALUES(default, '$datoteka', '$kategorija', '$preslozeno', '$opis', '$boja', '$orasasti', '$agrumi', '$laktoza', '$gluten');";
                $odgovor = $b->updateDB($upit);
                if($odgovor) {
                    header('Location: ../multimedija.php');
                }

                $b->zatvoriDB();
            }

            }
                
                ?>
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
