<?php
    require_once '../Auth/auth.php';
    require_once '../Auth/gestionAdmins.php';
    require_once '../connection.php';
    require_once '..\utile.php';
    require_once '..\connection.php';
    require_once '..\categorie\gestionCategorie.php';
    if (!isset($_SESSION["username"])) {
        header('refresh:0;url=../Auth/logout.php');
    }
    $pdo=Connection::connectToDB("gestionproduit");
    $categorie=new Categorie(pdo:$pdo);
    // order categories
    if (isset($_GET["order"])) {
        $categories=$categorie -> trier_categories($_GET["order"]);
    }else{
    $categories=$categorie->afficher_categories();
    }
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once '../template/head.php'?>
<body id="#main-body">
    <div class="my-container">
      <?php include_once '../template/aside.php'?>
          <div class="dashboard">
            <?php include_once '../template/header.php'?>
<div class="filter-data-form">
                <form action="" method="GET">
                    <div class="input-order">
                        <input type="text" name="title" value="Les Categories" style="display:none">
                        <select name="order">
                        <?php foreach($categories[0] as $key => $item){?>
                            <option value="<?=$key?>"><?=$key?></option>
                        <?php }?>
                        </select>
                    </div>
                    <button type="submit">
                        <i class="fa-solid fa-sort"></i>
                    </button>
                </form>
</div>
<div class="table-container">
          <table id="customers">
          <thead>
            <tr>
              <tr>
                <th >Id</th>
                <th >categorie</th>
                <th >Description</th>
                <th >Admin</th>
                <th  colspan='2' >Action</th>
            </tr>
            </tr>
          </thead>
          <tbody>
            <?php foreach($categories as $value){?>
              <tr>
                  <?php foreach($value as $key => $element){?>
                      <td >
                          <?php
                          if ($key ==="admin_id") {
                            $pdo=Connection::connectToDB("gestionproduit");
                            echo Admin::recherche_admin_username($pdo,$value[$key])->username;
                          }else{
                              echo  $element;
                          }
  
                          ?>
                      </td>
                  <?php }?>
                  <td class="text-center">
                    <a href="supprimerCat.php?id=<?=$value['id']?>" onclick="confirmer()"><i class="fa-solid fa-trash" id="supprimer"></i></a>
                  </td>
                  <?php $query=http_build_query($value);?>
                  <td class="text-center">
                      <a href="modifierCat.php?<?=$query?>"><i class="fa-solid fa-pen-to-square" id="modifier"></i></a>
                  </td>
              </tr>
          <?php }?>
          </tbody>
  </table>
</div>
            <div class="btn-ajouter">
                <a href="../categorie/ajouterCat.php">
                <i class="fa-solid fa-plus"></i>
                    Categorie
                </a>
            </div>
        </div>
    </div>
    <footer>
        All Copyright Reserver @2022
    </footer>
</body>
</html>