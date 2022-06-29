<?php
    require_once '../Auth/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once '../template/head.php'?>
<body id="#main-body">
    <div class="my-container">
      <?php include_once '../template/aside.php'?>
          <div class="dashboard">
            <?php include_once '../template/header.php'?>
            <?php
    require_once '..\utile.php';
    require_once '..\connection.php';
    require_once  '..\produit\gestionproduit.php';
    require_once '..\categorie\gestionCategorie.php'; 
    $pdo=Connection::connectToDB("gestionproduit");
    // select produit
    $produit=new Produit(pdo:$pdo);
    if (isset($_GET["order"])) {
      $produits=$produit->trier_produits($_GET["order"]);
      
    }else $produits=$produit->afficher_les_produits();
?>
<div class="filter-data-form">
                <form action="" method="GET">
                    <div class="input-order">
                    <input type="text" name="title" value="Les Produits" style="display:none">
                        <select name="order">
                        <?php foreach($produits as $produit){?>
                        <?php foreach($produit as $key =>$value){?>
                          <?php if(!($key==="image_path" || $key==="admin_id")):?>
                            <option value="<?=$key?>"><?=$key==="id_cat"?"categorie":$key;?></option>
                          <?php endif?>
                        <?php }?>
                        <?php break;?>
                        
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
                <th >Designation</th>
                <th >Prix Unitaire</th>
                <th >Quantite en Stock</th>
                <th >categorie</th>
                <th  colspan='2' >Action</th>
            </tr>
            </tr>
          </thead>
          <tbody>
            <?php foreach($produits as $produit){?>
              <tr>
                      <td >
                          <?php
                          echo  $produit->id;
                          ?>
                      </td>
                      <td >
                          <?php
                          echo  $produit->designation;
                          ?>
                      </td >
                      <td >
                        <?php
                          echo  $produit->pu;
                          ?>
                      </td>
                      <td >
                        <?php
                          echo  $produit->qtstock;
                          ?>
                      </td>
                      <td >
                        <?php
                          $categorie=new Categorie(pdo:$pdo);
                          echo  $categorie->recherchce_categorie_by_id($produit->id_cat)['nom_cat'];
                          ?>
                      </td>
                      <td >
                        <a href="supprimerPrd.php?id=<?=$produit->id?>" onclick="confirmer(event)"><i class="fa-solid fa-trash" id="supprimer"></i></a>
                      </td>
                      <?php $query=http_build_query($produit);?>
                      <td >
                        <a href="modifierPrd.php?<?=$query?>"><i class="fa-solid fa-pen-to-square" id="modifier"></i></a>
                      </td>
                    </tr>
                    <?php }?>
                  </tbody>
  </table>
</div>
            <div class="btn-ajouter">
                <a href="../produit/ajouterPrd.php">
                <i class="fa-solid fa-plus"></i>
                    Produit
                </a>
            </div>
        </div>
    </div>
    <?php require_once '../template/footer.php'?>
  

</body>
</html>