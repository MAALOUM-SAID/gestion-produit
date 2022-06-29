<?php
    require_once '../connection.php';
    require_once '../Auth/gestionAdmins.php';
    $done=false;
    $username=$_GET['username'];
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
        unlink($_GET["change"]);
        header("Location:../Auth/profile.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once '../template/head.php'?>
<body>
    <div class="image-change-container">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="image_prf"> 
            <input type="submit" value="Change">
        </form>
    </div>
</body>
</html>