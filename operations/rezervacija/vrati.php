<?php

require_once "../../database/Baza.php";
require_once "../../model/Rezervacija.php";

$conn = Baza::getConnection();

if(isset($_POST['sifra']) && $_POST['sifra']!=""){
    $sifra = htmlspecialchars($_POST['sifra'],ENT_QUOTES);
    $odgovor = Rezervacija::vrati($conn,$sifra);

    echo json_encode($odgovor->fetch_assoc());
}