


<?php

# Open the target document
$pdfexcel = new Document('reporte.pdf');

# Instantiate ExcelSave Option object
$excelsave = new ExcelSaveOptions();

# Save the output to XLS format
$pdfexcel->save("Converted_Excel.xls", $excelsave);

print "Document has been converted successfully" . PHP_EOL;
?>