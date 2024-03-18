<?php
// Conexión a la base de datos (reemplaza los valores según tu configuración)
include ('theme.php');
session_start();
if (!isset($_SESSION["usuario"])){
    header('Location: index.html');
}

// Datos de conexión a la base de datos
include 'theme.php';
include 'configuracion.php';
// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Crear la conexión

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consulta SQL para obtener los datos de usuarios y vacaciones
$query = "SELECT u.id, u.dni, u.nombre, u.apellidos, GROUP_CONCAT(v.FechasReservadas) AS FechasReservadas, SUM(v.diasUsados) AS diasUsados
          FROM usuarios u
          LEFT JOIN vacaciones v ON u.dni = v.dni
          GROUP BY u.id";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Vacaciones</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1 style="color:#babecc" align="center">Reporte de Vacaciones</h1>
    <?php if ($result->num_rows > 0): ?>
        <table border="6" align="center" text-align="center" >
            <thead style="color:#babecc">
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Días Seleccionados</th>
                    <th>Porcentaje</th>
                    <th>Gráfico de Tarta</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr align="center">
                        <td><?php echo $row['dni']; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['apellidos']; ?></td>
                        <td><?php echo $row['diasUsados']; ?></td>
                        <td><?php echo intval(($row['diasUsados'] / 22) * 100); ?>%</td>
                        <td><canvas class="graficoTarta" data-dias="<?php echo $row['diasUsados']; ?>" width="100" height="100"></canvas></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <script>
            // Obtener todos los elementos canvas con la clase graficoTarta
            var canvasElements = document.querySelectorAll('.graficoTarta');

            // Iterar sobre cada elemento canvas y crear el gráfico de tarta correspondiente
            canvasElements.forEach(function (canvas) {
                var diasSeleccionados = parseInt(canvas.getAttribute('data-dias'));
                var diasRestantes = 22 - diasSeleccionados;

                new Chart(canvas, {
                    type: 'pie',
                    data: {
                        //labels: ['Seleccionados', 'Restantes'],
                        datasets: [{
                            data: [diasSeleccionados, diasRestantes],
                            backgroundColor: ['#FF6384', '#a5a5a7']
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            });
        </script>
    <?php else: ?>
        <p>No se encontraron resultados.</p>
    <?php endif; ?>

    <?php $conn->close(); ?>
</body>

    <form method="post" action="accionportada.php">
      <div class="segment">
          <button class="unit" name="aplicacion" type="submit" title="Home"><i class="material-icons" style="font-size:28px;">home</i></button>
          <button class="unit" name="settings" type="submit" title="Perfil"><i class="material-icons" style="font-size:28px;">settings</i></button>
          <button class="unit" type="submit" title="ayuda" aria-label="Ayuda" alt="ayuda" name="help"><i class="material-icons" style="font-size:28px;">help</i></button>

        </div>
        </form>

    <h6>Smart Programming & Design: Humberto Della Sala</h6>
  </main>

  <footer>
    <p></p>
  </footer>

  <noscript>Your browser don't support JavaScript!</noscript>
  <script src="scripts.js"></script>




</html>