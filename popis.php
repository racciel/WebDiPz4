<?php
// Radi 4ai,
include('baza.class.php');
include('dnevnik.class.php');
session_start();
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
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="./js/aleja_jquery.js" type="text/javascript"></script>
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
                            <a href='obrisi_korisnika?id=$aidi'>
                                Obriši
                            </a>
                        </td>
                    </tr>
                    ";
                }
            }
            ?>
        </tbody>
        
    </table>
        
                   
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
