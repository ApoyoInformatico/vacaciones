<?php
session_start();
if (isset($_SESSION["usuario"])){
    header('Location: aplicacion.php');}





//echo "<h4>El email y/o la contraseña son incorrectos</h4>";
?>
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
  
  <!-- scripts Files Links -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.1/TweenLite.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.1/TimelineMax.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.1/TweenMax.min.js"></script>
  <!-- Title -->
  <title>login</title>
</head>
<body>
  <header>
    <h1></h1>
  </header>

  <main>
    <form method="post" action="validacion.php">
        <div class="segment">
          <h1>Ingresar</h1>
        </div>
        
        <label>
          <input id="txtDni" name="txtDni" type="text" placeholder="DNI"/>
        </label>
        <label>
          <input id="txtContrasena" name="txtContrasena" type="text" placeholder="Password"/>
        </label>
        <button class="red" type="submit"><i class="material-icons" style="font-size:18px;">lock</i>Log in</button>
        <h6>¿No tienes cuenta? <a href="registroform.php">Regístrate Aquí</a></h6>
        <div class="segment">

      </form>
      <form method="post" action="accionportada.php">
              <button class="unit" type="submmit" name="home"><i class="material-icons" style="font-size:28px;">home</i></button>
              <button class="unit" type="submit" name="restart"><i class="material-icons" style="font-size:28px;">restart_alt</i></button>
              <button class="unit" type="submit" name="settings"><i class="material-icons" style="font-size:28px;">settings</i></button>
            </form>
        
          <form method="post" action="nuevacontrasena.php">
          <div class="input-group">
          <label>
            <input type="text" name="dni" placeholder="DNI"/>
          </label>
          <button class="unit" type="submit"><i class="material-icons" style="font-size:28px;">search</i></button>
          </div>
        <h6>Solicita una nueva contraseña</h6>
        </form>
  </main>

  <footer>
    <p></p>
  </footer>

  <noscript>Your browser don't support JavaScript!</noscript>
  <script src="./scripts.js"></script>
</body>
</html>