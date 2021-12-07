<?php
require_once "../../database/Baza.php";
require_once "../../model/Hotel.php";

$conn = Baza::getConnection();

if(isset($_POST['sifra']) && $_POST['sifra']!=""){
    $sifra = htmlspecialchars($_POST['sifra'],ENT_QUOTES);



    if(Hotel::obrisi($conn,$sifra)){
        echo "Uspesno obrisan hotel";
    }else{
        echo "Neuspesno obrisan hotel";
    }

}else{
    echo "Neuspesno";
}