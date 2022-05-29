<?php
// Radi 4ai, 4aiii, 4bi,
$putanja = getcwd();
include('baza.class.php');
include('dnevnik.class.php');
session_start();

$dnevnik = new Dnevnik(); 

$putanjaDnevnik = "$putanja/izvorne_datoteke/dnevnik.log";

$korisnik = $_SESSION['username'];



$tekst = $korisnik." ".$_SESSION['tip']." ".$_SERVER['PHP_SELF'];
$dnevnik->setNazivDatoteke($putanjaDnevnik);
$dnevnik->spremiDnevnik($tekst);

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
    <title>Popis</title>
    <style>
        @media print {
            table {
                display: table;
            }
            th, .zadbnjired, header, footer {
                display: none !important;
            }
            
        }
    </style>
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>
    <body id="tijelo">
        <header id="zaglavlje">
            <a href="./index.php"><img src="./materijali/foi-logo.jpg" alt="FOI logo" width="80" height="80"></a>
            <a href="#tijelo">
                
                <div class="naslov">
                    <h1>Popis</h1>
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
                    <a href="./multimedija.php">
                        Multimedija
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

        <table id="tabla" class="display" style="width: auto; text-align: center;">
        <caption>Obrazac</caption>
        <thead>
        <tr id="glavaTablice">
                <th>id korisnika</th>
                <th>korisničko ime</th>
                <th>tip</th>
                <th>status</th>
                <th>neuspješne prijave</th>
                <th>datum i vrijeme blokiranja</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="tijeloTablice">
        <?php 
            $b = new Baza();
            $b->spojiDB();
            if($_SESSION['tip'] == 1) {
                $upit = "SELECT * FROM dz4_korisnikprofil";
                $odgovor = $b->selectDB($upit);
                if($odgovor) {
                    while($red = $odgovor->fetch_array()) {
                        $aidi = $red['ID'];
                        
                        echo "
                        <tr>
                            <td>
                                <a href='./obrasci/registracija.php?id=$aidi'>
                                    ".$red['ID']."
                                </a>
                            </td>
                            <td>
                                ".$red['korisnickoIme']."
                            </td>
                            <td>
                                ".$red['lozinka']."
                            </td>
                            <td>
                                ".$red['hashLozinke']."
                            </td>
                            <td>
                                ".$red['salt']."
                            </td>
                            <td>
                                ".$red['email']."
                            </td>
                            <td>
                                ".$red['aktiviran']."
                            </td>
                            <td>
                                ".$red['blokiran']."
                            </td>
                            <td>
                                ".$red['posljednjaPrijava']."
                            </td>
                            <td>
                                ".$red['kolacici']."
                            </td>
                            <td>
                                ".$red['brojpokusaja']."
                            </td>
                            <td>
                                ".$red['Uloga_ID']."
                            </td>
                            <td>
                                <a href='./obrisi_korisnika.php?id=$aidi'>
                                    Obriši
                                </a>
                            </td>
                        </tr>
                        ";
                    }
                }
            }
            else {
                $upit = "SELECT * FROM dz4_korisnikprofil WHERE id=".$_SESSION['id'];
                $odgovor = $b->selectDB($upit);
                if($odgovor) {
                    $red = $odgovor->fetch_array();
                    $aidi = $red['ID'];
                    echo "
                        <tr>
                            <td>
                                <a href='./obrasci/registracija.php?id=$aidi'>
                                    ".$red['ID']."
                                </a>
                            </td>
                            <td>
                                ".$red['korisnickoIme']."
                            </td>
                            <td>
                                ".$red['lozinka']."
                            </td>
                            <td>
                                ".$red['hashLozinke']."
                            </td>
                            <td>
                                ".$red['salt']."
                            </td>
                            <td>
                                ".$red['email']."
                            </td>
                            <td>
                                ".$red['aktiviran']."
                            </td>
                            <td>
                                ".$red['blokiran']."
                            </td>
                            <td>
                                ".$red['posljednjaPrijava']."
                            </td>
                            <td>
                                ".$red['kolacici']."
                            </td>
                            <td>
                                ".$red['brojpokusaja']."
                            </td>
                            <td>
                                ".$red['Uloga_ID']."
                            </td>
                        </tr>
                        ";
                }
            }
            ?>
        </tbody>
        
    </table>
        
    <?php 
        if($_SESSION['tip'] == 1) {
            echo "
            <table>
            <caption>Dnevnik</caption>
            <thead>
                <tr>
                    <th>Korisnk</th>
                    <th>Uloga</th>
                    <th>Apsolutna putanja skritpe</th>
                    <th>Datum i vremena pristupa</th>
                </tr>
            </thead>
            ";            

            $niz = $dnevnik->citajDnevnik();
            
            foreach($niz as $k=>$v){
                $zapis = explode(" ", $v);
                echo("<tr><td>".$zapis[2]."</td><td>".$zapis[3]."</td><td>".$zapis[4]."</td><td>".$zapis[0]." ".$zapis[1]."</td></tr>");
            }

            echo "
            </table>
            ";
            

        }
    
    ?>
                   
    </main>
    <footer>
        <address>
            Godina izrade: 2022<br>
            Izradio: &copy; <a class="poveznica" href="mailto:aleja@foi.hr">Andreas Leja</a><br>
            <a href="https://validator.w3.org/nu/?doc=https%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2021%2Fzadaca_02%2Faleja%2Fpopis.php">
                <img src="./materijali/HTML5.png" alt="HTM5" height="60" width="60">
            </a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=https%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2021%2Fzadaca_02%2Faleja%2Findex.php&profile=css3svg&usermedium=all&warning=1&vextwarning=&lang=en">
                <img src="./materijali/CSS3.png" alt="HTM5" height="60" width="60">
            </a>
        </address>
    </footer>
</body>
</html>
