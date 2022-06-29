<?php
    require_once '../Auth/auth.php';
    require_once '../categorie/gestionCategorie.php';
    require_once '../produit/gestionproduit.php';
    require_once '../connection.php';
    $pdo=Connection::connectToDB("gestionproduit");
    // Categorie
    $categorie=new categorie(pdo:$pdo);
    $produit=new Produit(pdo:$pdo);
    $categories=$categorie -> afficher_categories();
    if ($_SERVER["REQUEST_METHOD"]==="GET") {
        if (isset($_GET['id'])) {
            $cat_afficher=$categorie-> recherchce_categorie_by_id($_GET["id"]);
            $produits=$produit -> rechercher_produit_en_categorie($cat_afficher["id"]);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once '../website/template/head.php'?>
<body>
<?php require_once "../website/template/navbar.php" ?>
<section class="section2" id="cat1">
        <h2><?= $cat_afficher["nom_cat"] ?></h2>
        <div class="products">
            <?php foreach($produits as $produit): ?>
            <div class="product">
            <div class="product-image" style="
                background:url('<?=$produit -> image_path?>') no-repeat;
                background-size: cover;
                background-position: center;">
                <div class="react">
               <i class="fa-regular fa-heart"></i>
                </div>
                </div>
                <div class="product-description">
                    <h5>Code: <span><?= $produit->id?></span></h5>
                    <p>
                    <?= $produit->designation?>
                    <span>Quantite en stock</span>
                    <?= $produit->qtstock?>
                    </p>
                </div>
                <div class="product-info">
                    <div class="product-price">
                        <h5>Price: </h5>
                        <span><strong><?= $produit->pu?> $</strong> <del><?= $produit->pu-100?> $</del> </span>
                    </div>
                    <div class="add-to-cart">
                    <i class="fa-solid fa-cart-arrow-down"></i>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </section>
</body>
</html>