<?php
    // All scripts call session.php like:
    require('../layouts/session.php');

    
    
    require('../libraries/WriteHTML.php');    
    $pdf = new PDF_HTML();

    $pdf->AddPage();
    $pdf->SetFont('Helvetica');
    
    // Implementar el resultado de borrar todo.
    
    $result = $db->query("select i.ID ID,u.USER USUARIO_USUARIO, u.NOMBRE USUARIO_NAME, u.APELLIDOS APELLIDO_USUARIO, c.NOMBRE CATEGORIA_NAME, i.ESTADO INCIDENCIA_ESTADO, i.TITULO INCIDENCIA_TITULO, i.TIPO INCIDENCIA_TIPO, e.NOMBRE EDIFICIO_NOMBRE, p.NUMERO PLANTA_NUMERO, a.AULA AULA, i.FECHA FECHA from incidencia i inner join rel_aula_incidencia rai on rai.id_incidencia=i.id inner join rel_categoria_incidencia rci on rci.id_incidencia=i.id inner join usuario u on u.id=i.id_usuario inner join departamento d on d.id=u.id_departamento inner join categoria c on c.id=rci.id_categoria inner join aula a on a.id=rai.id_aula inner join planta p on p.id=a.id_planta inner join edificio e on e.id=p.id_edificio where i.ESTADO like 'RESUELTA' ORDER BY FECHA DESC;");
    
    $todas_incidencias="<h1> INCIDENCIAS </h1>";
    $pdf->writeHTML(utf8_decode($todas_incidencias));
    while($row = mysqli_fetch_array($result)){
        $result2 = $db->query("SELECT SUM(PRESUPUESTO) TOTAL FROM REVISION WHERE id_Incidencia=".$row['ID']);
        $row2 = mysqli_fetch_array($result2);
        
       $todas_incidencias="<br><hr><br><br><br><p> INCIDENCIA: ".$row['INCIDENCIA_TITULO']." <br>USUARIO: ".$row['USUARIO_USUARIO']."<br>NOMBRE DE USUARIO: ".$row['USUARIO_NAME']." ".$row['APELLIDO_USUARIO']." <br>CATEGORIA: ".$row['CATEGORIA_NAME']." <br>TIPO DE INCIDENCIA: ".$row['INCIDENCIA_TIPO']." <br>LUGAR: ".$row['EDIFICIO_NOMBRE']." ".$row['PLANTA_NUMERO']." ".$row['AULA']." <br>FECHA: ".$row['FECHA'];
       
       $pdf->writeHTML(utf8_decode($todas_incidencias));
       $pdf->writeHTML(utf8_decode(" <br>TOTAL PRESUPUESTO: ".number_format($row2['TOTAL'])." Euros</p>"));
    }
    
    $pdf->Output('F','../../resources/incidencias/incidences.pdf');
    
    
    $db->query("DELETE FROM INCIDENCIA");
    
    $db->close();