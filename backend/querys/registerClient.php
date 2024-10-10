<?php
// Incluye el archivo de conexión a la base de datos
include '../DB/connection.php';

// Lógica para manejar el envío del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene los datos enviados desde el formulario
    $documento = $_POST['Documento'];
    $nombre = $_POST['Nombre'];
    $apellido1 = $_POST['Apellido1'];
    $apellido2 = $_POST['Apellido2'];
    $direccion = $_POST['Direccion'];
    $telefono = $_POST['Telefono'];
    $correoElectronico = $_POST['CorreoElectronico'];
    $ciudad = $_POST['Ciudad'];
    $condicionPagoID = $_POST['CondicionPagoID'];
    $valorCupo = !empty($_POST['ValorCupo']) ? $_POST['ValorCupo'] : null;
    $medioPagoID = !empty($_POST['MedioPagoID']) ? $_POST['MedioPagoID'] : null;

    // Validaciones del servidor
    if (!$documento || !$nombre || !$apellido1 || !$direccion || !$telefono || !$correoElectronico || !$ciudad || !$condicionPagoID) {
        die('Todos los campos obligatorios deben ser completados');
    }

    // Validación de longitud de los campos
    if (strlen($documento) > 20 || strlen($nombre) > 100 || strlen($apellido1) > 50 || strlen($apellido2) > 50) {
        die('El documento no puede exceder 20 caracteres y los nombres/apellidos no pueden exceder 100 caracteres');
    }

    // Validar formato del correo electrónico
    if (!filter_var($correoElectronico, FILTER_VALIDATE_EMAIL)) {
        die('El formato del correo electrónico no es válido');
    }

    // Validación de la ciudad (solo permite ciudades predefinidas)
    $validCiudades = ['Bucaramanga', 'Piedecuesta', 'Floridablanca', 'Girón'];
    if (!in_array($ciudad, $validCiudades)) {
        die('La ciudad seleccionada no es válida');
    }

    // Validación de la condición de pago
    if ($condicionPagoID == 1 && (empty($medioPagoID) || !empty($valorCupo))) {
        die('Si la condición de pago es Contado, debe seleccionar un medio de pago y no ingresar valor de cupo');
    }
    if ($condicionPagoID == 2 && (empty($valorCupo) || !empty($medioPagoID))) {
        die('Si la condición de pago es Crédito, debe ingresar un valor de cupo y no seleccionar un medio de pago');
    }

    // Insertar cliente si todas las validaciones pasan
    $query = "INSERT INTO Clientes 
              (Documento, Nombre, Apellido1, Apellido2, Direccion, Telefono, CorreoElectronico, Ciudad, CondicionPagoID, ValorCupo, MedioPagoID, FechaHoraCreacion)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("sssssssssss", $documento, $nombre, $apellido1, $apellido2, $direccion, $telefono, $correoElectronico, $ciudad, $condicionPagoID, $valorCupo, $medioPagoID);

        if ($stmt->execute()) {
            echo 'Cliente agregado correctamente';
        } else {
            echo 'Error al agregar el cliente: ' . $stmt->error;
        }
    } else {
        echo json_encode(['message' => 'Error al preparar la consulta']);
        http_response_code(500);
    }
    // Cierra la declaración y la conexión
    $stmt->close();
    $conn->close();
}
?>
