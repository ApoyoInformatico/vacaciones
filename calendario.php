<?php
session_start();
$nombre=isset($_SESSION["nombre"]);
$apellido=isset($_SESSION["apellido"]);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <style>
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
        .mes {
            width: 33.33%;
        }
    </style>
</head>
<body>

<?php
echo "Bienvenido ", $nombre;
echo "Haz clic en los días que deseas reservar";


// Función para generar el calendario
function generarCalendario($anio) {
    $meses = array(
        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
        5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
        9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
    );

    echo "<h2>Calendario $anio</h2>";

    echo "<div class='fila'>";
    for ($mes = 1; $mes <= 12; $mes += 3) {
        echo "<div class='mes'>";
        for ($i = 0; $i < 3; $i++) {
            $mesActual = $mes + $i;
            echo "<h3>{$meses[$mesActual]}</h3>";
            echo "<table>";
            echo "<tr><th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th><th>Vie</th><th>Sab</th><th>Dom</th></tr>";

            $primerDia = mktime(0, 0, 0, $mesActual, 1, $anio);
            $ultimoDia = mktime(0, 0, 0, $mesActual + 1, 0, $anio);

            $primerDiaSemana = date('N', $primerDia);

            echo "<tr>";
            for ($j = 1; $j < $primerDiaSemana; $j++) {
                echo "<td></td>";
            }

            for ($dia = 1; $dia <= date('t', $primerDia); $dia++) {
                $fechaActual = mktime(0, 0, 0, $mesActual, $dia, $anio);
                if ($dia == date('j') && $mesActual == date('n') && $anio == date('Y')) {
                    echo "<td class='selected'>$dia</td>";
                } else {
                    echo "<td data-fecha='$dia/$mesActual/$anio'>$dia</td>";
                }

                if (date('N', $fechaActual) == 7) {
                    echo "</tr><tr>";
                }
            }

            echo "</tr>";
            echo "</table>";
        }
        echo "</div>";
    }
    echo "</div>";
}
?>

<div id="calendario">
    <?php generarCalendario(date('Y')); ?>
</div>

<button id="detener">Detener proceso</button>

<div id="diasSeleccionados"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var selectedDates = [];

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


    document.getElementById('detener').addEventListener('click', function() {
        document.getElementById('diasSeleccionados').innerHTML = 'Días seleccionados: ' + selectedDates.join(', '); 
    });
    
});
</script>

</body>
</html>