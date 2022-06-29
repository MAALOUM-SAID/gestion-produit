<?php
    require_once '../Auth/auth.php';
class Categorie{
    private $pdo;
    private $id;
    private $nom_cat;
    private $description_cat;
    public function __construct(PDO $pdo,$id=null,$nom_cat=null,$description_cat=null){
        $this->pdo=$pdo;
        $this->id=$id;
        $this->nom_cat=$nom_cat;
        $this->description_cat=$description_cat;
    }
    // Getter And Setter
    public function get_pdo(){
        return $this->pdo;
    }
    public function set_pdo($nv_pdo){
        $this->pdo=$nv_pdo;
    }
    public function get_id(){
        return $this->id;
    }
    public function get_nom_cat(){
        return $this->nom_cat;
    }
    public function set_nom_cat($nv_nom_cat){
        $this->nom_cat=$nv_nom_cat;
    }
    public function get_description_cat(){
        return $this->description_cat;
    }
    public function set_description_cat($nv_description_cat){
        $this->description_cat=$nv_description_cat;
    }
    // ajouter categorie
    public function ajouter_categorie($admin_id){
        $sql="use gestionproduit;";
        $sql.="INSERT INTO categorie(nom_cat,descr,admin_id) VALUES (:nom,:description_cat,:admin_id)";
        $statement=$this->get_pdo()->prepare($sql);
        $statement->execute([
            ":admin_id"=>$admin_id,
            ":nom"=>$this->nom_cat,
            ":description_cat"=> $this->description_cat
        ]);
        return "categorie ajouté";
    }
    // Supprimer categorie
    public function supprimer_categorie(){
        $sql="DELETE FROM categorie WHERE id=:id";
        $statement=$this->pdo->prepare($sql);
        $statement->execute([
            ":id"=>$this->id
        ]);
    }
    // Update categorie
    public function modifier_categorie(){
        $sql="UPDATE categorie SET nom_cat=:nom_cat,descr=:description_cat WHERE id=:id";
        $statement=$this->pdo->prepare($sql);
        $statement->execute([
            ":id"=>$this->id,
            ":nom_cat"=>$this->nom_cat,
            ":description_cat"=>$this->description_cat
        ]);
    }
    // Recherche categorie
    public function recherchce_categorie_by_id($id){
        $sql="SELECT * FROM categorie WHERE id=:id";
        $statement=$this->pdo->prepare($sql);
        $statement->execute([
            ":id"=>$id
        ]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    // select categories
    public function afficher_categories(){
        $sql="SELECT * FROM categorie;";
        $result=$this->pdo->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    // Trier Les Categories
    public function trier_categories($column){
        $sql="SELECT * FROM categorie ORDER BY ". htmlspecialchars(stripslashes(trim($column))).";";
        $stmt=$this -> pdo -> prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // count les categories
    public function count_les_categories($admin_id){
        $sql="SELECT count(:admin_id) as nbr FROM categorie WHERE admin_id=:admin_id;";
        $stmt=$this -> pdo -> prepare($sql);
        $stmt->execute([
            ":admin_id" => $admin_id
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>