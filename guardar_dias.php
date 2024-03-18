<?php
session_start();
if (!isset($_SESSION["usuario"])){
    header('Location: index.html');
    exit(); // Asegura que el script se detenga si el usuario no está autenticado
}

// Datos de conexión a la base de datos
include 'configuracion.php';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el ID del usuario
$dni = $_SESSION["usuario"];
$diasTotales = "22";
// Obtener los días seleccionados desde la solicitud POST
$data = (json_decode(file_get_contents("php://input"), true));
sort($data);
if (isset($data[0])) { //elimina elemento 0
    if ($data[0]=='0' || $data[0]=='')
    unset($data[0]);}
$check = "SELECT * FROM vacaciones WHERE dni = '{$_SESSION["usuario"]}'";
$result = $conn->query($check);

//while($row = $result->fetch_assoc()) {
      // $dias = $row["dias"];
 //  }
//}

// Procesar y guardar los días seleccionados en la base de datos
if (!empty($data) && ($result->num_rows == 0)) {
    $diasSeleccionados = implode(',', $data); // Convertir el array en una cadena separada por comas
    // Consulta SQL para insertar los días seleccionados en la tabla 'vacaciones'
    $diasusados = count($data);
    $sql = "INSERT INTO vacaciones (dni, FechasReservadas, diasUsados ) VALUES ('$dni', '$diasSeleccionados', '$diasusados' )";
    if ($conn->query($sql) === TRUE) {
        echo "Los DÍAS SELECCIONADOS y DIAS USADOS se han guardado correctamente en la base de datos.";
    } else {
        echo "Error al guardar los días seleccionados: " . $conn->error;
    }
} else {
    //echo "No se han SELECCIONADO DÍAS para guardar.";
}

// Si existen datos actualizar
if ($result->num_rows > 0) {
    $diasSeleccionados = implode(',', $data); // Convertir el array en una cadena separada por comas
    // Consulta SQL para insertar los días seleccionados en la tabla 'vacaciones'
    $diasusados = count($data);
    $sql2 = "UPDATE vacaciones SET FechasReservadas = '$diasSeleccionados', diasUsados = '$diasusados' WHERE dni = '{$_SESSION["usuario"]}'";
    if ($conn->query($sql2) === TRUE) {
        echo "Los días seleccionados se han guardado correctamente en la base de datos.";
    } else {
        echo "Error al guardar los días seleccionados: " . $conn->error;
    }
} else {
    echo "Aquí No se han proporcionado días seleccionados para guardar.";
}
// Cerrar conexión
$conn->close();
?>