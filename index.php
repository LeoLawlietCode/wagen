<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e3617513b6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" type="image/png" href="sources/favicon.png">
    <?php if(!empty($user)): ?>
    <title>Wagen</title>
    <?php else: ?>
    <title>Las mejores peliculas desde tu auto - Wagen</title>
    <?php endif; ?>
  </head>
  <body>
    <?php if(!empty($user)): ?>
      <br> Welcome. <?= $user['email']; ?>
      <br>You are Successfully Logged In
      <a href="logout.php">
        Logout
      </a>
    <?php else: ?>
      <?php require 'partials/header.php' ?>
      <section class="section-principal">
        <div class="container-p container-p--titulo">
          <h1>Las mejores series y películas en la comodidad de tu AUTO</h1>
          <h2>Únete a la comunidad de autocine <b>wagen</b></h2>
          <a href="login.php" class="btn btn--rojo">Iniciar sesión</a>
          <a href="signup.php" class="btn">Registrarse</a>
        </div>
        <div class="container-p container-p--imagen">
          <img src="sources/bg_banner_principal.png" alt="">
        </div>
      </section>

      <section class="proyecta-carro--main">
        <div class="proyecta-carro">
          <img class="carro-proyecta" src="sources/carro_proyecta.png" alt="">
          <section class="horizontal-scroll--main">
            <aside class="horizontal-scroll--display">
                <div class="pelicula-scroll pelicula-scroll--primero">
                    <img src="sources/p_wallstreet.jpg" alt="">
                </div>
                <div class="pelicula-scroll">
                    <img src="sources/p_laberinto.jpg" alt="">
                </div>
                <div class="pelicula-scroll">
                    <img src="sources/leocine/doctor_strange.jpg" alt="">
      
                </div>
                <div class="pelicula-scroll">
                    <img src="sources/leocine/capitan_america_2.jpg" alt="">
        
                </div>
                <div class="pelicula-scroll">
                    <img src="sources/leocine/spider_man.jpg" alt="">
                </div>
                <div class="pelicula-scroll">
                    <img src="sources/leocine/thor.jpg">
                </div>
                <div class="pelicula-scroll">
                    <img src="sources/leocine/guardianes_galaxia.jpg" alt="">
                </div>
                <div class="pelicula-scroll">
                    <img src="sources/leocine/ant-man-el-hombre-hormiga.jpg" alt="">
                </div>
                <div class="pelicula-scroll pelicula-scroll--ultimo">
                    <img src="sources/leocine/thor_ragnarok.jpg" alt="">
                </div>
            </aside>
          </section>
        </div>
      </section>

    <?php endif; ?>
  </body>
</html>