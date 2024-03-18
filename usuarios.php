<?PHP
session_start();
if (!isset($_SESSION["usuario"])){
    header('Location: login.php');
    }
include "verificaradmin.php";
?>
<html lang="es">
    <head>
        <title>Listado de Usuarios</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <!DOCTYPE lang="es">

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
        <div class="container">
            <h2>Listado de Usuarios</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th colspan='2'>&nbsp;</th>
                    </tr>
                </thead>
                
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {	
                        if(isset($_POST['borrar'])) 
                        {
                            echo "ha entrado en borrar";
                            $mysqli = new mysqli('localhost', 'root', '', 'vacacionix');
                            mysqli_query($mysqli, "DELETE FROM usuarios WHERE id = $i");
                        }
                    }    
                    function borrar($i){
                        //Creamos la sentencia SQL
                        $mysqli = new mysqli('localhost', 'root', '', 'vacacionix');
                        mysqli_query($mysqli, "DELETE FROM usuarios WHERE id = $i");
                    }
                    function editar($i){
                            echo "HEMOS ENTRADO en editar";
                    }
                    if (isset($_GET['borrar'])) {
                        borrar($_GET['borrar']);
                    }

                    function tabla(){
                    try {
                        // Report on all types of errors
                        mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

                        // Open a new connection to the MySQL server
                        $mysqli = new mysqli('localhost', 'root', '', 'vacacionix');  

                        // Prepare an SQL statement for execution
                        $statement = $mysqli->prepare('SELECT * FROM usuarios order by id asc');

                        // Execute a prepared query
                        $statement->execute();

                        // Gets a result set from a prepared statement
                        $result = $statement->get_result();

                        // Fetch object from row/entry in result set
                        while ($usuarios = $result->fetch_object()) {
                            echo "<tr>";
                            echo '<td>' . $usuarios->id .'</td>';
                            echo '<td>' . $usuarios->nombre .'</td>';
                            echo '<td>' . $usuarios->apellidos .'</td>';
                            echo '<td>' . $usuarios->email .'</td>';
                            echo '<td>' . $usuarios->telefono .'</td>';
                            //echo '<td>' . $usuarios->reg_date .'</td>';
                            //echo '<td><button id='.$usuarios->id. ' type="button" class="btn btn-primary" onclick="funcionborrar('.$usuarios->id.')">Borrar</button></td>';
                            //echo '<td><button id='.$usuarios->id. ' type="button" class="btn btn-primary" onclick="funcioneditar('.$usuarios->id.')">Editar</button></td>';
                            echo '<td><a href="usuarios.php?borrar='.$usuarios->id.'">Borrar</a></td>';
                            //echo '<td><a href="usuarios.php?editar='.$usuarios->id.'">Editar</a></td>';
                            echo "</tr>";
                        }

                        // Close a prepared statement
                        $statement->close();

                        // Close database connection
                        $mysqli->close();
                    } catch (mysqli_sql_exception $e) {
                        // Output error and exit upon exception
                        echo $e->getMessage();
                        exit;
                    }
                }
                tabla();
                ?>
                <script>
                function funcionborrar($i){
                    var result ="<?php borrar($i); ?>"
                    document.write(result);
                }
                </script>

            </table>

        </div>
        <form method="post" action="accionportada.php">
            <div class="segment">
                <button class="unit" name="home" type="submit" title="Home"><i class="material-icons" style="font-size:28px;">home</i></button>
                <button class="unit" name="settings" type="submit" title="Perfil"><i class="material-icons" style="font-size:28px;">settings</i></button>
                <button class="unit" type="submit" title="ayuda" aria-label="Ayuda" alt="ayuda" name="help"><i class="material-icons" style="font-size:28px;">help</i></button>

            </div>
        </form>

    <h6>Smart Programming & Design: Humberto Della Sala</h6>
    </body>
</html>