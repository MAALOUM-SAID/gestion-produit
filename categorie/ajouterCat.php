<?php
require_once '../Auth/auth.php';
require_once '../Auth/gestionAdmins.php';
 require_once '..\utile.php';
 require_once '..\connection.php';
 require_once '..\categorie\gestionCategorie.php';
    if ($_SERVER["REQUEST_METHOD"]==="POST") {
        $nom_cat=$description="";
        $errnom_cat=$errdescription="";
        
        $isvalid=true;
        if (isset($_POST["ajouter"])) {
            if (isset($_POST["nom_cat"]) && !empty($_POST["nom_cat"])) {
                $nom_cat=UtilePerssistance::clean_input($_POST["nom_cat"]);
            }else{
                $errnom_cat="Ce champs est Obligatoire";
                $isvalid=false;
            }
            if (isset($_POST["description"]) && !empty($_POST["description"])) {
                $description=UtilePerssistance::clean_input($_POST["description"]);
            }else{
                $errdescription="Ce champs est Obligatoire";
                $isvalid=false;
            }
            if ($isvalid) {
                try {
                  $pdo=Connection::connectToDB("gestionproduit");
                  $admin_id=Admin::recherche_admin_id($pdo,$_SESSION['username'])->id;
                  $categorie=new Categorie(pdo:$pdo,nom_cat:$nom_cat,description_cat:$description);
                  $categorie->ajouter_categorie($admin_id);
                  $pdo=null;
                } catch (PDOException $th) {
                  $err=$th -> getMessage();
                  $display="style=display:block";
                }
            }
        }
    }
?>
<!doctype html>
<html lang="en">
<?php include_once '../template/head.php' ?>
  <body class="text-center">
<?php include_once '../template/navbar.php' ?>
<div class="my-body">
<div class="err-box" <?=isset($display)?$display:"style=display:none;"?>>
<div class="d-flex">
<div class="toast-body">
        <?=isset($error)?$error:""?>
        </div>
    </div>
</div>
  <div class="conatiner-ajouter">
<main class="form-ajouter">
  <h2 class="h2-ajouterCat">Ajouter categorie</h2>
  <form method="POST">
    <div class="input-ajCat div-input">
      <span>Nom Categorie</span>
      <input type="text" name="nom_cat" placeholder="nom categorie">
    </div>
    <div class="tarea-ajCat">
      <span>description</span>
      <textarea name="description" cols="30" rows="10"></textarea>
    </div>
    <input value="Ajouter" type="submit" name="ajouter">
  </form>
</main> 
</div>
<div class="ajouter-image">
        <img src="../images/ajcat.png" alt="product">
        <br>
    </div>   
    </div>   
  </body>
</html>
