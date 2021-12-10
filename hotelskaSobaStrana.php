<?php
require_once "model/HotelskaSoba.php";
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
    <title>Hotelska soba</title>
</head>

<body>
<?php require_once "templates/navBar.php";?>
<br>
<div class="sadrzajStrane">

    <div class="naslovStrane"><h1>Dodaj hotelsku sobu</h1></div>
    <br>
    <form id="formaSoba">
        <input type="hidden" name="sifra" value="">
        <div class="input-group mb-3 container" id="nazivHotelskeSobeDiv">
            <input class="form-control" type="text" name="broj" placeholder="Broj hotelske sobe" value="">
        </div>
        <div class="input-group mb-3 container">
            <input class="form-control" type="text" name="sprat" placeholder="Sprat" value="">
        </div>
        <div class="input-group mb-3 container">
            <input class="form-control" type="text" name="brojKreveta" placeholder="Broj kreveta" value="">
        </div>
        <div class="form-check container">
            <input class="form-check-input" type="checkbox" value="1" id="checkKuhinja">
            <label class="form-check-label" for="checkKuhinja" style="color: white">
                Kuhinja
            </label>
        </div>
        <div class="form-check container">
            <input class="form-check-input" type="checkbox" value="1" id="checkTerasa">
            <label class="form-check-label" for="checkTerasa" style="color: white">
                Terasa
            </label>
        </div>
        <div class="form-check container">
            <input class="form-check-input" type="checkbox" value="1" id="checkMinibar">
            <label class="form-check-label" for="checkMinibar" style="color: white">
                Minibar
            </label>
        </div>
        <div class="container">
            <label for="sifraHotelaId" style="color: white">Hotel</label>
            <select class="form-select" aria-label="Default select example" id="sifraHotelaId" name="sifraHotela">
                <?php
                $odgovor = Hotel::vratiSve($conn);
                if($odgovor!=null){
                while (($red=$odgovor->fetch_assoc())!=null){?>
                    <option value="<?=$red['sifra'];?>"><?=$red['naziv'];?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <br>
        <div class="d-grid gap-2 d-md-block container">
            <button type="submit" id="sacuvaj" class="btn btn-success">Sačuvaj</button>
            <button type="reset" id="resetForme" class="btn btn-secondary">Očisti formu</button>
            <button type="button" id="obrisi" class="btn btn-danger">Obriši</button>
        </div>
    </form>
    <br>
    <div class="lista">
        <div class="d-flex p-1 justify-content-between">
            <h2>Lista hotelskih soba</h2>
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
                <th scope="col">Broj sobe</th>
                <th scope="col">Sprat </th>
                <th scope="col">Broj kreveta</th>
                <th scope="col">Kuhinja</th>
                <th scope="col">Terasa</th>
                <th scope="col">Minibar</th>
                <th scope="col">Hotel</th>
                <th></th>
            </tr>
            </thead>

            <tbody id="tableBody">
            <?php
            $odgovor = HotelskaSoba::vratiSve($conn);
            if($odgovor!=null){
                while (($red=$odgovor->fetch_assoc())!=null){?>
                    <tr>

                        <td><?= $red["broj"];?></td>
                        <td><?= $red["sprat"];?></td>
                        <td><?= $red["brojKreveta"];?></td>
                        <td><?php if($red["kuhinja"]==1){
                            echo "da";
                            }else{
                            echo "ne";
                            }?></td>
                        <td><?php if($red["terasa"]==1){
                            echo "da";
                            }else{
                            echo "ne";
                            }?></td>
                        <td><?php if($red["minibar"]==1){
                                echo "da";
                            }else{
                                echo "ne";
                            }?></td>
                        <td><?= $red["naziv"];?></td>
                        <td>
                            <div class="form-check">
                                <input type="radio" name="checkHotelskaSoba" value=<?php echo $red["sifra"]; ?>>
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
<script src="js/hotelskaSoba.js"></script>
</body>
</html>