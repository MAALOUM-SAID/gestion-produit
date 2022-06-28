<?php
require_once '../categorie/gestionCategorie.php';
require_once '../produit/gestionproduit.php';
require_once '../connection.php';
$pdo=Connection::connectToDB("gestionproduit");
// Categorie
$categorie=new categorie(pdo:$pdo);
$produit=new Produit(pdo:$pdo);
$categories=$categorie -> afficher_categories();
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once '../website/template/head.php'?>
<body>
    
    <?php require_once "../website/template/navbar.php" ?>
    <?php require_once "../website/template/section1.php" ?>
</body>
</html>