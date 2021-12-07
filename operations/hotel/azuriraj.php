<?php

require_once "../../database/Baza.php";
require_once "../../model/Hotel.php";

$conn = Baza::getConnection();

if(isset($_POST['naziv']) && $_POST['naziv']!="" &&
    isset($_POST['adresa']) && $_POST['adresa']!="" &&
    isset($_POST['brojZvezdica']) && $_POST['brojZvezdica']!="" &&
    isset($_POST['sifra']) && $_POST['sifra']!=""){


    $naziv = htmlspecialchars($_POST['naziv'],ENT_QUOTES);
    $adresa = htmlspecialchars($_POST['adresa'],ENT_QUOTES);
    $brojZvezdica = htmlspecialchars($_POST['brojZvezdica'],ENT_QUOTES);
    if($brojZvezdica<0 || $brojZvezdica>7){
        $brojZvezdica=0;
    }
    $sifra=htmlspecialchars($_POST['sifra'],ENT_QUOTES);


    if(Hotel::azuriraj($conn,$naziv,$adresa,$brojZvezdica,$sifra)){
        echo "Uspesno azuriran hotel";
    }else{
        echo "Neuspesno azuriran hotel";
    }

}else{
    echo "Nepotpuna forma";
}