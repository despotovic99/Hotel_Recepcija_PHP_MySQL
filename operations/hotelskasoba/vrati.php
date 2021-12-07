<?php

require_once "../../database/Baza.php";
require_once "../../model/HotelskaSoba.php";

$conn = Baza::getConnection();

if(isset($_POST['sifra']) && $_POST['sifra']!=""){
    $sifra = htmlspecialchars($_POST['sifra'],ENT_QUOTES);
    $odgovor = HotelskaSoba::vrati($conn,$sifra);

    echo json_encode($odgovor->fetch_assoc());
}