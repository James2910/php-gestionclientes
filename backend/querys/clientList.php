<?php
    
    //Incluimos la conecxion
    include 'backend/DB/connection.php';

    $sql = "SELECT C.Documento, C.Nombre, C.Apellido1, C.Apellido2, C.Direccion, C.Telefono, C.CorreoElectronico, C.Ciudad, CP.Nombre AS CondicionPago, C.ValorCupo, MP.Nombre AS MedioPago, C.Estado
            FROM Clientes C
            INNER JOIN condicion_pago CP ON C.CondicionPagoID = CP.ID
            LEFT JOIN medio_pago MP ON C.MedioPagoID = MP.ID";
    
    $result = $conn->query($sql);

    $conn->close();

?>