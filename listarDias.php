<?php
session_start();
if (!isset($_SESSION["usuario"])){
    header('Location: login.php');}
?>
 <script type="text/javascript" src="scripts.js"></script>


<html lang="es">
<head>
  <!-- Google Fonts Pre Connect -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <!-- Meta Tags -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Fonts Links (Roboto 400, 500 and 700 included)  -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
  <!-- CSS Files Links -->
  <link rel="stylesheet" href="css/styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.1/TweenLite.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.1/TimelineMax.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.1/TweenMax.min.js"></script>
  <!-- Title -->
  <title>Dias Seleccionados</title>
</head>
<body>
  <header>
    <h1>Días Seleccionados</h1>
  </header>
  <main>

    <form method="post" action="accionportada.php">
      <div class="segment">
          <button class="unit" name="home" type="submit" title="Home"><i class="material-icons" style="font-size:28px;">home</i></button>
          <button class="unit" name="settings" type="submit" title="Perfil"><i class="material-icons" style="font-size:28px;">settings</i></button>
          <button class="unit" type="submit" title="ayuda" aria-label="Ayuda" alt="ayuda" name="help"><i class="material-icons" style="font-size:28px;">help</i></button>

        </div>
        </form>

    <h6>Smart Programming & Design: Humberto Della Sala</h6>
  </main>

  <footer>
    <p></p>
  </footer>

  <noscript>Your browser don't support JavaScript!</noscript>
  <script src="scripts.js"></script>
</body>
</html>