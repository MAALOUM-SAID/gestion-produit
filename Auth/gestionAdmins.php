<?php
    class Admin{
        public static function ajouter_admin($pdo,$username,$password,$email,$image_path){
            $sql="INSERT INTO login(username,password,email,profile_img) 
                    VALUES(:username,:passwrd,:email,:img);";
            $stmt=$pdo->prepare($sql);
            $stmt->execute([
                ":username" => $username,
                ":passwrd" => sha1($password),
                ":email" => $email,
                ":img" => $image_path
            ]);
        }
        public static function supprimer_admin($pdo,$id){
            $sql="DELETE FROM login WHERE id=:id;";
            $stmt=$pdo -> prepare($sql);
            $stmt -> execute(
                [
                    ':id' => $id
                ]
            );
        }
        public static function afficher_admins($pdo){
            $sql="SELECT * FROM login;";
            $result=$pdo -> query($sql);
            return $result -> fetchAll(PDO::FETCH_OBJ);
        }
        public static function recherche_admin_id($pdo,$username){
            $sql="SELECT id FROM login WHERE username=:username";
            $stmt=$pdo -> prepare($sql);
            $stmt -> execute([
                ":username" => $username
            ]);
            return $stmt -> fetch(PDO::FETCH_OBJ);
        }
        public static function recherche_admin_username($pdo,$id){
            $sql="SELECT username FROM login WHERE id=:id";
            $stmt=$pdo -> prepare($sql);
            $stmt -> execute([
                ":id" => $id
            ]);
            return $stmt -> fetch(PDO::FETCH_OBJ);
        }
        public static function recherche_email_admin_username($pdo,$username){
            $sql="SELECT email FROM login WHERE username=:username";
            $stmt=$pdo -> prepare($sql);
            $stmt -> execute([
                ":username" => $username
            ]);
            return $stmt -> fetch(PDO::FETCH_OBJ);
        }
        public static function recherche_image_admin_username($pdo,$username){
            $sql="SELECT profile_img FROM login WHERE username=:username";
            $stmt=$pdo -> prepare($sql);
            $stmt -> execute([
                ":username" => $username
            ]);
            return $stmt -> fetch(PDO::FETCH_OBJ);
        }
        public static function change_profile_image($pdo,$image_path,$username){
            $sql="UPDATE login SET profile_img=:img WHERE username=:username";
            $stmt=$pdo -> prepare($sql);
            $stmt -> execute([
                ":username" => $username,
                ":img" => $image_path
            ]);
        }
    }
?>