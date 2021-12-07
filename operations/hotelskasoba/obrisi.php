<?php
require_once "../../database/Baza.php";
require_once "../../model/HotelskaSoba.php";

$conn = Baza::getConnection();

if(isset($_POST['sifra']) && $_POST['sifra']!=""){
    $sifra = htmlspecialchars($_POST['sifra'],ENT_QUOTES);



    if(HotelskaSoba::obrisi($conn,$sifra)){
        echo "Uspesno obrisana hotelska soba";
    }else{
        echo "Neuspesno obrisana hotelska soba";
    }

}else{
    echo "Neuspesno";
}