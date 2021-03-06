<?php
    require_once '../Auth/auth.php';
    require_once '../Auth/gestionAdmins.php';
    require_once '../connection.php';
    require_once '../produit/gestionproduit.php';
    require_once '../categorie/gestioncategorie.php';
    $pdo=Connection::connectToDB("gestionproduit");
    $produit=new Produit(pdo:$pdo);
    $categorie=new Categorie(pdo:$pdo);
    // $images=array_splice($produit -> selectionner_images(),-6,5);
    $images=$produit -> selectionner_images();
    // admin
    $admin_id=Admin::recherche_admin_id($pdo,$_SESSION['username']);
    $nbr_produits=$produit -> count_les_produits($admin_id -> id)['nbr'];
    $nbr_categories=$categorie -> count_les_categories($admin_id -> id)[0]['nbr'];
    $pdo=null;
    $image_prf=Admin::recherche_image_admin_username(Connection::connectToDB("gestionproduit")
    ,$_SESSION["username"])->profile_img;
    // here is the change
    $done=false;
    $username=$_SESSION['username'];
        if ($_SERVER["REQUEST_METHOD"]==="POST") {
            $image=$_FILES["image_prf"];
            if ($image["size"]>0) {
                move_uploaded_file(
                    $image['tmp_name'],
                    "../uploads/profile/" . $image["name"]
                );
                $image_path="../uploads/profile/".$image["name"];
                // change image from database
                $pdo=Connection::connectToDB("gestionproduit");
                Admin::change_profile_image($pdo,$image_path,$username);
                $done=true;
        }
    }
    if ($done) {
     
        unlink($image_prf);
        header("Location:../Auth/profile.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once '../template/head.php'?>
<body id="#main-body">
    <div class="my-container">
      <?php require_once '../template/aside.php'?>
          <div class="dashboard">
            <?php require_once '../template/header.php'?>
            <div class="admin-info">
              <div class="about-admin">
                <div class="image-profile">
                  <img src="<?=$image_prf?>" alt="profil image">
                  <form action="" method="POST" enctype="multipart/form-data">
                  <label for="img-inp" id="label-change">
                    <i class="fa-solid fa-camera"></i>
                    <input type="file" name="image_prf" id="img-inp" style="display:none;"> 
                  </label>  
                    <input type="submit" id="btn-submit" style="display:none;">
                  </form>
                </div>
                <div class="personal-info">
                  <h5><?= Admin::recherche_admin_username(Connection::connectToDB("gestionproduit")
                  ,Admin::recherche_admin_id(Connection::connectToDB("gestionproduit"),$_SESSION["username"])->id
                  )->username ?></h5>
                  <code>
                    <?= Admin::recherche_email_admin_username(Connection::connectToDB("gestionproduit"),$_SESSION['username'])->email ?>
                  </code>
                </div>
              </div>
              <div class="admin-social-media">
              <i class="fa-brands fa-facebook"></i>
              <i class="fa-brands fa-instagram"></i>
              <i class="fa-brands fa-twitter"></i>
              </div>
            </div>
            <div class="admin-status">
            <div class="product-slide-images" id="slideshow">
              <div class="fadein" >
                  <?php foreach($images as $image):?>
                <img src="<?= $image -> image_path?>" alt="">
                <?php endforeach ?>
               </div>
            </div>
            <div class="cats-and-prds">
              <div class="categories">
                <div class="cat-icon">
                  <i class="fa-solid fa-bars"></i>
                </div>
                <div class="cat-info">
                  <h3>Tatal Categories</h3>
                  <h5><?= !empty($nbr_categories)?$nbr_categories:0 ?></h5>
                </div>
              </div>
              <div class="categories">
                <div class="cat-icon">
                <i class="fa-solid fa-cubes"></i>
                </div>
                <div class="cat-info">
                  <h3>Tatal Produit</h3>
                  <h5><?= !empty($nbr_produits)?$nbr_produits:0 ?></h5>
                </div>
              </div>
            </div>
    
            </div>        

            
        </div>
    </div>

    <footer>
        All Copyright Reserver @2022
    </footer>
    <script>
        document.forms[0].firstElementChild.onchange=function (event) {
            if (event.target) {
                
                document.getElementById("btn-submit").form.submit();
            }
        }
    </script>
</body>
</html>