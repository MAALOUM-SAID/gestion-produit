<?php
    require_once '../Auth/auth.php';
    require_once '..\produit\gestionproduit.php';
    require_once '..\connection.php';
    $id=isset($_GET['id'])?$_GET['id']:-1;
    $pdo=Connection::connectToDB("gestionproduit");
    $produit=new Produit(pdo:$pdo,id:$id);
    $result=$produit -> rechercher_image();
    if (file_exists($result)) {
        unlink($result);
    }
    $produit->supprimer_produit();
    $pdo=null;
    header("refresh:2;url=index.php");
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