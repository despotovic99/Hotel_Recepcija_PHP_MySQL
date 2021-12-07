<?php

class Hotel
{

    private int $sifra;
    private string $naziv;
    private string $adresa;
    private int $brojZvezdica;

    /**
     * @param int $sifra
     * @param string $naziv
     * @param string $adresa
     * @param int $brojZvezdica
     */
    public function __construct(int $sifra, string $naziv, string $adresa, int $brojZvezdica){
        $brojZvezdica=$this->ogranicenjeZvezdica($brojZvezdica);

        $this->sifra = $sifra;
        $this->naziv = $naziv;
        $this->adresa = $adresa;
        $this->brojZvezdica = $brojZvezdica;
    }

    private function ogranicenjeZvezdica($brojZvezdica){
        if($brojZvezdica<0 || $brojZvezdica>7) $brojZvezdica=0;
        return $brojZvezdica;
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
     * @return string
     */
    public function getNaziv(): string
    {
        return $this->naziv;
    }

    /**
     * @param string $naziv
     */
    public function setNaziv(string $naziv): void
    {
        $this->naziv = $naziv;
    }

    /**
     * @return string
     */
    public function getAdresa(): string
    {
        return $this->adresa;
    }

    /**
     * @param string $adresa
     */
    public function setAdresa(string $adresa): void
    {
        $this->adresa = $adresa;
    }

    /**
     * @return int|mixed
     */
    public function getBrojZvezdica()
    {
        return $this->brojZvezdica;
    }

    /**
     * @param int|mixed $brojZvezdica
     */
    public function setBrojZvezdica($brojZvezdica): void
    {
        $brojZvezdica=$this->ogranicenjeZvezdica($brojZvezdica);
        $this->brojZvezdica = $brojZvezdica;
    }

    public static function dodaj(mysqli $conn,$naziv,$adresa,$brojZvezdica){
        $statement = $conn->prepare(
            "INSERT INTO Hotel (naziv,adresa,brojZvezdica) 
               VALUES (?,?,?)");

        $statement->bind_param("sss",$naziv,$adresa,$brojZvezdica);
        return $statement->execute();
    }

    public static function azuriraj(mysqli $conn,$naziv,$adresa,$brojZvezdica,$sifra){
        $statement = $conn->prepare(
            "UPDATE Hotel SET naziv=?,adresa=?,brojZvezdica=? 
                WHERE sifra=?");

        $statement->bind_param("ssss",$naziv,$adresa,$brojZvezdica,$sifra);
        return $statement->execute();
    }

    public static function obrisi(mysqli $conn,$sifra){
        $statement = $conn->prepare(
            "DELETE FROM Hotel WHERE sifra=?");

        $statement->bind_param("s",$sifra);
        return $statement->execute();
    }

    public static function vrati(mysqli $conn, $sifra){
        return $conn->query("SELECT * FROM Hotel WHERE sifra='$sifra'");
    }

    public static function vratiSve(mysqli $conn){
        return $conn->query("SELECT * FROM Hotel ");
    }


}