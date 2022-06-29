<?php 
require_once '../Auth/auth.php';
?>
<header>
            <div class="nav-top">
                <div class="title">
                    <h3><?= strtoupper($_SESSION["username"]) ?></h3>
                </div>
                <nav>
                    <ul><li>
                        <i class="fa-solid fa-user"></i>
                        <a href="../Auth/profile.php">profile</a></li></ul>
                    <ul><li>
                        <i class="fa-solid fa-bars"></i>
                        <a href="../categorie/index.php?title=Les Categories">categories</a></li></ul>
                    <ul><li>
                        <i class="fa-solid fa-cubes"></i>
                        <a href="../produit/index.php?title=Les Produits">produits</a></li></ul>
                    <ul><li>
                        <i class="fa-solid fa-users"></i>
                        <a href="../Auth/index.php?title=Les Admins">admins</a></li></ul>
                </nav>
            </div>
            <div class="logout-btn">
                <a href="../Auth/logout.php" title="logout">
                <i class="fa-solid fa-power-off"></i>
                </a>
            </div>
        </header>
