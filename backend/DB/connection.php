<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gestionclientes";

    // Crear la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Establecer el conjunto de caracteres a UTF-8
    $conn->set_charset("utf8");

?>