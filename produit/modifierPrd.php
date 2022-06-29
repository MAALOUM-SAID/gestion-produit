<?php
    require_once '../Auth/auth.php';
    require_once '..\utile.php';
    require_once '..\connection.php';
    require_once '..\categorie\gestionCategorie.php';
    require_once '..\produit\gestionproduit.php';
    $pdo=Connection::connectToDB("gestionproduit");
    $categorie=new Categorie(pdo:$pdo,id:$_GET["id_cat"]);
    $categories=$categorie->afficher_categories();
    if ($_SERVER["REQUEST_METHOD"]==="GET") {
        $id=isset($_GET["id"])?$_GET["id"]:-1;
        $designation=isset($_GET["designation"])?$_GET["designation"]:"";
        $prix_unitaire=isset($_GET["pu"])?$_GET["pu"]:0;
        $id_cat=isset($_GET["id_cat"])?$_GET["id_cat"]:0;
        $qte_stock=isset($_GET["qtstock"])?$_GET["qtstock"]:0;
        $image_path=isset($_GET["image_path"])?$_GET["image_path"]:"";
    }else
    // Modifier
    if ($_SERVER['REQUEST_METHOD']==="POST") {  
        if (isset($_POST['modifier'])) {
            if (isset($_POST['designation']) && !empty($_POST['designation'])
            && isset($_POST['prix_unitaire']) && !empty($_POST['prix_unitaire'])
            && isset($_POST['categorie']) && !empty($_POST['categorie'])
            && isset($_FILES["prd_image"])
            ) 
            {
                $id=$_POST['id'];
                $designation=$_POST['designation'];
                $prix_unitaire=$_POST['prix_unitaire'];
                $id_cat=$_POST['categorie'];
                $qte_stock=$_POST['qte_stock'];
                $image=$_FILES["prd_image"];
                $exists=false;
                $ok=false;
                if ($image["size"]>0) {
                    if (!file_exists("../uploads/produits/" .$image["name"])) {
                        move_uploaded_file(
                            $image['tmp_name'],
                            "../uploads/produits/" . $image["name"]
                        );
                        $image_path="../uploads/produits/".$image["name"];
                    }else{
                        $exists=true;
                    }
                    $ok=true;
                }
                if ($ok) {
                    try {
                        if ($exists) {
                            $produit=new Produit($pdo,id:$id,designation:$designation,prix_unitaire:$prix_unitaire,qte_stock:$qte_stock,id_cat:$id_cat); 
                        }else{
                            $produit=new Produit($pdo,id:$id,designation:$designation,prix_unitaire:$prix_unitaire,qte_stock:$qte_stock,id_cat:$id_cat,image_path:$image_path);
                        }
                        $produit->modifier_produit();
                        header("refresh:0;url=index.php?title=Les Produits");
                    } catch (PDOException $err) {
                        $msg_err=$err->getMessage();
                    }
                }
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<?php include_once '../template/head.php' ?>
<body>
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
            <span>Id</span>
            <input type="text"  name="id" value="<?=isset($id)?$id:""?>"  readonly><br>
            </div>
            <div class="div-input">
            <span>Designation</span>
            <input type="text"  name="designation" value="<?=isset($designation)?$designation:""?>"><br>
            </div>
            <div class="div-input">
            <span>Prix Unitaire</span>
            <input type="text" name="prix_unitaire" value="<?= isset($prix_unitaire)?$prix_unitaire:""?>"><br>
            </div>
            <div class="div-input">
            <span>Quantitee en stock </span>
            <input type="text" name="qte_stock" value="<?= isset($qte_stock)?$qte_stock:""?>"><br>
            </div>
            <div class="div-input ">
                <span>Categorie</span>
            <select name="categorie" >
                <?php foreach($categories as $value):?>
                    <option value="<?= $value['id']?>"><?= $value['nom_cat']?></option>
                <?php endforeach ;?>
            </select>
            </div>
            <div class="div-input">
                <span>Image</span>
            <label for="image">
            <i class="fa-solid fa-image"></i>
                <input type="file" id="image" name="prd_image" value="<?= isset($image_path)?$image_path:""?>" accept="image/*"  placeholder=""><br>
            </label>
            </div>
            <input type="submit" value="Modifier" name="modifier">
            </form>
            </div>
    </div>
    <div class="ajouter-image">
        <img src="../images/modifier.png" alt="product">
        <br>
    </div>
    </div>
</body>
</html>