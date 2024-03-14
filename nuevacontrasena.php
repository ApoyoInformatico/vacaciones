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
    echo "Error al buscar el registro: " . $conn->error;
}

// Cerrar conexión
$conn->close();
//-----------------------------------------------------------//

//Enviar email
ini_set('SMTP', 'mail.apoyoinformatico.com');
ini_set('smtp_port', '587');

$enlace = "haz clic en el siguiente enlace: http://localhost/xampp/Humberto/vacacionix/reset.php?token=$token";
$to = "humberto@apoyoinformatico.com";
$subject = " VACAcioNIX - Solicitud de cambio de Contraseña";
$message = "Para restablecer tu contraseña, ".$enlace;
$headers = "From: info@apoyoinformatico.com" . "\r\n";
//$mail->isHTML(true);

if (mail($to,$subject,$message,$headers)) {
    echo "Email con instrucciones enviado correctamente a $to";

} else {
       echo "Email fallo al enviar...";
}
echo "</p></p><a href='aplicacion.php'>Clic aquí para continuar</a>";

} else {
    echo "No se encontraron resultados para el ID proporcionado.";
}

}

else {
   echo "  Error al buscar el dni: $dni ", $conn->error;
   
}

?>