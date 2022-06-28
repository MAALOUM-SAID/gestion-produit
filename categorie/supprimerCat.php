<?php
require_once '../Auth/auth.php';
 require_once '..\utile.php';
 require_once '..\connection.php';
 require_once '..\categorie\gestionCategorie.php';
 require_once '..\produit\gestionproduit.php';
    $id=isset($_REQUEST["id"])?$_REQUEST["id"]:-1;
   try {

    $pdo=Connection::connectToDB("gestionproduit");
    // categorie
    $categorie=new Categorie(pdo:$pdo,id:$id);
    //  produit
    $produit=new Produit(pdo:$pdo);

    $images=$produit -> selectionner_images_id_cat($_GET['id']);
    foreach ($images as $image) {
       if (file_exists($image["image_path"])) {
          unlink($image["image_path"]);
         }
      }
   $categorie->supprimer_categorie();
    $pdo=null;
    header("refresh:3;url=index.php");
   } catch (PDOException $err) {
        $msg=$err->getMessage();
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete page</title>
    <style>
        body{
            width:100%;
            height:90vh;
            background:url("../images/garbage.jpg") no-repeat;
            background-size: cover;
            background-position: center;
        }
        span{
            color:crimson;
            font-size:3em;
            font-family:'cursive';
        }
    </style>
</head>

<body>
    <span>
        En cours De traitement ...
    </span>
</body>
</html>