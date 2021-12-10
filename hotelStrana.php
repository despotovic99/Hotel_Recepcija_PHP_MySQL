<?php
require_once "model/Hotel.php";
require_once "database/Baza.php";
$conn=Baza::getConnection();

session_start();
if (!isset($_SESSION['username_trenutni'])) {
    header('Location: index.php');
    exit();
}

?>
<!doctype html>
<html lang="en">

<head>
    <?php require_once "templates/headTag.php"?>
    <title>Hotel</title>
</head>

<body>
<?php require_once "templates/navBar.php";?>
<br>
<div class="sadrzajStrane">
    <div class="naslovStrane"><h1>Dodaj hotel</h1></div>
    <br>
    <form id="formaHotel">
        <input type="hidden" name="sifra" value="">
        <div class="input-group mb-3 container" id="nazivHotelaDiv">
            <input class="form-control" type="text" name="naziv" placeholder="Naziv hotela" value="">
        </div>
        <div class="input-group mb-3 container">
            <input class="form-control" type="text" name="adresa" placeholder="Adresa hotela" value="">
        </div>
        <div class="container">
            <label for="brZvezdica">Broj zvezdica</label>
            <select class="form-select" aria-label="Default select example" id="brZvezdica" name="brojZvezdica">
                <option value="0">Nema zvezdica</option>
                <option value="1">1 zvezdica</option>
                <option value="2">2 zvezdice</option>
                <option value="3">3 zvezdice</option>
                <option value="4">4 zvezdice</option>
                <option value="5">5 zvezdice</option>
                <option value="6">6 zvezdice</option>
                <option value="7">7 zvezdice</option>
            </select>
        </div>
        <br>
        <div class="d-grid gap-2 d-md-block container">
            <button type="submit" id="sacuvaj" class="btn btn-success">Sačuvaj</button>
            <button type="reset" id="resetForme" class="btn btn-secondary">Očisti formu</button>
            <button type="" id="obrisi" class="btn btn-danger">Obriši</button>
        </div>
    </form>
<br>
    <div class="lista">
        <div class="d-flex p-1 justify-content-between">
            <h2>Lista hotela</h2>
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
                <th scope="col">Naziv hotela</th>
                <th scope="col">Adresa </th>
                <th scope="col">Broj zvezdica</th>
                <th></th>
            </tr>
            </thead>

            <tbody id="tableBody">
            <?php
            $odgovor = Hotel::vratiSve($conn);
            if($odgovor!=null){
                while (($red=$odgovor->fetch_assoc())!=null){?>
                    <tr>
                        <td><?= $red["naziv"];?></td>
                        <td><?= $red["adresa"];?></td>
                        <td><?= $red["brojZvezdica"];?></td>
                        <td>
                            <div class="form-check">
                                <input type="radio" name="checkHotel" value=<?php echo $red["sifra"] ?>>
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
<?php require_once "templates/skriptTagovi.php";?>
<script src="js/hotel.js"></script>
</body>
</html>
