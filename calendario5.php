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

// ID del usuario
$dni = $_SESSION["usuario"];

// Obtener datos del usuario
$sql = "SELECT * FROM usuarios WHERE dni = '$dni'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $nombre = $row["nombre"];
        $apellidos = $row["apellidos"];
    }
} else {
    echo "No se encontraron resultados para el usuario.";
}

// Función para generar el calendario
function generarCalendario($anio) {
    $meses = array(
        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
        5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
        9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
    );

    echo "<h2>Calendario $anio</h2>";

    echo "<div id='calendario'>";
    for ($mes = 1; $mes <= 12; $mes++) {
        echo "<div class='mes'>";
        echo "<h3>{$meses[$mes]}</h3>";
        echo "<table>";
        echo "<tr><th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th><th>Vie</th><th>Sab</th><th>Dom</th></tr>";

        $primerDia = mktime(0, 0, 0, $mes, 1, $anio);
        $ultimoDia = mktime(0, 0, 0, $mes + 1, 0, $anio);

        $primerDiaSemana = date('N', $primerDia);

        echo "<tr>";
        for ($j = 1; $j < $primerDiaSemana; $j++) {
            echo "<td></td>";
        }

        for ($dia = 1; $dia <= date('t', $primerDia); $dia++) {
            $fechaActual = mktime(0, 0, 0, $mes, $dia, $anio);
            if ($dia == date('j') && $mes == date('n') && $anio == date('Y')) {
                echo "<td>$dia</td>";
            } else {
                echo "<td data-fecha='$dia/$mes/$anio'>$dia</td>";
            }

            if (date('N', $fechaActual) == 7) {
                echo "</tr><tr>";
            }
        }

        echo "</tr>";
        echo "</table>";
        echo "</div>";
    }
    echo "</div>";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Vacaciones</title>
    <style>
        .mes {
            width: 25%;
            display: inline-block;
            vertical-align: top;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        td {
            cursor: pointer;
        }
        .selected {
            background-color: #ffc107;
        }
    </style>
</head>
<body>

<h1>Bienvenido, <?php echo $nombre . ' ' . $apellidos; ?></h1>
<h2>Marca los días que deseas reservar como vacaciones:</h2>

<?php generarCalendario(date('Y')); ?>

<button id="guardarDias">Guardar Días Seleccionados</button>
<div id="diasSeleccionados"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var selectedDates = [];

        document.querySelectorAll('td').forEach(function(td) {
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
            });
        });

        document.getElementById('guardarDias').addEventListener('click', function() {
            var selectedDatesJSON = JSON.stringify(selectedDates);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'guardar_dias5.php');
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('diasSeleccionados').innerHTML = xhr.responseText;
                } else {
                    alert('Error al guardar los días seleccionados.');
                }
            };
            xhr.send(selectedDatesJSON);
        });
    });
</script>

</body>
</html>