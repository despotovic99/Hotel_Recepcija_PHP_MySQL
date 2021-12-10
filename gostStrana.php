<?php
require_once "model/Gost.php";
require_once "database/Baza.php";
$conn = Baza::getConnection();
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
    <title>Gost</title>
</head>

<body>

<?php require_once "templates/navBar.php";?>
<br>
<div class="sadrzajStrane">
    <div class="naslovStrane"><h1>Dodaj gosta</h1></div>
    <br>
    <form action="" id="formaGost">
        <input type="hidden" name="sifra" value="">
        <div class="input-group mb-3 container" id="brD">
            <input class="form-control" type="text" name="brDokumenta" placeholder="Broj dokumenta" value="">
        </div>

        <div class="input-group mb-3 container">
            <input class="form-control" type="text" name="ime" placeholder="Ime" value="">
        </div>

        <div class="input-group mb-3 container">
            <input class="form-control" type="text" name="prezime" placeholder="Prezime" value="">
        </div>

        <div class="input-group mb-3 container">
            <span class="input-group-text">Datum rođenja</span>
            <input class="form-control" type="date" id="datumRodjenjaId" name="datumRodjenja" value="">
        </div>

        <div class="input-group mb-3 container">
            <input class="form-control" type="email" name="email" placeholder="Email" value="">
        </div>

        <div class="input-group mb-3 container">
            <input class="form-control" type="text" name="brTelefona" placeholder="Broj telefona" value="">
        </div>

        <div class="form-check container">
            <input class="form-check-input" type="radio" name="pol" value="M" id="radioM">
            <label class="form-check-label" for="radioM" style="color: white">
                Muški
            </label>
        </div>
        <div class="form-check container">
            <input class="form-check-input" type="radio" name="pol" value="Z" id="radioZ">
            <label class="form-check-label" for="radioZ" style="color: white">
                Ženski
            </label>
        </div>


        <div class="form-check container">
            <input class="form-check-input" type="checkbox" value="1" name="straniGost" id="checkStrani">
            <label class="form-check-label" for="checkStrani" style="color: white">
                Strani gost
            </label>
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
            <h2>Lista gostiju</h2>
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
                    <th scope="col">Datum rođenja</th>
                    <th scope="col">Email</th>
                    <th scope="col">Broj telefona</th>
                    <th scope="col">Pol</th>
                    <th scope="col">Strani gost</th>
                    <th></th>
                </tr>
            </thead>

            <tbody id="tableBody">
            <?php
            $odgovor = Gost::vratiSve($conn);
            if($odgovor!=null){
            while (($red=$odgovor->fetch_assoc())!=null){?>
                <tr>
                    <td><?= $red["brDokumenta"];?></td>
                    <td><?= $red["ime"];?></td>
                    <td><?= $red["prezime"];?></td>
                    <td><?= $red["datumRodjenja"];?></td>
                    <td><?= $red["email"];?></td>
                    <td><?= $red["brTelefona"];?></td>
                    <td><?= $red["pol"];?></td>
                    <td><?php if($red["straniGost"]==1){
                        echo "da";
                        }else{
                        echo "ne";
                        }?></td>
                    <td>
                        <div class="form-check">
                            <input type="radio" name="checkGost" value=<?php echo $red["sifra"] ?>>
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
<script src="js/gost.js"></script>
</body>
</html>
