<?php

// dirname() -- naddirektorij

// trenutačna putanja pa oduzmi trenutačni direktorij

$putanja=dirname(getcwd());

include "../zaglavlje.php";

var_dump($_GET);
if(isset($_GET['gumbSubmit'])){
    $uzorak="/^[^\s]+$/";
    $greska = "";
    foreach($_GET as $name=>$v){
        // empty jel isset ili prazno provjera
        if(empty($v)){
            $greska.="Niste popunili: ".$name."<br>";
        }
    }
    
    $korime = $_GET['korime'];
    
    if(!preg_match($uzorak, $_GET['korime'])){
        $greska.="Korisničko ime sadrži razmak!: ".$korime."<br>";
    }
    
    $lozinka = $_GET['lozinka'];
    
    if(empty($greska)){
       $veza = new Baza();
       $veza->spojiDB();
       
       $upit = "SELECT * FROM KorisnikProfil WHERE korisnickoIme ='".$korime."' AND lozinka ='".$lozinka."';";
       
       $rezultat = $veza->selectDB($upit);
       if($rezultat!=null){
           while($red = mysqli_fetch_array($rezultat)){
               if($red){
                   $tip = $red['Uloga_ID'];
               }
           }
       }
       
    }
     if(isset($tip)){
         setcookie("korisnik", $korime, false, "/", false);
         setcookie("tip", $tip, false, "/", false);
         //preusmjeravanje
         header("Location: ../index.php");
         exit;
     }
    
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
            <div id="greske">
                <?php
                echo $greska;
                ?>
            </div>
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
