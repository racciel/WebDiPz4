<?php
include('./baza.class.php');
$b = new Baza();
$b->spojiDB();
$id = $_GET['id'];

$upit = "DELETE FROM dz4_korisnikprofil WHERE id = $id";
$odgovor = $b->selectDB($upit);
$upit = "DELETE FROM dz4_korisnikopci WHERE id = $id";
$odgovor = $b->selectDB($upit);

$b->zatvoriDB();
header('Location: ./popis.php');
?>