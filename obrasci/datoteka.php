<?php

include('../baza.class.php');

$b = new Baza();
$b->spojiDB();
$naziv = $_GET['naziv'];

$upit = "SELECT * FROM dz4_obrazac WHERE datoteka = '$naziv'";
$odgovor = $b->selectDB($upit);

if(mysqli_num_rows($odgovor) == 0) {
    echo($naziv);
}
else {
    $upit = "SEELCT MAX(id) FROM dz4_obrazac";
    $odgovor = $b->selectDB($upit);
    $red = $odgovor->fetch_array();
    $naziv = $naziv.($red['id']+1);
    echo($naziv);
}

$b->zatvoriDB();

?>