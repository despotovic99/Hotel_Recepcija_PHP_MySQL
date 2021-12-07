<?php
require_once "../../database/Baza.php";
require_once "../../model/Gost.php";

$conn = Baza::getConnection();

if(isset($_POST['sifra']) && $_POST['sifra']!=""){
    $sifra =intval(htmlspecialchars($_POST['sifra'],ENT_QUOTES));

    if(Gost::obrisi($conn,$sifra)){
        echo "Uspesno obrisan gost";
    }else{
        echo "Neuspesno obrisan gost";
    }

}else{
    echo "Neuspesno";
}