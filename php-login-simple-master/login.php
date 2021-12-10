<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /php-login');
  }
  require 'database.php';

  if (!empty($_POST['nom']) && !empty($_POST['contrasena'])) {
    $records = $conn->prepare('SELECT id, nom, contrasena FROM usuari WHERE nom = :nom');
    $records->bindParam(':nom', $_POST['nom']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';


  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>

  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Login</h1>
    <span>or <a href="signup.php">SignUp</a></span>

    <form action="login.php" method="POST">
      <input name="nom" type="text" placeholder="Enter your name">
      <input name="contrasena" type="password" placeholder="Enter your Password">
      <input type="submit" value="Submit">
    </form>
  </body>
</html>
