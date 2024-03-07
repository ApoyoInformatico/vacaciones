<?php
    try {
        mysqli_report(MYSQLI_REPORT_ALL);
        $mysqli = new mysqli('localhost', 'root', '');
        $database_name = "vacacionix";
        $mysqli->execute_query('CREATE DATABASE ' . $database_name);
        $mysqli->close();

        $mysqli = new mysqli('localhost', 'root', '', $database_name);
        $sql_crear_tabla = "CREATE TABLE usuarios (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            dni VARCHAR(10) NOT NULL,
            nombre VARCHAR(30) NOT NULL,
            apellidos VARCHAR(30) NOT NULL,
            email VARCHAR(50),
            contrasena VARCHAR(50),
            telefono VARCHAR(50),
            dias VARCHAR(50),	
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            CONSTRAINT user_unico UNIQUE (email)
        )";
        $mysqli->execute_query($sql_crear_tabla);
        $mysqli->close();
    } catch (mysqli_sql_exception $e) {
        echo $e->getMessage();
        exit;
    }
?>

INSERT INTO usuarios (nombre, apellidos, email, contrasena, telefono, web, instagram, logo, foto)
VALUES
    ('Juan', 'Pérez', 'juan@example.com', '123456', '555-1234', 'www.juan.com', '@juanperez', 'logo1.jpg', 'foto1.jpg'),
    ('María', 'López', 'maria@example.com', 'abcdef', '555-5678', 'www.maria.com', '@marialopez', 'logo2.jpg', 'foto2.jpg'),
    ('Pedro', 'García', 'pedro@example.com', 'qwerty', '555-9012', 'www.pedro.com', '@pedrogarcia', 'logo3.jpg', 'foto3.jpg'),
    ('Laura', 'Rodríguez', 'laura@example.com', 'zxcvbn', '555-3456', 'www.laura.com', '@laurarodriguez', 'logo4.jpg', 'foto4.jpg'),
    ('Carlos', 'Martínez', 'carlos@example.com', 'poiuyt', '555-7890', 'www.carlos.com', '@carlosmartinez', 'logo5.jpg', 'foto5.jpg'),
    ('Ana', 'Hernández', 'ana@example.com', 'mnbvcx', '555-2345', 'www.ana.com', '@anahernandez', 'logo6.jpg', 'foto6.jpg'),
    ('Luis', 'González', 'luis@example.com', 'asdfgh', '555-6789', 'www.luis.com', '@luisgonzalez', 'logo7.jpg', 'foto7.jpg'),
    ('Sofía', 'Sánchez', 'sofia@example.com', 'lkjhgf', '555-0123', 'www.sofia.com', '@sofiasanchez', 'logo8.jpg', 'foto8.jpg'),
    ('Daniel', 'Ramírez', 'daniel@example.com', 'yuiop', '555-4567', 'www.daniel.com', '@danielramirez', 'logo9.jpg', 'foto9.jpg'),
    ('Patricia', 'Torres', 'patricia@example.com', 'xcvbnm', '555-8901', 'www.patricia.com', '@patriciatorres', 'logo10.jpg', 'foto10.jpg');