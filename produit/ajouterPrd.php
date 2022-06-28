<?php
    require_once '../Auth/auth.php';
    require_once '..\utile.php';
    require_once '..\connection.php';
    require_once '..\Auth\gestionAdmins.php';
    require_once '..\categorie\gestionCategorie.php';
    require_once '..\produit\gestionproduit.php';
    $pdo=Connection::connectToDB("gestionproduit");
    $categorie=new Categorie(pdo:$pdo);
    $categories=$categorie->afficher_categories();
    // Ajouter
    if ($_SERVER['REQUEST_METHOD']==="POST") {  
        
        if (isset($_POST['ajouter'])) {
            
            if (isset($_POST['designation']) && !empty($_POST['designation'])
            && isset($_POST['prix_unitaire']) && !empty($_POST['prix_unitaire'])
            && isset($_POST['categorie']) && !empty($_POST['categorie'])
            && isset($_FILES["prd_image"])
            ) {
                $ok=false;
                $designation=$_POST['designation'];
                $prix_unitaire=$_POST['prix_unitaire'];
                $id_cat=$_POST['categorie'];
                $qte_stock=$_POST['qte_stock'];
                $image=$_FILES["prd_image"];
                if (!file_exists("../uploads/produits/" . $image["name"])) {
                    
                    if ($image["size"]>0) {
                        move_uploaded_file(
                            $image['tmp_name'],
                            "../uploads/produits/" . $image["name"]
                        );
                        $image_path="../uploads/produits/".$image["name"];
                        $ok=true;
                    }
                    if ($ok) {
                        $admin_id=Admin::recherche_admin_id($pdo,$_SESSION['username'])->id;
                        
                        try {
                            $produit=new Produit($pdo,designation:$designation,prix_unitaire:$prix_unitaire
                            ,qte_stock:$qte_stock,id_cat:$id_cat,image_path:$image_path,admin_id:$admin_id);
                            $produit->ajouter_produit();
                        } catch (PDOException $err) {
                            $error=$err->getMessage();
                            $display="style=display:block";
                        }
                    }
                }else{
                    $img_err="Image est Obligatoire";
                }
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<?php include_once '../template/head.php' ?>
<body >
<?php include_once '../template/navbar.php' ?>
<div class="my-body">
    <div class="conatiner-ajouter">
    <div class="err-box" <?=isset($display)?$display:"style=display:none;"?>>
  <div class="d-flex">
    <div class="toast-body">
            <?=isset($error)?$error:""?>
            </div>
        </div>
</div>
<div class="form-ajouter">
        <h3 class="">Ajouter Produit</h3>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="div-input">
            <span>Designation</span>
            <input type="text"  name="designation"><br>
            </div>
            <div class="div-input">
            <span>Prix Unitaire</span>
            <input type="text" name="prix_unitaire"><br>
            </div>
            <div class="div-input">
            <span>Quantitee en stock </span>
            <input type="text" name="qte_stock"><br>
            </div>
            <div class="div-input ">
                <span>Categorie</span>
            <select name="categorie">
                <?php foreach($categories as $value):?>
                    <option value="<?= $value['id']?>"><?= $value['nom_cat']?></option>
                <?php endforeach ;?>
            </select>
            </div>
            <div class="div-input">
                <span>Image</span>
            <label for="image">
            <i class="fa-solid fa-image"></i>
                <input type="file" id="image" name="prd_image" accept="image/*"  placeholder=""><br>
            </label>
            </div>
            <input type="submit" value="Ajouter" name="ajouter">
            </form>
            </div>
    </div>
    <div class="ajouter-image">
        <img src="../images/product.png" alt="product">
        <br>
    </div>
    </div>
</body>
</html>