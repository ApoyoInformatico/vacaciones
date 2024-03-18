<?php
if (!isset($_SESSION["usuario"])){
    header('Location: login.php');}

$usuario = $_SESSION["usuario"];
include 'configuracion.php';
$conn = new mysqli($servername, $username, $password, $database);
$consulta = mysqli_query ($conn, "SELECT * FROM usuarios WHERE dni = '$usuario' AND administrador = 1");

// esto válida si la consulta se ejecuto correctamente o no
// pero en ningún caso válida si devolvió algún registro
if(!$consulta){
echo mysqli_error($mysqli);
header('Location: aplicacion.php');
exit;
}
else{}
if($consulta->num_rows=="0"){
    // echo "El usuario no es admin ";
    header('Location: aplicacion.php');
    exit;
    }
    else{}
?>