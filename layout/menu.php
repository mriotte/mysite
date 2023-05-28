<div class="navbar">
    <img src="img\logo.png" class="logo">
    <div class="nav-links" id="navLinks">
        <i class="fa-solid fa-xmark" onclick="hideMenu()"></i>
        <ul>
            <li><a href="index.php?action=main">Home</a></li>
            <li><a href="index.php?action=about">About Us</a></li>
            <li><a href="#">Destinations</a></li>
            <li><a href="index.php?action=tours">Tours</a></li>
            <?php
            if (isset($_SESSION["auth"])) {
                echo '<li><a href="index.php?action=create_tour">Add Tour</a></li>
                <li><a href="index.php?action=logout">Logout</a></li>';
            } else {
                echo '<li><a href="index.php?action=login">Login</a></li>';
            }
            ?>
        </ul>
    </div>
    <i class="fa-solid fa-bars" onclick="showMenu()"></i>
</div>