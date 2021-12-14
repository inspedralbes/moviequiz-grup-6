<?php

// magic constant
require_once (__DIR__ . "/../core/DBAbstractModel.php");

class usuari extends DBAbstractModel {
  
  private $id;
  private $nom;
  private $contrasena;
 // private $puntuacio;

  public $message;
  
  function __construct() {
    $this->db_name = "moviequiz6";
    }
  
  function __toString() {
    echo "entro string <br>";
    return "(" . $this->id . ", " . $this->nom . ", " . $this->contrasena  . ")";
  }
  
  function __destruct() {

  }
  
  //select dels camps passats de tots els registres
  //stored in $rows property
  public function selectAll($fields=array()) {
    
    $this->query="SELECT ";
    $firstField = true;
    for ($i=0; $i<count($fields); $i++) {
      if ($firstField) {
        $this->query .= $fields[$i];
        $firstField=false;
      }
      else $this->query .= ", " . $fields[$i];
    }
    $this->query .= " FROM usuari";
    $this->get_results_from_query();
    return $this->rows;
    
  }
  
  public function select($nom="") {
   
      $this->query = "SELECT id, nom, contrasena
                    FROM usuari
                    WHERE nom='$nom'";
      $this->get_results_from_query();
  
    if (count($this->rows)==1) {
      foreach ($this->rows[0] as $property => $value)
        $this->$property = $value;
     $this->message = "Persona trobada";
       
    } else  $this->message = "Persona no trobada";
    
    return $this->rows;
  }
  
  
  public function insert($user_data = array()) {
    
    if (array_key_exists("nom", $user_data)) {
      $this->select($user_data["nom"]);
      if ($user_data["nom"]!= $this->nom) {
        foreach ($user_data as $field => $value)
          $$field = $value;
        $this->query="INSERT INTO usuari( nom, contrasena)
                      VALUES ( '$nom', '$contrasena')";
        $this->execute_single_query();
        $this->message = "Usuari inserit amb èxit";
      } else $this->message = "Usuari ja existent";
    } else $this->message = "Usuari no inserit";
  }
  
  public function update ($userData = array()) {
   
  }
 
  public function delete ($nom="") {

  }
 
    
}

?>
