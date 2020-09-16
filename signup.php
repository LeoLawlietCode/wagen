<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
      $message = 'Usuario creado satisfactoriamente';
    } else {
      $message = 'Lo siento, hubo un error al crear tu cuenta';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registrarse</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e3617513b6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" type="image/png" href="sources/favicon.png">
  </head>
  <body>
    <a href="index.php">
      <i class="fas fa-arrow-left flecha"></i>
    </a>
    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <img src="sources/logo.png" class="img-logo">
    <h1>Registrarse</h1>
    <span>o <a href="login.php">Incicar sesión</a></span>

    <form action="signup.php" method="POST">
      <input name="nombre" type="text" placeholder="Escribe tu nombre" require>
      <input name="email" type="text" placeholder="Escribe tu Email" require>
      <input name="password" type="password" placeholder="Ingresa una Contraseña" require>
      <input name="confirm_password" type="password" placeholder="Confirmar Contraseña" require>
      <input type="submit" value="Submit" class="btn--rojo">
    </form>

  </body>
</html>
