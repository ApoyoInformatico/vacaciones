<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




//Generar Token Único.
$token = uniqid();

if ($_SERVER["REQUEST_METHOD"] == "POST") {	
	$dni=$_POST["dni"];


//-----------------------------------------------------------//
//Abrir base de datos y agregar token
//-----------------------------------------------------------//


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

// Verificar existencia del dni
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
        // Agrega más campos según tu estructura de tabla
    }
    //header('Location: aplicacion.php');

   


// Consulta SQL para actualizar el registro
$sql = "UPDATE usuarios SET token='$token' WHERE dni='$dni'";
if ($conn->query($sql) === TRUE) {
    //header('Location: aplicacion.php');
} else {
    $msg = "Error al buscar el registro. Puede que su DNI no esté registrado: " . $conn->error;
}

// Cerrar conexión
$conn->close();
//-----------------------------------------------------------//

//Enviar email
ini_set('SMTP', 'mail.apoyoinformatico.com');
ini_set('smtp_port', '587');

$enlace = "haz clic en el siguiente enlace: http://localhost/xampp/Humberto/vacacionix/reset.php?token=$token";
$to = "$email";
$subject = " VACAcioNIX - Solicitud de cambio de Contraseña";
$message = $nombre." Hemos recibido una solicitud para cambiar tu contraseña. Para continuar el proceso haz clic en el siguiente enlace: , ".$enlace;
$headers = "From: info@apoyoinformatico.com" . "\r\n";
//$mail->isHTML(true);

if (mail($to,$subject,$message,$headers)) {
    $msg = "Email con instrucciones enviado correctamente a ". $to;

} else {
       $msg = "Email fallo al enviar...";
}

} else {
    $msg = "No se encontraron resultados para el ID proporcionado: ".$dni;
}

}

else {
   $msg = "Error al buscar el dni " .$dni.": ". $conn->error;
   
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
  <title>login</title>
</head>
<body>
  <header>
    <h1></h1>
  </header>

  <main>
  <h6><?php echo $msg ?></h6>
    <form method="post" action="aplicacion.php">

        <button class="red" type="submit"><i class="material-icons" style="font-size:18px;">lock</i>Continuar</button>
        <div class="segment">
      </form>

        
  </main>

  <footer>
    <p></p>
  </footer>

  <noscript>Your browser don't support JavaScript!</noscript>
  <script src="./scripts.js"></script>
</body>
</html>