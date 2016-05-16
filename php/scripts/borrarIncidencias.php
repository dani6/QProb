<?php
    // All scripts call session.php like:
    require('../layouts/session.php');

    
    
    require('../libraries/WriteHTML.php');    
    $pdf = new PDF_HTML();

    $pdf->AddPage();
    $pdf->SetFont('Helvetica');
    
    // Implementar el resultado de borrar todo.
    
    $pdf->writeHTML('<p>Aún no ha sido implementado.</p>');
    
    $nombre_archivo= date("d:m:Y");
    $pdf->Output('F','../../resources/incidencias/'.$nombre_archivo.'.pdf');
    
    
    $db->query("DELETE FROM INCIDENCIA");
    
    $db->close();