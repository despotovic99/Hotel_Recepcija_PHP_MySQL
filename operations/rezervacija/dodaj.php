<?php

require_once "../../database/Baza.php";
require_once "../../model/Rezervacija.php";

$conn = Baza::getConnection();

if(isset($_POST['sifraHotelskeSobe']) && $_POST['sifraHotelskeSobe']!="" &&
    isset($_POST['sifraGosta']) && $_POST['sifraGosta']!="" &&
    isset($_POST['datumOd']) && $_POST['datumOd']!="" &&
    isset($_POST['datumDo']) && $_POST['datumDo']!="" &&
    isset($_POST['cena']) && $_POST['cena']!="" ){


    $sifraHotelskeSobe = htmlspecialchars($_POST['sifraHotelskeSobe'],ENT_QUOTES);
    $sifraGosta = htmlspecialchars($_POST['sifraGosta'],ENT_QUOTES);
    $datumOd = htmlspecialchars($_POST['datumOd'],ENT_QUOTES);
    $datumDo = htmlspecialchars($_POST['datumDo'],ENT_QUOTES);
    $cena = htmlspecialchars($_POST['cena'],ENT_QUOTES);


    $odgovor = Rezervacija::dodaj($conn,$sifraHotelskeSobe,$sifraGosta,$datumOd,$datumDo,$cena);



    if($odgovor){
        echo "Uspesno sacuvana rezervacija";
    }else{

        echo "Neuspesno sacuvana rezervacija";
    }

}else{
    echo "Nepotpuna forma";
}

