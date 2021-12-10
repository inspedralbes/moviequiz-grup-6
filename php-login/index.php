<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, nom, password FROM usuari WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $usuari = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Movie Hub</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <div class="container">
        <div class="row">
            <div class="col s9">
                <!-- <img src="/img/logomoviehub.png" alt="moviehub" id="logo"> -->
               <h1>Movie quiz</h1> 
            </div>
            <div id="divLogin" class="col s3">
                <label for="username">Usuari</label>
                <input type="text" id="username" name="text" value="">
                <label for="username">Contrasenya</label>
                <input type="password" id="pwd" name="text" value="">
                <button onclick="location.href='/php-login/login.php'" id="btnLogin" class="waves-effect waves-light btn" >Entra</button>
                <button onclick="location.href='/php-login/signup.php'" id="btnResgistre" class="waves-effect waves-teal btn-flat">Registra't</button>
            </div>        

            <div id="divSearch" class="col s3"> 
                <!-- class="oculto1" -->
                <label for="nompeli">Escriu el nom de la pel·licula que vulguis trobar: </label><br><br>
                <input type="text" id="search" name="text" value="">
                <button id="btnSearch" class="waves-effect waves-light btn">Buscar</button>
            </div>
        
            <div id="items" class="col s12">
            
            </div>
        </div>
    </div>
    
  </body>
</html>
