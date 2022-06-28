CREATE DATABASE gestionproduit;
USE gestionproduit;
CREATE TABLE login(
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    profile_img VARCHAR(255)
);
CREATE TABLE categorie(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom_cat VARCHAR(255) NOT NULL UNIQUE,
    descr VARCHAR(1000) NOT NULL,
    admin_id INT NOT NULL,
    CONSTRAINT pk FOREIGN KEY (admin_id) REFERENCES login(id)
    ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE produit(
    id INT PRIMARY KEY AUTO_INCREMENT,
    designation VARCHAR(255) NOT NULL UNIQUE,
    pu DOUBLE NOT NULL,
    qtstock INT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    id_cat INT NOT NULL,
    admin_id INT NOT NULL,
    CONSTRAINT pk1 FOREIGN KEY (id_cat) REFERENCES categorie(id)
    ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT pk2 FOREIGN KEY (admin_id) REFERENCES login(id)
    ON DELETE CASCADE ON UPDATE CASCADE
);

-- REMPLIR LES TABLAUX
-- table categorie
INSERT INTO login(username,password,email,profile_img) 
VALUES ("admin",SHA1("admin"),"test@ofppt.ma","../uploads/profile/face.gif");
INSERT INTO categorie (nom_cat,descr,admin_id) 
VALUES("sport","Le Lorem Ipsum est simplement du faux texte employe dans la composition et la mise en page avant impression",1);
INSERT INTO categorie (nom_cat,descr,admin_id) 
VALUES("gaming","Le Lorem Ipsum est simplement du faux texte employe dans la composition et la mise en page avant impression",1);
INSERT INTO categorie (nom_cat,descr,admin_id) 
VALUES("technologie","Le Lorem Ipsum est simplement du faux texte employe dans la composition et la mise en page avant impression",1);
INSERT INTO categorie (nom_cat,descr,admin_id) 
VALUES("Clothes","Le Lorem Ipsum est simplement du faux texte employe dans la composition et la mise en page avant impression",1);
-- Table Login
-- table produit
INSERT INTO produit(designation,pu,qtstock,id_cat,admin_id,image_path) 
VALUES ("football",1500,5,1,1,"../uploads/produits/foot.jpg");
INSERT INTO produit(designation,pu,qtstock,id_cat,admin_id,image_path) 
VALUES ("Azus Rog",1500,5,2,1,"../uploads/produits/azusrog.jpg");
INSERT INTO produit(designation,pu,qtstock,id_cat,admin_id,image_path) 
VALUES ("Red Magic",2500,4,3,1,"../uploads/produits/redmagic.jpg");
INSERT INTO produit(designation,pu,qtstock,id_cat,admin_id,image_path) 
VALUES ("T-Shirt XL",10500,2,4,1,"../uploads/produits/t-shirt.jpg");
