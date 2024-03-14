<?php
session_start();
if (!isset($_SESSION["usuario"])){
    header('Location: login.php');}

$dni = $contrasena = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {	
	$dni=$_POST["txtDni"];
	$password=md5($_POST["txtContrasena"]);
	$nombre=$_POST["txtNombre"];
}

// buscar en la base da datos

// se asume conexion en $conn incluido desde conexion.php, ejemlo:

// $conn= mysqli_connect("server", "mi_usuario", "mi_contraseña", "mi_bd");

// añadiría un limit 1 a la consulta pues solo esperamos un registro

$conn = new mysqli('localhost', 'root', '', 'vacacionix');

$consulta = mysqli_query ($conn, "SELECT * FROM usuarios WHERE dni = '$dni' AND contrasena = '$password'");

// esto válida si la consulta se ejecuto correctamente o no
// pero en ningún caso válida si devolvió algún registro

if(!$consulta){
// echo "Usuario no existe " . $nombre . " " . $password. " o hubo un error " .
echo mysqli_error($mysqli);
// si la consulta falla es bueno evitar que el código se siga ejecutando
exit;
}
else{
if($user = mysqli_fetch_assoc($consulta)) {
// el usuario y la pwd son correctas
echo "<h1>Bienvenido!!!!: $nombre</h1>";
	session_start();
	$_SESSION["usuario"]=$dni;
	echo $_SESSION["usuario"];
	// define variables and set to empty values
	header("Location: aplicacion.php");
} else {

// Usuario incorrecto o no existe
echo "El DNI o Contraseña NO son correctos";
header("Location: login.php");

}
}

?>