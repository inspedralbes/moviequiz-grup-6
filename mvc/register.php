<?php
    require_once('Usuari.php');

    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $confirmpassword = $_REQUEST['confirmpassword'];

    if($username != "" && $password != "" && $confirmpassword != ""){
        $user = new Usuari();

        if(($user->existeixUsuari($username) == false) && ($password == $confirmpassword)){
            $password = sha1($password);

            $resultUser = $user->registrar($username, $password);

            if($resultUser == false){
                echo "FAIL";
            } else {
                echo "OK";
            }

        } else {
            echo "REGISTRO INCORRECTO";
        }

    } else {
        echo "VACIO";
    }

?>