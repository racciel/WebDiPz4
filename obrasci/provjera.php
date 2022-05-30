<?php
$putanja = getcwd();
include('../baza.class.php');
session_start();

$b = new Baza();
$b->spojiDB();
$id = $_GET['id'];

$upit = "SELECT * FROM dz4_korisnikprofil WHERE ID = $id";
$odgovor = $b->selectDB($upit);
$red = $odgovor->fetch_array();

if($red['lozinka'] == $_GET['loz'] 
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