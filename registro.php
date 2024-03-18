<?php
	session_start();
    if (isset($_SESSION["usuario"])){
        header('Location: aplicacion.php');}
    else{    
	$usuario = $contrasena = "";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {	
        $nombre=$_POST["txtNombre"];
        $apellidos=$_POST["txtApellidos"];       
		$email=$_POST["txtEmail"];
		$password=md5($_POST["txtContrasena"]);
        $telefono=$_POST["txtTelefono"];
        $dni=$_POST["txtDni"];  
        $dias='22';
        try {  
            mysqli_report(MYSQLI_REPORT_ALL);
            $mysqli = new mysqli('localhost', 'root', '', 'vacacionix');
            $sql_anadir_registro = 
            "INSERT INTO usuarios (nombre, apellidos, email, dni, contrasena,  telefono, dias) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $statement = $mysqli->prepare($sql_anadir_registro);
        $statement->bind_param('sssssss', $nombre, $apellidos, $email, $dni, $password, $telefono, $dias);
        $statement->execute();



            //Agregar a la tabla dias seleccionados
            $sql_anadir_vacaciones = 
            "INSERT INTO vacaciones (dni, FechasReservadas, diasUsados) VALUES (?, ?, ?)";
        $blanco = '';
        $cero = 0;
        $statement = $mysqli->prepare($sql_anadir_vacaciones);
        $statement->bind_param('sss', $dni, $blanco, $cero);
        $statement->execute();
            $statement->close();
            $mysqli->close();




            session_start();
            $_SESSION["usuario"]=$dni;
            echo $_SESSION["usuario"];


            // define variables and set to empty values
            header("Location: aplicacion.php");


           // session_start();
            //$_SESSION["usuario_validado"] = $obj_usuario_registrado;
            //header('Location: aplicacion.php');
            //echo "Usuario registrado correctamente.";
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
            exit;
        }

	}
    }
?>