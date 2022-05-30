<?php

include('../baza.class.php');

$b = new Baza();
$b->spojiDB();
$korime = $_GET['username'];
$lozinka = $_GET['password'];

$upit = "SELECT * FROM dz4_korisnikprofil WHERE korisnickoIme = '$korime'";
$odgovor = $b->selectDB($upit);

if($odgovor) {
    if($red = $odgovor->fetch_array()) {
        $aidi = $red['ID'];
        if($red['lozinka'] == $lozinka && $red['blokiran'] != true) {
            $apdejt = "UPDATE dz4_korisnikprofil SET brojpokusaja = 5 WHERE id = $aidi";
            $b->updateDB($apdejt);

            session_start();
            
            $_SESSION['id'] = $red['ID'];
            $_SESSION['username'] = $red['korisnickoIme'];
            $_SESSION['tip'] = $red['Uloga_ID'];
        }
        else {
            $brojpokusaja = (int)$red['brojpokusaja']-1;
            if($brojpokusaja != 0) {
                echo "Pogrešno korisničko ime i/ili lozinka. Preostali broj pokusaja je $brojpokusaja";
                $apdejt = "UPDATE dz4_korisnikprofil SET brojpokusaja = $brojpokusaja WHERE id = $aidi";
                $b->updateDB($apdejt);
            }
            else {
                
                $apdejt = "UPDATE dz4_korisnikprofil SET brojpokusaja = $brojpokusaja, blokiran = 1 WHERE id = $aidi";
                $b->updateDB($apdejt);
                echo "Račun blokiran!";
            }
        }
    }
}
else {
    echo('Ne postoji korisnik s tim korisničkim imenom');
}

header('Content-Type: text/xml');
/*if($odgovor) {
    echo('t');
}
else {
    echo('f');
}*/

$b->zatvoriDB();

?>