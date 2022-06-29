<?php 
require_once '../Auth/auth.php';
?>
<div class="my-container2">
        <div class="nav-admin">
            <div class="admin-name">
                <h3>Hello,<?= $_SESSION['username']?></h3>
            </div>
            <div class="return-icon">
                <a href="../produit/index.php?title=Les Produits">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                </a>
            </div>
</div>