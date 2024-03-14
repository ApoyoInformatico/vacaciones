<?php
//-----------------------------------------------------------//
//Abrir base de datos y comparar token
//-----------------------------------------------------------//
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "vacacionix";

if ($_SERVER["REQUEST_METHOD"] == "POST") {	
	$token=$_POST["txtToken"];
	$contrasena1=md5($_POST["txtPassword"]);
	$contrasena2=md5($_POST["txtContrasena"]);
    echo "contrasena1: ", $contrasena1, "token: ", $token, "contrasena2: ",$contrasena2;
}

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}


// Consulta SQL para actualizar el registro
if ($contrasena1 == $contrasena2){
$sql = "UPDATE usuarios SET token = '', contrasena = '$contrasena1', token = '' WHERE token ='$token'";


if ($conn->query($sql) === TRUE) {

    //header('Location: aplicacion.php');
} else {
    echo "Error al buscar el registro: " . $conn->error;
}
}else
{
    header("Location: reset.php");

    
}

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
  <title></title>
</head>
        <html>
        <h2>Contraseña Cambiada correctamente</h2>
        <form method="post" action="login.php">
          <div class="input-group">
          <label>Contraseña Cambiada correctamente</label>
          <button class="unit" type="submit"><i class="material-icons" style="font-size:28px;">arrow_back</i></button>
          </div>
        </form>
        </html>

        <?php
    

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
