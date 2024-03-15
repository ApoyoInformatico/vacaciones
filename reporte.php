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
//$sql = "SELECT * FROM vacaciones, usuarios WHERE dni = '$dni'";
$sql = "SELECT u.nombre, u.apellidos, v.FechasReservadas
        FROM usuarios u
        JOIN vacaciones v ON u.dni = v.dni
        WHERE u.dni = '$dni'";




$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $fechas = explode(",",$row["FechasReservadas"]);
        $nombre = $row["nombre"];
        $apellidos = $row["apellidos"];
    }
} else {
    echo "No se encontraron dias para el usuario.";
}



// include class
require('fpdf/fpdf.php');

// create document
$pdf = new FPDF();
$pdf->AddPage();

// config document
$pdf->SetTitle('Generar archivos PDF con PHP');
$pdf->SetAuthor('hdellasala');
$pdf->SetCreator('FPDF Maker');
//$pdf->SetFillColor(72,50,133);
$pdf->SetFillColor(100, 150, 200); // Color azul claro


// add title
$pdf->SetFont('Arial', 'B', 24);
$pdf->Cell(0, 10, 'Fechas Reservadas para vacaciones', 0, 1);
$pdf->Cell(50, 7, $nombre.' '.$apellidos, 0, 1, 'L');

$pdf->Ln();
//var_dump ($fechas);

// add text
//$pdf->Cell(0, 7, utf8_decode('Días Seleccionados: '), 0, 0, 'c');
//$pdf->Cell(0, 7, (count($fechas)), 0, 1, 'l' );
//$pdf->Ln();

// Establecer el punto de inicio para las celdas
$posX = $pdf->GetX();
$posY = $pdf->GetY();

// Agregar la primera celda centrada con el texto "Días Seleccionados: "
$pdf->Cell(90, 7, utf8_decode('Días Seleccionados: '), 0, 0, 'C');

// Establecer la posición para la siguiente celda
$pdf->SetXY($posX + 100, $posY);

// Agregar la segunda celda con el número de fechas alineado a la izquierda
$pdf->Cell(50, 7, count($fechas), 0, 1, 'L');


$pdf->Ln();
$pdf->SetFont('Arial', '', 12);
for ($i = 0; $i < count($fechas);$i++){
$pdf->MultiCell(0, 7, $fechas[$i], 0, 1);
}
$pdf->Ln();
$pdf->Line(10, 28, 180, 28);
$pdf->MultiCell(0, 7, utf8_decode('Entregar firmado para ser procesado'), 0, 1);
$pdf->Ln();
$posX = $pdf->GetX();
$posY = $pdf->GetY();
//$pdf->Line(13, $posY+13, 180, $posY+10);
$pdf->Image("boton_regresar.png" , 10 ,$posY, 35 , 18 , "PNG" ,"aplicacion.php");
$pdf->Image("excel.png" , $posX+50 ,$posY+3, 40 , 20 , "PNG" ,"descargar_excel.php");

// add image $pdf->Image('assets/fpdf-code.png', null, null, 180);

// output file
$pdf->Output('', 'reporte.pdf');
//$mpdf->Output('/ruta/para/guardar/tu/Reporte.pdf', 'F'); //guarda a ruta
# Open the target document
$pdfexcel = new Document('reporte.pdf');

# Instantiate ExcelSave Option object
$excelsave = new ExcelSaveOptions();

# Save the output to XLS format
$pdfexcel->save("Converted_Excel.xls", $excelsave);

print "Document has been converted successfully" . PHP_EOL;


?>