<?php
require_once "./database/Baza.php";
require_once "./model/Prijava.php";
$conn=Baza::getConnection();

$poruka="";
session_start();

if (isset($_SESSION['username_trenutni'])) {
    header('Location: rezervacija.php');
    exit();
}

if(isset($_POST['username']) && isset($_POST['password'])){
    $username=$_POST['username'];
    $password=$_POST['password'];

    $odg=Prijava::login($conn,$username,$password);
    if($odg!=null && $odg->num_rows==1){
        $red=$odg->fetch_assoc();
        $_SESSION['username_trenutni']=$red['username'];
        header('Location: rezervacija.php');
        exit();
    }else{
        $poruka="Neuspela prijava";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
   <?php require_once "./templates/headTag.php"?>
    <title>Hotel Recepcija</title>
</head>
<body>
<?php require_once "./templates/navBar.php"?>

<div class="sadrzajStrane">
    <div class="naslovStrane"><h1>Hotel Recepcija</h1></div>
    <br>
    <div id="porukaDiv" name="porukaDiv" style="display: block">
        <p style="color: red"><?=$poruka?></p>
    </div>
    <form id="formaLogin" method="post">
        <div class="input-group mb-3 container" id="usernameDiv">
            <input class="form-control" type="text" name="username" placeholder="Username" value="">
        </div>
        <div class="input-group mb-3 container" id="passwordDiv">
            <input class="form-control" type="password" name="password" placeholder="Password" value="">
        </div>
        <div class="d-grid gap-2 d-md-block">
            <button type="submit" id="login" class="btn btn-success">Prijavi se</button>
        </div>
    </form>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>
