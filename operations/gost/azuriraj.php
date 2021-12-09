<?php

require_once "../../database/Baza.php";
require_once "../../model/Gost.php";

$conn = Baza::getConnection();

if(isset($_POST['brDokumenta']) && $_POST['brDokumenta']!="" &&
    isset($_POST['ime']) && $_POST['ime']!="" &&
    isset($_POST['prezime']) && $_POST['prezime']!="" &&
    isset($_POST['datumRodjenja']) && $_POST['datumRodjenja']!="" &&
    isset($_POST['email']) && $_POST['email']!="" &&
    isset($_POST['brTelefona']) && $_POST['brTelefona']!="" &&
    isset($_POST['pol']) && $_POST['pol']!="" &&
    isset($_POST['sifra']) && $_POST['sifra']!=""){

    $brDokumenta = htmlspecialchars($_POST['brDokumenta'],ENT_QUOTES);
    $ime = htmlspecialchars($_POST['ime'],ENT_QUOTES);
    $prezime = htmlspecialchars($_POST['prezime'],ENT_QUOTES);
    $datumRodjenja= htmlspecialchars($_POST['datumRodjenja'],ENT_QUOTES);
    $email = htmlspecialchars($_POST['email'],ENT_QUOTES);
    $brTelefona = htmlspecialchars($_POST['brTelefona'],ENT_QUOTES);
    $pol = htmlspecialchars($_POST['pol'],ENT_QUOTES);
    $straniGost=isset($_POST['straniGost'])&&$_POST['straniGost']=='1'?1:0;
    $sifra=htmlspecialchars($_POST['sifra'],ENT_QUOTES);


    if(Gost::azuriraj($conn,$brDokumenta,$ime,$prezime,$datumRodjenja,$email,$brTelefona,$pol,$straniGost,$sifra)){
        echo "Uspesno azuriran gost";
    }else{
        echo "Neuspesno azuriran gost";
    }

}else{
    echo "Nepotpuna forma";
}