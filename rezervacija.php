<?php
require_once "database/Baza.php";
require_once "model/HotelskaSoba.php";
require_once "model/Gost.php";
require_once "model/Rezervacija.php";
$conn=Baza::getConnection();
$rezervacijeOdgovor=null;

session_start();
if (!isset($_SESSION['username_trenutni'])) {
    header('Location: index.php');
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <?php require_once "./templates/headTag.php"?>
    <title>Rezervacija</title>
</head>


<body>
<?php require_once "./templates/navBar.php";?>
<br>

<div class="sadrzajStrane">
    <div class="naslovStrane"><h1>Napravi rezervaciju</h1></div>
    <br>
    <form id="formaRezervacija">
        <input type="hidden" name="sifra" value="">
        <div class="container" id="hotelskaSobaDivId">
            <label for="sifraHotelskeSobeId">Hotelska soba</label>
            <select class="form-select" aria-label="Default select example" id="sifraHotelskeSobeId" name="sifraHotelskeSobe">
                <option value="">Izaberi sobu</option>
                <?php
                $rezervacijeOdgovor = HotelskaSoba::vratiSve($conn);
                if($rezervacijeOdgovor!=null){
                    while (($red=$rezervacijeOdgovor->fetch_assoc())!=null){?>
                        <option value="<?=$red['sifra'];?>"><?=$red["naziv"]." Soba: ".$red['broj']." Sprat: ".$red['sprat'];?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="container">
            <label for="sifraGostaId">Gost</label>
            <select class="form-select" aria-label="Default select example" id="sifraGostaId" name="sifraGosta">
                <option value="">Izaberi gosta</option>
                <?php
                $rezervacijeOdgovor = Gost::vratiSve($conn);
                if($rezervacijeOdgovor!=null){
                    while (($red=$rezervacijeOdgovor->fetch_assoc())!=null){?>
                        <option value="<?=$red['sifra'];?>"><?=$red["brDokumenta"]." ".$red['ime']." ".$red['prezime'];?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
        <br>
        <div class="container row">
            <div class="col input-group mb-3 ">
                <span class="input-group-text" style="font-size: 0.8em">Datum od</span>
                <input class="form-control" type="date" id="datumOdId" name="datumOd">
            </div>
            <div class="col input-group mb-3">
                <span class="input-group-text" style="font-size: 0.8em">Datum do</span>
                <input class="form-control" type="date" id="datumDoId" name="datumDo">
            </div>
        </div>
        <div class="input-group mb-3 container">
            <input class="form-control" type="text" name="cena" placeholder="Cena" value="">
        </div>
        <div class="d-grid gap-2 d-md-block">
            <button type="submit" id="sacuvaj" class="btn btn-success">Sačuvaj</button>
            <button type="reset" id="resetForme" class="btn btn-secondary">Očisti formu</button>
            <button type="" id="obrisi" class="btn btn-danger">Obriši</button>
        </div>
    </form>
<br>
    <div class="lista">


            <div class="d-flex p-1 justify-content-between">
                <h2>Lista rezervacija</h2>
                <div class="w-25 p-3">
                    <input class="form-control" type="text" placeholder="pretraga" id="pretraga">
                </div>
                <div>
                    <input class="form-control" type="button" id="sortBtn" value="sortiraj">
                </div>
            </div>

        <table class="table table-striped">

            <thead>
            <tr>
                <th scope="col">Broj dokumenta</th>
                <th scope="col">Ime</th>
                <th scope="col">Prezime</th>
                <th scope="col">Email</th>
                <th scope="col">Hotel</th>
                <th scope="col">Broj sobe</th>
                <th scope="col">Datum od</th>
                <th scope="col">Datum do</th>
                <th scope="col">Cena</th>
                <th></th>
            </tr>
            </thead>

            <tbody id="tableBody">
            <?php
            $rezervacijeOdgovor = Rezervacija::vratiSve($conn);
            if($rezervacijeOdgovor!=null){
                while (($red=$rezervacijeOdgovor->fetch_assoc())!=null){?>
                    <tr>
                        <td><?= $red["brDokumenta"];?></td>
                        <td><?= $red["ime"];?></td>
                        <td><?= $red["prezime"];?></td>
                        <td><?= $red["email"];?></td>
                        <td><?= $red["naziv"];?></td>
                        <td><?= $red["broj"];?></td>
                        <td><?= $red["datumOd"];?></td>
                        <td><?= $red["datumDo"];?></td>
                        <td><?= $red["cena"];?></td>
                        <td>
                            <div class="form-check">
                                <input type="radio" name="checkRezervacija" value=<?php echo $red["sifra"] ?>>
                                <span class="checkmark"></span>
                            </div>
                        </td>
                    </tr>
                <?php }
            }
            ?>

            </tbody>

        </table>

    </div>

</div>

<?php require_once "./templates/skriptTagovi.php";?>
<script src="./js/rezervacija.js"></script>

</body>
</html>
