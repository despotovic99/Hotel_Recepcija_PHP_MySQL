<?php
require_once "../../database/Baza.php";
require_once "../../model/Rezervacija.php";

$conn = Baza::getConnection();

if(isset($_POST['sifra']) && $_POST['sifra']!=""){
    $sifra = htmlspecialchars($_POST['sifra'],ENT_QUOTES);



    if(Rezervacija::obrisi($conn,$sifra)){
        echo "Uspesno obrisana rezervacija";
    }else{
        echo "Neuspesno obrisana rezervacija";
    }

}else{
    echo "Neuspesno";
}