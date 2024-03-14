<?php
session_start();
if (!isset($_SESSION["usuario"])){
    header('Location: index.html');}

//-------------------------

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "vacacionix";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Variables con los datos a actualizar
if ($_SERVER["REQUEST_METHOD"] == "POST") {	
    $dni=$_POST["txtDni"];   
    $nombre=$_POST["txtNombre"];
    $apellidos=$_POST["txtApellidos"];       
    $email=$_POST["txtEmail"];
    $telefono=$_POST["txtTelefono"];    }
    $auxdni=$_SESSION["usuario"];
// Consulta SQL para actualizar el registro
$sql = "UPDATE usuarios SET nombre='$nombre', apellidos='$apellidos', telefono='$telefono', email='$email', dni='$dni' WHERE dni='$auxdni'";


if ($conn->query($sql) === TRUE) {
    echo "Registro actualizado correctamente";
    header('Location: aplicacion.php');
} else {
    echo "Error al actualizar el registro: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
//----------------------------




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
  <title>Editar Información</title>
</head>
<body>
  <main>
    <form method="post" action="escribir_modificaciones.php">
        <div class="segment"><h1>Editar</h1></div>
      <label><h6>DNI</h6></label>
        <input id="txtDni" name="txtDni" type="text" value="<?php echo $dni ?>" />
      <label><h6>Nombre</h6></label>
        <input id="txtNombre" name="txtNombre" type="text" value="<?php echo $nombre ?>" />
      <label><h6>Apellido</h6></label>
      <input id="txtApellidos" name="txtApellidos" type="text" value="<?php echo $apellidos ?>" />
      </label><h6>Email</h6></label>
      <input id="txtEmail" name="txtEmail" type="text" value="<?php echo $email ?>"/>
      <label><h6>Teléfono</h6></label>
      <input id="txtTelefono" name="txtTelefono" type="text" value="<?php echo $telefono ?>" />
        <button class="red" type="submit"><i class="material-icons" style="font-size:18px;">key</i>Enviar</button>

        

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