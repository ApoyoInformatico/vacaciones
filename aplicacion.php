<?php
session_start();
if (!isset($_SESSION["usuario"])){
    header('Location: login.php');
  

  
  
  }

// Datos de conexión a la base de datos
include 'configuracion.php';


$adminshow='hidden'; //inicialmente no es administrador
// Crear conexión

$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// ID del registro a buscar
// 
$dni=$_SESSION["usuario"];
// Consulta SQL para obtener los datos del registro con el ID dado
$sql = "SELECT * FROM usuarios WHERE dni = '$dni'";
$result = $conn->query($sql);
// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Mostrar los datos del registro
    while($row = $result->fetch_assoc()) {

        $dni = $row["dni"];

        $nombre = $row["nombre"];

        $apellidos = $row["apellidos"];

        $email = $row["email"];

        $telefono = $row["telefono"];

        $admin = $row["administrador"];
        // Agrega más campos según tu estructura de tabla
    }
} else {
    echo "No se encontraron resultados para el ID proporcionado.";
}

// Cerrar conexión
$conn->close();
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
  <title>aplicacion</title>
</head>
<body>
  <header>
    <h1></h1>
  </header>
  <main>
  <?php
  //echo "Bienvenid@ ", $nombre, " ",$apellidos, "</br>";
  //echo "Gracias por usar nuestro sistema";
  ?>
  <form method="post" action="accionpanel.php">
        <div class="segment">
        <h1>Menú</h1>
        <h6>Bienvenid@ <?php echo $nombre . ' ' . $apellidos; ?></h6>
          <?php if ($admin == 1) {
          echo '<h6>ADMINISTRADOR<h6>';
          $adminshow='submit';
          } else $adminshow='hidden';
          ?>
        <button class="red" type="submit" name="editar"><i class="material-icons" style="font-size:18px;">create</i>Editar Datos</button><br />
        <button class="red" type="submit" name="calendario"><i class="material-icons" style="font-size:18px;">calendar_month</i>Reservar Días</button><br />
        <button class="red" type="submit" name="listarDias"><i class="material-icons" style="font-size:18px;">list</i>Listar Días</button><br />
        <button class="red" type="submit" name="logout"><i class="material-icons" style="font-size:18px;">logout</i>Log out</button><br /><br />
        <?php if ($admin == 1) {
        echo '<button class="red" type="<?php echo $adminshow; ?>" name="usuarios"><i class="material-icons" style="font-size:18px;">record_voice_over</i>Usuarios (ADM)</button><br />';
        echo '<button class="red" type="<?php echo $adminshow; ?>" name="estadisticas"><i class="material-icons" style="font-size:18px;">show_chart</i>Estadísticas (ADM)</button>';
  
      }
        ?>
      </div>

    </form>
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