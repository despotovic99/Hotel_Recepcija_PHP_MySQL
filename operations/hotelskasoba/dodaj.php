<?php

require_once "../../database/Baza.php";
require_once "../../model/HotelskaSoba.php";

$conn = Baza::getConnection();

if(isset($_POST['broj']) && $_POST['broj']!="" &&
    isset($_POST['sprat']) && $_POST['sprat']!="" &&
    isset($_POST['brojKreveta']) && $_POST['brojKreveta']!="" &&
    isset($_POST['kuhinja']) && $_POST['kuhinja']!="" &&
    isset($_POST['terasa']) && $_POST['terasa']!="" &&
    isset($_POST['minibar']) && $_POST['minibar']!="" &&
    isset($_POST['sifraHotela']) && $_POST['sifraHotela']!=""){


    $broj = htmlspecialchars($_POST['broj'],ENT_QUOTES);
    $sprat = htmlspecialchars($_POST['sprat'],ENT_QUOTES);
    $brojKreveta = htmlspecialchars($_POST['brojKreveta'],ENT_QUOTES);
    $kuhinja = htmlspecialchars($_POST['kuhinja'],ENT_QUOTES);
    $terasa = htmlspecialchars($_POST['terasa'],ENT_QUOTES);
    $minibar = htmlspecialchars($_POST['minibar'],ENT_QUOTES);
    $sifraHotela = htmlspecialchars($_POST['sifraHotela'],ENT_QUOTES);



    if(HotelskaSoba::dodaj($conn,$broj,$sprat,$brojKreveta,$kuhinja,$terasa,$minibar,$sifraHotela)){
        echo "Uspesno sacuvana hotelska soba";
    }else{
        echo "Neuspesno sacuvana hotelska soba";
    }

}else{
    echo "Nepotpuna forma";
}

