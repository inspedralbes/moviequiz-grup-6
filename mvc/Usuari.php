<?php
    include "DBAbstractModel.php";

    class Usuari extends DBAbstractModel {
        function __construct(){
            $this->db_name = "moviequiz6";
        }
    }

    public function registrar ($username, $password){
        $this->query = "INSERT INTO usuari (nom, contrasena) VALUES ('$username', '$password')";
        $this->execute_single_query();

        return $this->iniciarSessio($username, $password);
    }

    public function existeixUsuari ($username){
        $this->query = "SELECT * FROM usuari WHERE nom='$username'";
        $this->get_results_from_query();

        if(count($this->rows)==1){
            foreach ($this->rows[0] as $property => $value)
            $this-> $property = $value;
             return $this->rows;
        } else {
            return false;
        }
    }

?>