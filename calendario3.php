<?php
session_start();
if (!isset($_SESSION["usuario"])){
    header('Location: index.html');
}
// Datos de conexión a la base de datos
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

// ID del registro a buscar
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
        // Agrega más campos según tu estructura de tabla
    }
} else {
    echo "No se encontraron resultados para el ID proporcionado.";
}

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE lang="es">
<head>
    <!-- Tus meta tags y enlaces CSS aquí -->
</head>
<body>
    <!-- Tu contenido HTML aquí -->
</body>

<script>
// Definir la variable selectedDates fuera de la función
var selectedDates = [];

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('#calendario td').forEach(function(td) {
        td.addEventListener('click', function() {
            if (this.classList.contains('selected')) {
                this.classList.remove('selected');
                var index = selectedDates.indexOf(this.dataset.fecha);
                if (index !== -1) {
                    selectedDates.splice(index, 1);
                }
            } else {
                this.classList.add('selected');
                selectedDates.push(this.dataset.fecha);
            }
            console.log(selectedDates);
        });
    });
});

document.getElementById('detener').addEventListener('click', function() {
    // Convertir selectedDates a JSON
    var selectedDatesJSON = JSON.stringify(selectedDates);
    console.log("Enviados: ", selectedDatesJSON);
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'guardar_dias.php'); // Ruta al script PHP para guardar en la base de datos
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('diasSeleccionados').innerHTML = xhr.responseText;
        } else {
            alert('Error al guardar los días seleccionados.');
        }
    };
    xhr.send(selectedDatesJSON); // Enviar datos al servidor
});
</script>
</html>