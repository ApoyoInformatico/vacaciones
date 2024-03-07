<?PHP
session_start();
if (!isset($_SESSION["usuario"])){
    header('Location: login.php');
    }
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
                        <th>Fecha de Registro</th>
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
                            echo '<td>' . $usuarios->reg_date .'</td>';
                            //echo '<td><button id='.$usuarios->id. ' type="button" class="btn btn-primary" onclick="funcionborrar('.$usuarios->id.')">Borrar</button></td>';
                            //echo '<td><button id='.$usuarios->id. ' type="button" class="btn btn-primary" onclick="funcioneditar('.$usuarios->id.')">Editar</button></td>';
                            echo '<td><a href="usuarios.php?borrar='.$usuarios->id.'">Borrar</a></td>';
                            echo '<td><a href="usuarios.php?editar='.$usuarios->id.'">Editar</a></td>';
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
    </body>
</html>