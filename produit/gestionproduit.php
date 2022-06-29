<?php
    require_once '../Auth/auth.php';
    class Produit{
        private $pdo;
        private $id;
        private $designation;
        private $prix_unitaire;
        private $qte_stock;
        private $id_cat;
        private $image_path;
        private $admin_id;
        public function __construct(PDO $pdo,$id=null,$designation=null,$prix_unitaire=null,$qte_stock=null,$id_cat=null,$image_path=null,$admin_id=null){
            $this->pdo=$pdo;
            $this->id=$id;
            $this->designation=$designation;
            $this->prix_unitaire=$prix_unitaire;
            $this->qte_stock=$qte_stock;
            $this->id_cat=$id_cat;
            $this->image_path=$image_path;
            $this->admin_id=$admin_id;
        }
        // Getter And Setter
        public function get_pdo(){
            return $this->pdo;
        }
        public function set_pdo($nv_pdo){
            $this->pdo=$nv_pdo;
        }
        // Ajouter Produit
        public function ajouter_produit(){
            $sql="INSERT INTO produit(designation,pu,qtstock,id_cat,image_path,admin_id) VALUES (:designation,:pu,:qte,:id_cat,:image_path,:admin_id);";
            $statement=$this->pdo->prepare($sql);
            $statement->execute(
                [
                    ":designation"=>$this->designation,
                    ":pu"=>$this->prix_unitaire,
                    ":qte"=>$this->qte_stock,
                    ":id_cat"=>$this->id_cat,
                    ":image_path"=>$this->image_path,
                    ":admin_id"=>$this->admin_id
                ]
            );
        }
        // Supprimer un produit
        public function supprimer_produit(){
            $sql="DELETE FROM produit WHERE id=:id;";
            $statement=$this->pdo->prepare($sql);
            $statement->execute(
                [
                    ":id"=>$this->id,
                ]
            );
        }
        // Modifier un Produit
        public function modifier_produit(){
            if ($this->image_path==null) {
                $sql="UPDATE produit 
                      SET designation=:designation,pu=:pu,qtstock=:qte,id_cat=:id_cat
                      WHERE id=:id;
                      ";
                $statement=$this->pdo->prepare($sql);
                $statement->execute(
                    [
                        ":id"=>$this->id,
                        ":designation"=>$this->designation,
                        ":pu"=>$this->prix_unitaire,
                        ":qte"=>$this->qte_stock,
                        ":id_cat"=>$this->id_cat,
                    ]
                );
            }else{
                $sql="UPDATE produit 
                      SET designation=:designation,pu=:pu,qtstock=:qte,id_cat=:id_cat,image_path=:image_path
                      WHERE id=:id;
                      ";
                $statement=$this->pdo->prepare($sql);
                $statement->execute(
                    [
                        ":id"=>$this->id,
                        ":designation"=>$this->designation,
                        ":pu"=>$this->prix_unitaire,
                        ":qte"=>$this->qte_stock,
                        ":id_cat"=>$this->id_cat,
                        ":image_path"=>$this->image_path
                    ]
                );
            }
        }
        // Recherche Produit
        function rechercher_produit($id){
            $sql="SELECT * FROM produit WHERE id=:id";
            $statement=$this->pdo->prepare($sql);
            $statement->execute([
                ':id'=>$id
            ]);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        // Rechecher d'image d'un produit
        public function rechercher_image(){
            $sql="SELECT image_path FROM produit
                WHERE id=:id
             ";
            $stmt=$this -> pdo -> prepare($sql);
            $stmt -> execute([
                ":id" => $this -> id
            ]);
            return $stmt -> fetch(PDO::FETCH_OBJ) -> image_path;
        }
        // Recherche by categorie
        public function rechercher_produit_en_categorie($id_cat){
            $sql="SELECT * FROM produit WHERE id_cat=:id_cat";
            $stmt=$this -> pdo -> prepare($sql);
            $stmt -> execute([
                ":id_cat" => $id_cat
            ]);
            return $stmt -> fetchAll(PDO::FETCH_OBJ);
        }
        // SELECT images
        public function selectionner_images(){
            $sql="SELECT image_path FROM produit;";
            $result=$this->pdo->query($sql);
            return $result->fetchAll(PDO::FETCH_OBJ); 
        }
        // SELECT images
        public function selectionner_images_id_cat($id_cat){
            $sql="SELECT image_path FROM produit
                 WHERE id_cat=:id_cat 
            ;";
            $stmt=$this -> pdo -> prepare($sql);
            $stmt -> execute([
                ":id_cat" => $id_cat
            ]);
            return $stmt ->fetchAll(PDO::FETCH_ASSOC);
            
        }
        // count Produit by id admin 
        function count_les_produits($admin_id){
            $sql="SELECT count(admin_id) as nbr FROM produit
                WHERE admin_id=:admin_id
            ;";
            $stmt=$this -> pdo -> prepare($sql);
            $stmt -> execute([
                ":admin_id" => $admin_id
            ]);
            return $stmt -> fetch(PDO::FETCH_ASSOC);
        }
        // count Categorie by id admin 
        function count_les_categories($admin_id){
            $sql="SELECT count(DISTINCT id_cat) as nbr FROM produit
                WHERE admin_id=:admin_id;
            ";
            $stmt=$this -> pdo -> prepare($sql);
            $stmt -> execute([
                ":admin_id" => $admin_id
            ]);
            return $stmt -> fetch(PDO::FETCH_ASSOC);
        }
        // afficher les produits
        function afficher_les_produits(){
            $sql="SELECT * FROM produit;";
            $result=$this->pdo->query($sql);
            return $result->fetchAll(PDO::FETCH_OBJ); 
        }
        // trier les produits
        public function trier_produits($column){
            $sql="SELECT * FROM produit ORDER BY ". htmlspecialchars(stripslashes(trim($column))).";";
            $stmt=$this -> pdo -> prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }


    }
?>