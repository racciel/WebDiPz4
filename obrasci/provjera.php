<?php
$putanja = getcwd();
include('../baza.class.php');
$b = new Baza();
$b->spojiDB();
$id = $_GET['id'];

$upit = "SELECT * FROM dz4_korisnikprofil WHERE id = ".$id;
$odgovor = $b->selectDB($upit);
$red = $odgovor->fetch_array();

if($red['hashLozinke'] == hash('sha256', $_GET['loz'].$red['salt']) 
    && 
    $red['korisnickoIme'] == $_GET['user']) 
{
    echo(json_encode('t'));
}
else 
{
    echo(json_encode('f'));
}

$b->zatvoriDB();
?>