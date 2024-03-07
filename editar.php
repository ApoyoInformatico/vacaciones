<?php
session_start();
if (!isset($_SESSION["usuario"])){
    echo "ID: ".$_SESSION["usuario"];
    header('Location: index.html');
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "vacacionix";

$dni="identi";
$nombre="name";
$apellidos="last name";
$email="prueba@prueba.com";
$telefono="phone";

// Crear conexión
echo "ID: ".$_SESSION["usuario"];
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// ID del registro a buscar
$id = $_SESSION["usuario"]; // 

// Consulta SQL para obtener los datos del registro con el ID dado
$sql = "SELECT * FROM tu_tabla WHERE id = $id";

$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Mostrar los datos del registro
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"]. "<br>";
        echo "Nombre: " . $row["nombre"]. "<br>";
        echo "Apellidos: " . $row["apellidos"]. "<br>";
        echo "DNI: " . $row["dni"]. "<br>"; // Añade más campos según tu estructura de tabla
    }
    }
} else {
    echo "No se encontraron resultados para el ID proporcionado.";

// Cerrar conexión
$conn->close();



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
  <title>Editar Información</title>
</head>
<body>
  <main>
    <form method="post" action="escribir_modificaciones.php">
        <div class="segment"><h1>Editar</h1></div>
        <label>ID</label><label><input id="txtDni" name="txtDni" type="text" values="<?php echo $row["id"] ?>" /></label>
        <label>Nombre</label><label><input id="txtNombre" name="txtNombre" type="text" values="<?php echo $row["nombre"] ?>" /></label>
        <label>Apellido</label><label><input id="txtApellidos" name="txtApellidos" type="text" values="<?php echo $row["apellidos"] ?>" /></label>
        <label>Email</label><label><input id="txtEmail" name="txtEmail" type="text" values="<?php echo $row["email"] ?>"/></label>
        <label>Teléfono</label><label><input id="txtTelefono" name="txtTelefono" type="text" values="<?php echo $row["telefono"] ?>" /></label>
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