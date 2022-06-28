<?php
require_once '../connection.php';
require_once '../utile.php';
session_start();
if ($_SERVER["REQUEST_METHOD"]==="POST") {
    if (isset($_POST["login"])) {
        if (isset($_POST["username"]) && !empty($_POST["username"])&&
         isset($_POST["password"]) && !empty($_POST["password"])
        ) {
            $username=UtilePerssistance::clean_input($_POST["username"]);
            $password=UtilePerssistance::clean_input($_POST["password"]);
            $pdo=Connection::connectToDB("gestionproduit");
            $sql="SELECT * FROM login WHERE username=:username AND password=:passwod";
            $stmt=$pdo -> prepare($sql);
            $stmt -> execute([
                ':username'=>$username,
                ':passwod'=>sha1($password)
            ]);
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result) {
                $_SESSION['username']=$username;
                $_SESSION['password']=$password;
                header('Location: ../Auth/profile.php');
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
    <title>ofppt shop</title>
</head>
<body id="my-body">
    <div class="login-container">
        <form action="" method="post">
        <div class="my-card">
            <div class="card-title">
                <h5>Login</h5>
            </div>
            <div class="input-user">
                <span class="icon">
                    <i class="fa-solid fa-user"></i>
                </span>
                <input type="text" name="username" placeholder="Username">
            </div>
            <div class="input-user">
            <span class="icon">
            <i class="fa-solid fa-key"></i>
                </span>
            <input type="password" name="password" placeholder="Password">
            </div>
            <div class="input-submit">
                <button type="submit" name="login">SignIn</button>
            </div>
            <a href="../Auth/register.php" class="register">register</a>
        </div>
        </form>
    </div>
    <div class="image">
        <img src="../images/store.jpg" alt="store">
    </div>
</body>
</html>