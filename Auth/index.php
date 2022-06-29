<?php
    require_once '../Auth/auth.php';
    require_once '..\utile.php';
    require_once '../connection.php';
    require_once  '../Auth/gestionAdmins.php';   
    $pdo=Connection::connectToDB("gestionproduit");
    $admins=Admin::afficher_admins($pdo);
?>
<!doctype html>
<html lang="en">
  <?php include_once '../template/head.php' ?>
<body id="#main-body">
<div class="my-container">
<?php include_once '../template/aside.php'?>
<main class="dashboard">
<?php include_once '../template/header.php'?>
      <div class="table-container">
          <table id="customers">
            <thead>
            <tr>
              <tr>
                <th  >Id</th>
                <th >username</th>
                <th  >email</th>
            </tr>
            </tr>
          </thead>
          <tbody>
            <?php foreach($admins as $item){?>
              <tr>
                      <td class="p-3">
                          <?php
                          echo  $item->id;
                          ?>
                      </td>
                      <td class="p-3">
                          <?php
                          echo  $item->username;
                          ?>
                      </td class="p-3">
                      <td class="p-3">
                        <?php
                          echo  $item->email;
                          ?>
                      </td>
                    </tr>
                    <?php }?>
                  </tbody>
                </table>
                </div>
</div>
      </div>
      </div>
    </main>
  </div>
</div>
<?php require_once '../template/footer.php'?>
  </body>
</html>
