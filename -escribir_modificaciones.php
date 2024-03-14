<?php
	
	$usuario = $contrasena = "";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {	
        $nombre=$_POST["txtNombre"];
        $apellidos=$_POST["txtApellidos"];       
		$email=$_POST["txtEmail"];
        $telefono=$_POST["txtTelefono"];
        $dni=$_POST["txtDni"];       
        echo "aqui estamos";
        try {  
            mysqli_report(MYSQLI_REPORT_ALL);
            $mysqli = new mysqli('localhost', 'root', '', 'vacacionix');
            
            $sql_modificar_registro = 
            "$sql = UPDATE usuarios SET nombre = ?, apellidos = ?, email = ?, dni = ?, telefono = ? WHERE id = ?" ;
        
        $statement = $mysqli->prepare($sql_modificar_registro);
        $statement->bind_param('ssssss', $nombre, $apellidos, $email, $dni, $telefono, 1);
        $statement->execute();
            $statement->close();
            $mysqli->close();
    
            $obj_usuario_registrado = (object)[
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'email' => $email,
                'dni' => $dni,
                'telefono' => $telefono,
            ];


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

?>