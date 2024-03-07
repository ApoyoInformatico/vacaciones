<?php
session_start();
if (isset($_SESSION["usuario"])){
    header('Location: aplicacion.php');




}
//echo "<h4>El email y/o la contraseña son incorrectos</h4>";
?>
<html lang="en">
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
  <title>Registrarse</title>
</head>
<body>
  <main>
    <form method="post" action="registro.php">
        <div class="segment"><h1>Regístrate</h1></div>
        <label><input id="txtDni" name="txtDni" type="text" placeholder="DNI" /></label>
        <label><input id="txtNombre" name="txtNombre" type="text" placeholder="Nombre" /></label>
        <label><input id="txtApellidos" name="txtApellidos" type="text" placeholder="Apellidos" /></label>
        <label><input id="txtEmail" name="txtEmail" type="text" placeholder="Email Address"/></label>
        <label><input id="txtContrasena" name="txtContrasena" type="password" placeholder="Password"/></label>
        <label><input type="password" placeholder="Confirm Password" /></label>
        <label><input id="txtTelefono" name="txtTelefono" type="text" placeholder="Teléfono" /></label>
        <button class="red" type="submit"><i class="material-icons" style="font-size:18px;">key</i>Registrarse</button>

        

      </form>
      <form method="post" action="accionportada.php">
      <div class="segment">
          <button class="unit" name="home" type="submit"><i class="material-icons" style="font-size:28px;">home</i></button>
          <button class="unit" name="restart" type="submit"><i class="material-icons" style="font-size:28px;">restart_alt</i></button>
          <button class="unit" name="settings" type="submit"><i class="material-icons" style="font-size:28px;">settings</i></button>
        </div>
        </form>


  </main>

  <footer>
    <p></p>
  </footer>

  <noscript>Your browser don't support JavaScript!</noscript>
  <script src="./scripts.js"></script>
</body>
</html>