<?php
     require_once '..\utile.php';
     require_once '..\connection.php';
     require_once "../Auth/gestionAdmins.php";
     if ($_SERVER["REQUEST_METHOD"]==="POST") {
        $pass_err=$email_err="border:1px solid";
        if (isset($_POST["signup"])) {
            if (isset($_POST["username"]) && !empty($_POST["username"])
                && isset($_POST["password"]) && !empty($_POST["password"])
                && isset($_POST["confirm_password"]) && !empty($_POST["confirm_password"])
                && isset($_POST["email"]) && !empty($_POST["email"])
                && isset($_FILES["profile_img"])
            ) {
                $username=UtilePerssistance::clean_input($_POST["username"]);
                $password=UtilePerssistance::clean_input($_POST["password"]);
                $cn_password=UtilePerssistance::clean_input($_POST["confirm_password"]);
                $email=UtilePerssistance::clean_input($_POST["email"]);
                $ok=false;
                $image=$_FILES['profile_img'];
                if ($password ===$cn_password) {
                    if ($image["size"]>0) {
                        move_uploaded_file(
                            $image['tmp_name'],
                            "../uploads/profile/" . $image["name"]
                        );
                        $image_path="../uploads/profile/".$image["name"];
                        $ok=true;
                    }
                    if ($ok) {
                        $pdo=Connection::connectToDB('gestionproduit');
                        Admin::ajouter_admin($pdo,$username,$password,$email,$image_path);
                        $pdo=null;
                        header("Location:../Auth/login.php");
                    }
                }else{
                    $pass_err="border:1px solid crimson;";
                }
                
                
            }
        }

     }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/login.css">

    <title>Document</title>
</head>
<body class="register-body">
    <div class="container-register">
        <div class="register-form">
            <h2>Create Account</h2>
            <form action="" method="post" enctype="multipart/form-data">
                    <div class="reg-input">
                        <input type="text" name="username" placeholder="username">
                    </div>
                    <div class="reg-input">
                        <input type="email" name="email" placeholder="admin@test.com">
                    </div>
                    <div class="reg-input">
                        <input type="password" name="password" placeholder="password">
                    </div>
                    <div class="reg-input">
                        <input type="password" name="confirm_password"  placeholder="confirm password" style="<?=$pass_err?>">
                    </div>
                    <div class="div-input">
                        <span>Image</span>
                        <label for="image">
                    <i class="fa-solid fa-image"></i>
                        <input type="file" id="image" name="profile_img" accept="image/*"  placeholder="">
                    </label>
                    </div>
                    <div class="buttons">
                        <a href="../Auth/login.php">
                        <button type="button">
                            SignIn
                        </button></a>
                        <input type="submit" value="SignUp" name="signup">
                       
                    </div>

            </form>
        </div>
        <div class="register-image">
            <img src="../images/register.png" alt="register">
        </div>
    </div>
</body>
</html>