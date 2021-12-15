<?php

  require_once('model.php');

  if(!empty($_POST['nom']) && !empty($_POST['contrasena'])) {
    $comp = array ("nom" => $_POST['nom'],"contrasena" => $_POST['contrasena']);
    $user2 = new users();
    $usuario = $user2->select($comp["nom"]);

    if($_POST['contrasena'] == $usuario[0]['contrasena']) {
      session_start();
      $arr = array('exito' => true, 'nom' => $usuario[0]['nom'], "apellido" => $usuario[0]['apellido'], "correo" => $usuario[0]['correo']);
      $_SESSION['usuario'] = $arr;
      $myJSON = json_encode($arr);
      echo $myJSON;
    }
    else {
      session_start();
      $arr = array('exito' => false, 'correo' => $usuario[0]['correo'], "contrasena" => $usuario[0]['contrasena']);
      $myJSON = json_encode($arr);
      echo $myJSON;
    }
  }
  else echo "No funciona";
?>