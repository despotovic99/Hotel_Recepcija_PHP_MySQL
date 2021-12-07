<?php

class Gost
{


    private int $sifra;
    private int $brDokumenta;
    private string $ime;
    private string $prezime;
    private DateTime $datumRodjenja;
    private string $email;
    private string $brTelefona;
    private string $pol;
    private bool $straniGost;

    /**
     * @param int $sifra
     * @param int $brDokumenta
     * @param string $ime
     * @param string $prezime
     * @param DateTime $datumRodjenja
     * @param string $email
     * @param string $brTelefona
     * @param string $pol
     * @param bool $straniGost
     */
    public function __construct(int $sifra, int $brDokumenta, string $ime, string $prezime, DateTime $datumRodjenja, string $email, string $brTelefona, string $pol, bool $straniGost)
    {
        $this->sifra = $sifra;
        $this->brDokumenta = $brDokumenta;
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->datumRodjenja = $datumRodjenja;
        $this->email = $email;
        $this->brTelefona = $brTelefona;
        $this->pol = $pol;
        $this->straniGost = $straniGost;
    }

    /**
     * @return int
     */
    public function getSifra(): int
    {
        return $this->sifra;
    }

    /**
     * @param int $sifra
     */
    public function setSifra(int $sifra): void
    {
        $this->sifra = $sifra;
    }

    /**
     * @return int
     */
    public function getBrDokumenta(): int
    {
        return $this->brDokumenta;
    }

    /**
     * @param int $brDokumenta
     */
    public function setBrDokumenta(int $brDokumenta): void
    {
        $this->brDokumenta = $brDokumenta;
    }

    /**
     * @return string
     */
    public function getIme(): string
    {
        return $this->ime;
    }

    /**
     * @param string $ime
     */
    public function setIme(string $ime): void
    {
        $this->ime = $ime;
    }

    /**
     * @return string
     */
    public function getPrezime(): string
    {
        return $this->prezime;
    }

    /**
     * @param string $prezime
     */
    public function setPrezime(string $prezime): void
    {
        $this->prezime = $prezime;
    }

    /**
     * @return DateTime
     */
    public function getDatumRodjenja(): DateTime
    {
        return $this->datumRodjenja;
    }

    /**
     * @param DateTime $datumRodjenja
     */
    public function setDatumRodjenja(DateTime $datumRodjenja): void
    {
        $this->datumRodjenja = $datumRodjenja;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getBrTelefona(): string
    {
        return $this->brTelefona;
    }

    /**
     * @param string $brTelefona
     */
    public function setBrTelefona(string $brTelefona): void
    {
        $this->brTelefona = $brTelefona;
    }

    /**
     * @return string
     */
    public function getPol(): string
    {
        return $this->pol;
    }

    /**
     * @param string $pol
     */
    public function setPol(string $pol): void
    {
        $this->pol = $pol;
    }

    /**
     * @return bool
     */
    public function isStraniGost(): bool
    {
        return $this->straniGost;
    }

    /**
     * @param bool $straniGost
     */
    public function setStraniGost(bool $straniGost): void
    {
        $this->straniGost = $straniGost;
    }

    public static function dodaj(mysqli $conn,$brDokumenta,$ime,$prezime,$datumRodjenja,$email,$brTelefona,$pol,$straniGost){
        $statement = $conn->prepare(
            "INSERT INTO Gost (brDokumenta,ime,prezime,datumRodjenja,email,brTelefona,pol,straniGost) 
               VALUES (?,?,?,?,?,?,?,?)");

        $statement->bind_param("ssssssss",$brDokumenta,$ime,$prezime,$datumRodjenja,$email,$brTelefona,$pol,$straniGost);
        return $statement->execute();
    }

    public static function azuriraj(mysqli $conn,$brDokumenta,$ime,$prezime,$datumRodjenja,$email,$brTelefona,$pol,$straniGost,$sifra){
        $statement = $conn->prepare(
            "UPDATE Gost SET brDokumenta=?,ime=?,prezime=?,datumRodjenja=?,email=?,brTelefona=?,pol=?,straniGost=? 
                WHERE sifra=?");

        $statement->bind_param("sssssssss",$brDokumenta,$ime,$prezime,$datumRodjenja,$email,$brTelefona,$pol,$straniGost,$sifra);
        return $statement->execute();
    }

    public static function obrisi(mysqli $conn,$sifra){
        $statement = $conn->prepare(
            "DELETE FROM Gost WHERE sifra=?");

        $statement->bind_param("s",$sifra);
        return $statement->execute();
    }

    public static function vrati(mysqli $conn, $sifra){
       $obj=array();
       if($odg=$conn->query("SELECT * FROM Gost WHERE sifra='$sifra'")){
           while($red = $odg->fetch_array(1)){
               $obj[]=$red;
           }
       }
    return $obj;
    }

    public static function vratiSve(mysqli $conn){
        return $conn->query("SELECT * FROM Gost ");
    }




}