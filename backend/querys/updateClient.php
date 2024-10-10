<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Asegurarse de que la respuesta sea JSON
header('Content-Type: application/json');

//Incluimos la conecxion
include '../DB/connection.php';

// Obtener los datos enviados por POST
$documento = $_POST['Documento'];
$nombre = $_POST['Nombre'];
$apellido1 = $_POST['Apellido1'];
$apellido2 = $_POST['Apellido2'];
$direccion = $_POST['Direccion'];
$telefono = $_POST['Telefono'];
$ciudad = $_POST['Ciudad'];
$valorCupo = isset($_POST['ValorCupo']) ? $_POST['ValorCupo'] : null;
$estado = isset($_POST['Estado']) && $_POST['Estado'] === 'on' ? 1 : 0;

// Validación de campos obligatorios
if (empty($nombre) || empty($apellido1) || empty($apellido2) || empty($direccion) || empty($telefono) || empty($ciudad)) {
    echo json_encode(['message' => 'Todos los campos obligatorios deben estar completos']);
    http_response_code(400);
    exit;
}

// Preparar la consulta SQL para actualizar el cliente
$query = "UPDATE Clientes 
          SET Nombre = ?, Apellido1 = ?, Apellido2 = ?, Direccion = ?, Telefono = ?, Ciudad = ?, ValorCupo = ?, Estado = ? 
          WHERE Documento = ?";

// Preparar y ejecutar la sentencia
if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param('ssssssisi', $nombre, $apellido1, $apellido2, $direccion, $telefono, $ciudad, $valorCupo, $estado, $documento);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(['message' => 'Cliente actualizado correctamente']);
        } else {
            echo json_encode(['message' => 'Cliente no encontrado']);
            http_response_code(404);
        }
    } else {
        echo json_encode(['message' => 'Error al actualizar el cliente']);
        http_response_code(500);
    }

    // Cerrar la sentencia
    $stmt->close();
} else {
    echo json_encode(['message' => 'Error al preparar la consulta']);
    http_response_code(500);
}

// Cerrar la conexión
$conn->close();


?>