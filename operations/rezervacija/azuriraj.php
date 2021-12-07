<?php
require_once "../../database/Baza.php";
require_once "../../model/Rezervacija.php";

$conn = Baza::getConnection();

if(isset($_POST['sifraHotelskeSobe']) && $_POST['sifraHotelskeSobe']!="" &&
    isset($_POST['sifraGosta']) && $_POST['sifraGosta']!="" &&
    isset($_POST['datumOd']) && $_POST['datumOd']!="" &&
    isset($_POST['datumDo']) && $_POST['datumDo']!="" &&
    isset($_POST['cena']) && $_POST['cena']!=""&&
    isset($_POST['sifra']) && $_POST['sifra']!="" ){


    $sifraHotelskeSobe = htmlspecialchars($_POST['sifraHotelskeSobe'],ENT_QUOTES);
    $sifraGosta = htmlspecialchars($_POST['sifraGosta'],ENT_QUOTES);
    $datumOd = htmlspecialchars($_POST['datumOd'],ENT_QUOTES);
    $datumDo = htmlspecialchars($_POST['datumDo'],ENT_QUOTES);
    $cena = htmlspecialchars($_POST['cena'],ENT_QUOTES);
    $sifra=htmlspecialchars($_POST['sifra'],ENT_QUOTES);


    if(Rezervacija::azuriraj($conn,$sifraHotelskeSobe,$sifraGosta,$datumOd,$datumDo,$cena,$sifra)){
        echo "Uspesno azurirana rezervacija";
    }else{
        echo "Neuspesno azurirana rezervacija";
    }

}else{
    echo "Nepotpuna forma";
}