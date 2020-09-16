<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /php-login');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /wagen");
    } else {
      $message = 'Las credenciales son incorrectas';
    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Iniciar sesión</title>
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
    <h1>Inciar Sesión</h1>
    <span>o <a href="signup.php">Crear cuenta</a></span>

    <form action="login.php" method="POST">
      <input name="email" type="text" placeholder="Escribe tu Email">
      <input name="password" type="password" placeholder="Escribe tu Password">
      <input type="submit" value="Entrar" class="btn--rojo">
    </form>
  </body>
</html>
