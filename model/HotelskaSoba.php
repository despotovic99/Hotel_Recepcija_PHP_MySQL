<?php

class HotelskaSoba
{
    private int $sifra;
    private int $broj;
    private int $sprat;
    private int $brojKreveta;
    private bool $kuhinja;
    private bool $terasa;
    private bool $minibar;
    private Hotel $hotel;

    /**
     * @param int $sifra
     * @param int $broj
     * @param int $sprat
     * @param int $brojKreveta
     * @param bool $kuhinja
     * @param bool $terasa
     * @param bool $minibar
     * @param Hotel $hotel
     */
    public function __construct(int $sifra, int $broj, int $sprat, int $brojKreveta, bool $kuhinja, bool $terasa, bool $minibar, Hotel $hotel)
    {
        $this->sifra = $sifra;
        $this->broj = $broj;
        $this->sprat = $sprat;
        $this->brojKreveta = $brojKreveta;
        $this->kuhinja = $kuhinja;
        $this->terasa = $terasa;
        $this->minibar = $minibar;
        $this->hotel = $hotel;
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
    public function getBroj(): int
    {
        return $this->broj;
    }

    /**
     * @param int $broj
     */
    public function setBroj(int $broj): void
    {
        $this->broj = $broj;
    }

    /**
     * @return int
     */
    public function getSprat(): int
    {
        return $this->sprat;
    }

    /**
     * @param int $sprat
     */
    public function setSprat(int $sprat): void
    {
        $this->sprat = $sprat;
    }

    /**
     * @return int
     */
    public function getBrojKreveta(): int
    {
        return $this->brojKreveta;
    }

    /**
     * @param int $brojKreveta
     */
    public function setBrojKreveta(int $brojKreveta): void
    {
        $this->brojKreveta = $brojKreveta;
    }

    /**
     * @return bool
     */
    public function isKuhinja(): bool
    {
        return $this->kuhinja;
    }

    /**
     * @param bool $kuhinja
     */
    public function setKuhinja(bool $kuhinja): void
    {
        $this->kuhinja = $kuhinja;
    }

    /**
     * @return bool
     */
    public function isTerasa(): bool
    {
        return $this->terasa;
    }

    /**
     * @param bool $terasa
     */
    public function setTerasa(bool $terasa): void
    {
        $this->terasa = $terasa;
    }

    /**
     * @return bool
     */
    public function isMinibar(): bool
    {
        return $this->minibar;
    }

    /**
     * @param bool $minibar
     */
    public function setMinibar(bool $minibar): void
    {
        $this->minibar = $minibar;
    }

    /**
     * @return Hotel
     */
    public function getHotel(): Hotel
    {
        return $this->hotel;
    }

    /**
     * @param Hotel $hotel
     */
    public function setHotel(Hotel $hotel): void
    {
        $this->hotel = $hotel;
    }

    public static function dodaj(mysqli $conn,$broj,$sprat,$brojKreveta,$kuhinja,$terasa,$minibar,$sifraHotela){
        $statement = $conn->prepare(
            "INSERT INTO HotelskaSoba (broj,sprat,brojKreveta,kuhinja,terasa,minibar,sifraHotela) 
               VALUES (?,?,?,?,?,?,?)");

        $statement->bind_param("sssssss",$broj,$sprat,$brojKreveta,$kuhinja,$terasa,$minibar,$sifraHotela);
        return $statement->execute();
    }

    public static function azuriraj(mysqli $conn,$broj,$sprat,$brojKreveta,$kuhinja,$terasa,$minibar,$sifraHotela,$sifra){
        $statement = $conn->prepare(
            "UPDATE HotelskaSoba SET broj=?,sprat=?,brojKreveta=?,kuhinja=?,terasa=?,minibar=?,sifraHotela=?
                WHERE sifra=?");

        $statement->bind_param("ssssssss",$broj,$sprat,$brojKreveta,$kuhinja,$terasa,$minibar,$sifraHotela,$sifra);
        return $statement->execute();
    }

    public static function obrisi(mysqli $conn,$sifra){
        $statement = $conn->prepare(
            "DELETE FROM HotelskaSoba WHERE sifra=?");

        $statement->bind_param("s",$sifra);
        return $statement->execute();
    }

    public static function vrati(mysqli $conn, $sifra){
        return $conn->query("SELECT * FROM HotelskaSoba WHERE sifra='$sifra'");
    }



    public static function vratiSve(mysqli $conn){
        return $conn->query(
            "SELECT hs.sifra,hs.broj,hs.sprat,hs.brojKreveta,hs.kuhinja,hs.terasa,hs.minibar,hs.sifraHotela, h.naziv
                    FROM HotelskaSoba as hs , Hotel as h
                    WHERE hs.sifraHotela=h.sifra");
    }

}