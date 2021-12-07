<?php

class Rezervacija
{
    private int $sifra;
    private DateTime $datumOd;
    private DateTime $datumDo;
    private float $cena;
    private HotelskaSoba $hotelskaSoba;
    private Gost $gost;

    /**
     * @param int $sifra
     * @param DateTime $datumOd
     * @param DateTime $datumDo
     * @param float $cena
     * @param HotelskaSoba $hotelskaSoba
     * @param Gost $gost
     */
    public function __construct(int $sifra, DateTime $datumOd, DateTime $datumDo, float $cena, HotelskaSoba $hotelskaSoba, Gost $gost)
    {
        $this->sifra = $sifra;
        $this->datumOd = $datumOd;
        $this->datumDo = $datumDo;
        $this->cena = $cena;
        $this->hotelskaSoba = $hotelskaSoba;
        $this->gost = $gost;
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
     * @return DateTime
     */
    public function getDatumOd(): DateTime
    {
        return $this->datumOd;
    }

    /**
     * @param DateTime $datumOd
     */
    public function setDatumOd(DateTime $datumOd): void
    {
        $this->datumOd = $datumOd;
    }

    /**
     * @return DateTime
     */
    public function getDatumDo(): DateTime
    {
        return $this->datumDo;
    }

    /**
     * @param DateTime $datumDo
     */
    public function setDatumDo(DateTime $datumDo): void
    {
        $this->datumDo = $datumDo;
    }

    /**
     * @return float
     */
    public function getCena(): float
    {
        return $this->cena;
    }

    /**
     * @param float $cena
     */
    public function setCena(float $cena): void
    {
        $this->cena = $cena;
    }

    /**
     * @return HotelskaSoba
     */
    public function getHotelskaSoba(): HotelskaSoba
    {
        return $this->hotelskaSoba;
    }

    /**
     * @param HotelskaSoba $hotelskaSoba
     */
    public function setHotelskaSoba(HotelskaSoba $hotelskaSoba): void
    {
        $this->hotelskaSoba = $hotelskaSoba;
    }

    /**
     * @return Gost
     */
    public function getGost(): Gost
    {
        return $this->gost;
    }

    /**
     * @param Gost $gost
     */
    public function setGost(Gost $gost): void
    {
        $this->gost = $gost;
    }

    public static function dodaj(mysqli $conn,$sifraHotelskeSobe,$sifraGosta,$datumOd,$datumDo,$cena){

        $statement=$conn->prepare("INSERT INTO Rezervacija (datumOd,datumDo,cena,sifraHotelskeSobe,sifraGosta)
                                        VALUES (?,?,?,?,?)");
        $statement->bind_param("sssss",$datumOd,$datumDo,$cena,$sifraHotelskeSobe,$sifraGosta);
        return $statement->execute();
    }
    public static function azuriraj(mysqli $conn,$sifraHotelskeSobe,$sifraGosta,$datumOd,$datumDo,$cena,$sifra){

        $statement=$conn->prepare("UPDATE Rezervacija SET datumOd=?,datumDo=?,cena=?,sifraHotelskeSobe=?,sifraGosta=?
                                        WHERE sifra=?");
        $statement->bind_param("ssssss",$datumOd,$datumDo,$cena,$sifraHotelskeSobe,$sifraGosta,$sifra);
        return $statement->execute();
    }

    public static function obrisi(mysqli $conn,$sifra){
        $statement=$conn->prepare("DELETE FROM Rezervacija WHERE sifra=?");
        $statement->bind_param("s",$sifra);
        return $statement->execute();
    }

    public static function vrati(mysqli $conn,$sifra){
        return $conn->query("SELECT * FROM Rezervacija WHERE sifra='$sifra'");
    }
    public static function vratiSve(mysqli $conn){
        return $conn->query("SELECT r.sifra,g.ime,g.prezime,g.brDokumenta,g.email,r.datumOd,r.datumDo,r.cena, hs.broj,h.naziv
                                    FROM Rezervacija AS r 
                                    INNER JOIN HotelskaSoba AS hs
                                    ON r.sifraHotelskeSobe=hs.sifra
                                    INNER JOIN Hotel AS h
                                    ON hs.sifraHotela=h.sifra
                                    INNER JOIN Gost AS g 
                                    ON r.sifraGosta=g.sifra");
    }

}