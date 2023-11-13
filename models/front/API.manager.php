<?php
//je cree ma classe APIManager

require_once "models/Model.php";

//en mettant extends j'ai acces a ma fonction protected getBdd
class APIManager extends Model{

    //je cree ma fonction
    public function getDBAnimaux(){
      $req = "SELECT 
    a.animal_id, a.animal_nom, a.animal_description, a.animal_image, a.famille_id, 
    f.famille_id, f.famille_libelle, f.famille_description,
    ac.animal_id, ac.continent_id,
    c.continent_id, c.continent_libelle
FROM animal a 
INNER JOIN famille f ON f.famille_id = a.famille_id  
INNER JOIN animal_continent ac ON ac.animal_id = a.animal_id 
INNER JOIN continent c ON c.continent_id = ac.continent_id;
";
      $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $animaux;

    }
    public function getDBAnimal($idAnimal){
        $req = "SELECT 
    a.animal_id, a.animal_nom, a.animal_description, a.animal_image, a.famille_id, 
    f.famille_id, f.famille_libelle, f.famille_description,
    ac.animal_id, ac.continent_id,
    c.continent_id, c.continent_libelle
FROM animal a 
INNER JOIN famille f ON f.famille_id = a.famille_id  
INNER JOIN animal_continent ac ON ac.animal_id = a.animal_id 
INNER JOIN continent c ON c.continent_id = ac.continent_id
WHERE a.animal_id = :idAnimal
";
        $stmt = $this->getBdd()->prepare($req);
        //bindvalue me permet de securiser et eviter les injections sql
        $stmt->bindValue(":idAnimal", $idAnimal, PDO::PARAM_INT);
        $stmt->execute();
        $lignesAnimal = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $lignesAnimal;
    }
    public function getDBFamilles(){
        $req = "SELECT famille_id, famille_libelle, famille_description FROM famille";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $familles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $familles;
    }
    public function getDBContinents(){
        $req = "SELECT continent_id, continent_libelle FROM continent";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $continents = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $continents;
    }
}