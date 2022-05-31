<?php 
session_start();
include "baza.class.php";
include "dnevnik.class.php";
$putanja = getcwd();

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
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Kreirano: 26. ožujka 2022.">
    <meta name="keywords" content="HTML, CSS, zadaća">
    <meta name="author" content="Andreas Leja">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/aleja.css">
    <title>Multimedija</title>
    <style>
        
        body{
                display: grid;
                grid-template-areas: 
                    'zagl zagl zagl'
                    'meni meni meni'
                    'sadr sadr sadr'
                    'podn podn podn';
            }
            a[href="#tijelo"] {
                position: inherit;
            }

            a[href="#zaglavlje"] {
                position: inherit;;
            }
            
            header {
                grid-area: zagl;
            }
            
            nav {
                grid-area: meni;
                width: 100%;
                height: auto;
                display: none;
                position: inherit;
                border: 0;
                background-color: gray;
                margin: 0 auto;
                padding: 0;
            }

            nav ul {
                margin: 0 auto;
            }

            nav ul li {
                width: inherit;
                margin: 0 auto;
                display: inline-block;
                border: 0;
                width: 15%;
                text-align: center;
            }

            nav ul li a {
                width: 100%;
                border: 0;
                margin: 0 auto;
                padding: 8%;
                text-align: center;
            }
            
            main {
                grid-area: sadr;
            }
            
            iframe, video {
                border: 0;
            }

            footer {
                grid-area: podn;
                z-index: inherit;
            }
        
    </style>
    </head>
    <body id="tijelo">
        <header id="zaglavlje">
            
            <a href="./index.php"><img src="./materijali/foi-logo.jpg" alt="FOI logo" width="80" height="80"></a>
            <a href="#tijelo">
                
                <div class="naslov">
                    <h1>Multimedija</h1>
                </div>
                
            </a>
            
            <a href="#zaglavlje">
                <img src="./materijali/menu.png" alt="Menu icon" width="60" height="60">
            </a>
            
        </header>
        
        <nav>
            <ul>
                <li>
                    <a href="./index.php">
                        Početna stranica
                    </a>
                </li>
                <li>
                    <a href="./popis.php">
                        Popis
                    </a>
                </li>
                <li>
                    <a href="./obrasci/obrazac.php">
                        Obrazac
                    </a>
                </li>
                <li>
                    <a href="./obrasci/prijava.php">
                        Prijava
                    </a>
                </li>
                <li>
                    <a href="./obrasci/registracija.php">
                        Registracija
                    </a>
                </li>
                <li>
                    <a href="./era.php#tijelo">
                        ERA
                    </a>
                </li>
                <li>
                    <a href="./navigacijski.php#tijelo">
                        Navigacijski
                    </a>
                </li>
            </ul>
        </nav>
        
        <main>
        <table>
            <caption>
                Datoteke
            </caption>
            <thead>
                <th>
                    id
                </th>
                <th>
                    naziv
                </th>
                <th>
                    kategorija
                </th>
                <th>
                    datum i vrijeme
                </th>
                <th>
                    opis
                </th>
                <th>
                    boja
                </th>
                <th>
                    orašasti plodovi
                </th>
                <th>
                    agrumi
                </th>
                <th>
                    laktoza
                </th>
                <th>
                    gluten
                </th>
            </thead>
            <tbody>
        <?php 
            $upit = "SELECT DISTINCT * FROM dz4_obrazac ORDER BY ekstenzija ASC";
            $odgovor = $b->selectDB($upit);
            if($odgovor) {
                while($red = $odgovor->fetch_array()) {
                    echo 
                    "<tr>
                        <td>".$red['id']."</td>
                        <td>".$red['datoteka']."</td>
                        <td>".$red['kategorija']."</td>
                        <td>".$red['datumVrijeme']."</td>
                        <td>".$red['opis']."</td>
                        <td>".$red['boja']."</td>
                        <td>".$red['orasasti']."</td>
                        <td>".$red['agrumi']."</td>
                        <td>".$red['laktoza']."</td>
                        <td>".$red['gluten']."</td>
                    </tr>
                    ";
                }
            }
        ?>    
            </tbody>
        </table>
            <!--
            <div class="obrazac_multimedije">
                <form method="get" action=" http://barka.foi.hr/WebDiP/2021/materijali/zadace/ispis_forme.php">
                    <label for="trazi">Pretraži: </label><input type="search" name="trazi" id="trazi"> <input type="submit" value="TRAŽI">
                </form>
            </div>

            <div id="problem">
                Nema podataka
            </div>

            <div title="INFJ Personality Type Explained | What are the Cognitive Transitions of an INFJ? | CS Joseph">
                <h1>Tko su INFJ?</h1>
                <iframe style="width: 100%; height: 800px;" src="https://www.youtube.com/embed/_wRJ6eNMdGg?autoplay=1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    
            </div>
            
            <div title="Enneagram Type 5 Overview (The Investigator)">
                <h1>Enneagram 5</h1>
                <iframe width="600" height="400" src="https://www.youtube.com/embed/UwTHLDhVs7g" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

            <div title="Ljudi hodaju">
                <h1>Ljudi hodaju</h1>
                <video src="https://player.vimeo.com/external/376569539.sd.mp4?s=e19b04783a46faed5b1ec944745ddaa6f4de0440&amp;profile_id=139&amp;oauth2_token_id=57447761" controls></video>
    
            </div>

            <div title="Bordo crvena torbica">
                <h1>Bordo crvena torbica</h1>
            <video src="https://player.vimeo.com/external/646037776.sd.mp4?s=5721dcf4c0c0731999db179c86deb0ea7a1d6110&amp;profile_id=164&amp;oauth_token_id=57447761" controls></video>
            </div>

            <div title="Silazak niz stepenice">
                <h1>Silazak niz stepenice</h1>
            <video src="https://player.vimeo.com/external/469637517.sd.mp4?s=ef46b081d71437c476f9fb09c2c2ce8328835147&amp;profile_id=165&amp;oauth2_token_id=57447761" controls></video>
            </div>

            <div title="Ambulanta">
                <h1>Ambulanta</h1>
                <audio src="./materijali/amb.mp3" controls></audio>
            </div>

            <div title="Automobil prolazi">
                <h1>Automobil prolazi</h1>
                <audio src="./materijali/BMW+DRIVEBY.mp3" controls></audio>
            </div>
            
            <div title="Jezivo smijuljenje">
                <h1>Jezivo smijuljenje</h1>
                <audio src="./materijali/lach01.mp3" controls></audio>
            </div>
            
            <div title="Lemur">
                <h1>Lemur</h1>
                <audio src="./materijali/lemur.mp3" controls></audio>
            </div>
                -->
                       
        </main>
        <footer>
            <address>
                Godina izrade: 2022<br>
                Izradio: &copy; <a class="poveznica" href="mailto:aleja@foi.hr">Andreas Leja</a><br>
                <a href="https://validator.w3.org/nu/?doc=https%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2021%2Fzadaca_02%2Faleja%2Fmultimedija.php">
                    <img src="./materijali/HTML5.png" alt="HTM5" height="60" width="60">
                </a>
                <a href="https://jigsaw.w3.org/css-validator/validator?uri=https%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2021%2Fzadaca_02%2Faleja%2Findex.php&profile=css3svg&usermedium=all&warning=1&vextwarning=&lang=en">
                    <img src="./materijali/CSS3.png" alt="HTM5" height="60" width="60">
                </a>
            </address>
        </footer>
    </body>
</html>
