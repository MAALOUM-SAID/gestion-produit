<?php
    require_once '../Auth/auth.php';
    require_once '..\utile.php';
    require_once '..\connection.php';
    require_once '..\categorie\gestionCategorie.php';
    if ($_SERVER["REQUEST_METHOD"]==="POST") {
        $nom_cat=$description="";
        $id=-1;
        $errnom_cat=$errid=$errdescription="";
        $isvalid=true;
        if (isset($_POST["modifier"])) {
            if (isset($_POST["id"]) && !empty($_POST["id"])) {
                $id=UtilePerssistance::clean_input($_POST["id"]);
            }else{
                $errid="Ce champs est Obligatoire";
                $isvalid=false;
            }
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
                $categorie=new Categorie(pdo:$pdo,id:$id,nom_cat:$nom_cat,description_cat:$description);
                $categorie->modifier_categorie();
                $pdo=null;
                header("refresh:0;url=index.php?title=Les Categories");
            } catch (PDOException $err) {
                    $msg=$err->getMessage();
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
<main class="form-ajouter">
  <h2 class="h2-ajouterCat">Modifier categorie</h2>
  <form method="POST">
    <div class="input-ajCat div-input">
      <span>ID Categorie</span>
      <input type="text"  name="id" class="form-control" value="<?= isset($_GET['id'])?$_GET['id']:-1?>" readonly>
    </div>
    <div class="input-ajCat div-input">
      <span>Nom Categorie</span>
      <input type="text" name="nom_cat" value="<?= isset($_GET['nom_cat'])?$_GET['nom_cat']:""?>" id="floatingInput" placeholder="nom categorie">
    </div>
    <div class="tarea-ajCat">
      <span>description</span>
      <textarea name="description" cols="30" rows="10"><?= isset($_GET['descr'])?$_GET['descr']:""?></textarea>
    </div>
    <input value="Modifier" type="submit" name="modifier">
  </form>
</main> 
</div>
<div class="ajouter-image">
        <img src="../images/mcat.png" alt="product">
        <br>
    </div>   
    </div>
  </body>
  </html>