<?php
require_once "./database/Baza.php";
require_once "./model/Prijava.php";
$conn=Baza::getConnection();

session_start();
if(isset($_POST['username']) && isset($_POST['password'])){
    $username=$_POST['username'];
    $password=$_POST['password'];

    $odg=Prijava::login($conn,$username,$password);
    if($odg->num_rows==1){
        $red=$odg->fetch_assoc();
        $_SESSION['username_trenutni']=$red['username'];
        header('Location: rezervacija.php');
        exit();
    }else{
        echo '<script> 

         document.getElementById("porukaDiv").innerHTML="<p>Neuspesna prijava</p>";
          document.getElementById("porukaDiv").setAttribute("style","display:block");
    
      </script>';
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
    <div id="porukaDiv" style="display: none">

    </div>
    <form id="formaLogin">
        <div class="input-group mb-3 container" id="usernameDiv">
            <input class="form-control" type="text" name="username" placeholder="Username" value="">
        </div>
        <div class="input-group mb-3 container" id="passwordDiv">
            <input class="form-control" type="password" name="password" placeholder="Password" value="">
        </div>
        <div class="d-grid gap-2 d-md-block">
            <button type="submit" id="login" class="btn btn-success">Login</button>
        </div>
    </form>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>
