<?php

// magic constant
require_once (__DIR__ . "/../core/DBAbstractModel.php");

class usuari extends DBAbstractModel {
  
  private $id;
  private $nom;
  private $contrasenya;
  private $email;
 // private $puntuacio;

  public $message;
  
  function __construct() {
    $this->db_name = "moviequiz6";
    }
  
  function __toString() {
    echo "entro string <br>";
    return "(" . $this->id . ", " . $this->nom . ", " . $this->contrasenya  . ", " . $this->email .")";
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
   
      $this->query = "SELECT id, nom, contrasenya, email
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


      $nom = $user_data["nom"];
      $contrasenya = $user_data["contrasenya"];
      //$passHash = password_hash($contrasenya, PASSWORD_BCRYPT);
      $email = $user_data["email"];

        $this->query="INSERT INTO usuari(nom, contrasenya, email)
          VALUES ('$nom', '$contrasenya', '$email')";
        $this->execute_single_query();
        $this->message = "Usuari inserit amb èxit";
      
  }
}
  public function login(){
    if(!empty($_POST['nom']) && !empty($_POST['contrasenya'])) {
      $comp = array ("nom" => $_POST['nom'],"contrasenya" => $_POST['contrasenya']);
      $user2 = new usuari();
      $usuario = $user2->select($comp["nom"]);

      if($_POST['contrasenya'] == $usuario[0]['contrasenya']) {
        session_start();
        $arr = array($usuario[0]['nom']);
        $_SESSION['usuario'] = $arr;
        $myJSON = json_encode($arr);
        echo  "Bienvenido $myJSON";
      }
      else {
        session_start();
        $arr = array('exito' => false, 'correo' => $usuario[0]['correo'], "contrasenya" => $usuario[0]['contrasenya']);
        $myJSON = json_encode($arr);
        echo $myJSON;
      }
    }
    else echo "No funciona";
  }
  public function update ($userData = array()) {
   
  }
 
  public function delete ($nom="") {

  }
 
    
}

?>
