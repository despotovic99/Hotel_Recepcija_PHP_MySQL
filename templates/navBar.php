<nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="rezervacija.php">Rezervacija</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="hotelskaSobaStrana.php">Hotelska soba</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="hotelStrana.php">Hotel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="gostStrana.php">Gost</a>
            </li>
        </ul>

    </div>

    <?php
    if (isset($_SESSION['username_trenutni'])) {
       echo '<div><form action="operations/logout.php">
                        <button class="btn btn-danger" type="submit">Odjavi se</button>
                  </form></div>';
    }
    ?>
</nav>