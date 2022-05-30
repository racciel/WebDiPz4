<?php

include('../baza.class.php');

$b = new Baza();
$b->spojiDB();
$naziv = $_GET['naziv'];

$upit = "SELECT * FROM dz4_obrazac WHERE datoteka = '$naziv'";
$odgovor = $b->selectDB($upit);

if(mysqli_num_rows($odgovor) == 0) {
    echo('t');
}
else {
    echo('f');
}

$b->zatvoriDB();

?>