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
//$sql = "SELECT * FROM usuarios, vacaciones WHERE dni = '$dni'";

$sql = "SELECT u.nombre, u.apellidos, v.FechasReservadas
        FROM usuarios u
        JOIN vacaciones v ON u.dni = v.dni
        WHERE u.dni = '$dni'";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $nombre = $row["nombre"];
        $apellidos = $row["apellidos"];
        $fechasSeleccionadas = $row["FechasReservadas"];

    }
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.1/TweenLite.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.1/TimelineMax.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.1/TweenMax.min.js"></script>
  <!-- Title -->
    
    <title>Calendario</title>
    <style>
        body {
            text-align: center;
        }
        #calendario {
            margin: 0 auto;
            width: 1100px; /* Ancho total del calendario */
            text-align: left;
        }
        h3 {
            color: #babecc;
        }
        h1, H2 {
            color: #a5a5a7;
        }
        .fila {
            margin-bottom: 20px;
        }
        .mes {
            width: calc(33.33% - 50px); /* Ancho de cada columna */
            display: inline-block;
            vertical-align: top;
            margin-right: 50px; /* Separación horizontal entre meses */
            margin-bottom: 50px; /* Separación vertical entre filas de meses */
        }
        .mes:last-child {
            margin-right: 0; /* Eliminar el margen derecho del último mes */
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
            color: #a5a5a7;
;
        }
        td {
            cursor: pointer;
        }
        .selected {
            background-color: #ffc107;
            color : black;
        }
    </style>
</head>
<body>

<h1>Bienvenid@, <?php echo $nombre . ' ' . $apellidos; ?></h1>
<h2>Marca los días que deseas reservar para vacaciones:</h2>


<div id="calendario">
<?php generarCalendario(date('Y')); ?>
</div>
<button id="guardarDias">Guardar Días Seleccionados</button>
<div id="diasSeleccionados"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var selectedDates = [];
        var maxSelection = 22; // Número máximo de días permitidos

        // Obtener las fechas seleccionadas del servidor y convertirlas a un array
        var fechasSeleccionadas = '<?php echo $fechasSeleccionadas; ?>';
        selectedDates = fechasSeleccionadas.split(',');

        document.querySelectorAll('td').forEach(function(td) {
            // Marcar automáticamente los días seleccionados al cargar la página
            if (selectedDates.includes(td.dataset.fecha)) {
                td.classList.add('selected');
            }

            td.addEventListener('click', function() {
                if (this.classList.contains('selected')) {
                    this.classList.remove('selected');
                    var index = selectedDates.indexOf(this.dataset.fecha);
                    if (index !== -1) {
                        selectedDates.splice(index, 1);
                    }
                } else {
                    // Verificar que no se exceda el límite de días seleccionados
                    if (selectedDates.length < maxSelection) {
                        this.classList.add('selected');
                        selectedDates.push(this.dataset.fecha);
                    } else {
                        alert('Solo puedes seleccionar un máximo de ' + maxSelection + ' días.');
                    }
                }
            });
        });

        document.getElementById('guardarDias').addEventListener('click', function() {
            var selectedDatesJSON = JSON.stringify(selectedDates);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'guardar_dias.php');
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
<form method="post" action="accionportada.php">
      <div class="segment">
          <button class="unit" name="aplicacion" type="submit" title="aplicacion"><i class="material-icons" style="font-size:28px;">exit_to_app</i></button>
          <button class="unit" name="reporte" type="submit" title="reporte"><i class="material-icons" style="font-size:28px;">print</i></button>
          <button class="unit" type="submit" title="ayuda" aria-label="Ayuda" alt="ayuda" name="help"><i class="material-icons" style="font-size:28px;">help</i></button>

        </div>
        </form>

    <h6>Smart Programming & Design: Humberto Della Sala</h6>
</body>
</html>