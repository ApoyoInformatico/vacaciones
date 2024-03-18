<?php
$token_recibido = $_GET['token'];
//echo 'token Recibido: ',$token_recibido;

//-----------------------------------------------------------//
//Abrir base de datos y comparar token
//-----------------------------------------------------------//
// Conexión a la base de datos
include 'configuracion.php';


// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Variables con los datos a actualizar

// Consulta SQL para actualizar el registro

$sql = "SELECT * FROM usuarios WHERE token = '$token_recibido'";
$result = $conn->query($sql);
if ($conn->query($sql)) {
    //echo "El token existe";
    
        // Mostrar los datos del registro
        while($row = $result->fetch_assoc()) {

            $dni = $row["dni"];
    
            $nombre = $row["nombre"];
    
            $apellidos = $row["apellidos"];
    
            $email = $row["email"];
    
            $telefono = $row["telefono"];

            //echo $dni, $nombre, $apellidos;
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
            <form method="post" action="newpass.php">
        <div class="segment">
          <h1>Nueva Contraseña</h1>
        </div>
        
        <label>
          <input id="txtPassword" name="txtPassword" type="text" placeholder="Contraseña"/>
        </label>
        <label>
          <input id="txtContrasena" name="txtContrasena" type="text" placeholder="Repetir Contraseña"/>
        </label>
        <input id="txtToken" name="txtToken" type ="hidden" value="<?php echo $token_recibido ?>"/>
        <button class="red" type="submit"><i class="material-icons" style="font-size:18px;">lock</i>Cambiar Contraseña</button>
        
        <div class="segment">

      </form>
      <form method="post" action="accionportada.php">
              <button class="unit" type="submmit" name="home"><i class="material-icons" style="font-size:28px;">home</i></button>
              <button class="unit" type="submit" name="restart"><i class="material-icons" style="font-size:28px;">restart_alt</i></button>
              <button class="unit" type="submit" name="settings"><i class="material-icons" style="font-size:28px;">settings</i></button>
            </form>
        
          

        </html>

        <?php
        }
    } else {
        echo "No se encontraron resultados para el ID proporcionado.";
        
    }
    
    //header('Location: aplicacion.php');

    

// Cerrar conexión
$conn->close();
//-----------------------------------------------------------//   
    //verificar el token




// Verificar el token en la base de datos
//$sql = "SELECT * FROM tokens WHERE token = '$token_recibido'";
//$result = $conn->query($sql);

//if ($result->num_rows > 0) {
// Token válido, permitir restablecimiento de contraseña
//} else {
// Token inválido, mostrar mensaje de error
//}
?>
