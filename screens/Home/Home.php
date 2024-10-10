<?php

// Lógica para manejar el envío del formulario

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Gestion Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel=stylesheet href='theme/globalStyles.css'>
</head>
<body>
    <?php include "renders/Header.php"; ?>
    <div>
        <div class="btnContainer">
            <!-- Botón para abrir el modal de registro -->
            <button type="button" class="custom-btn" data-bs-toggle="modal" data-bs-target="#registerModal">
                <p class="btnText">Registrar Cliente</p>
            </button>
        </div>

        <div class="cardContainer">
            <?php include 'renders/Card.php' ?>
        </div>


    </div>


    

    <!-- Modal de registro -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Registrar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="registerForm" method="POST">
                <!-- Documento -->
                <div class="mb-3">
                    <label for="formBasicDocumentoR" class="form-label">Documento:</label>
                    <input type="text" class="form-control" id="formBasicDocumentoR" name="Documento" placeholder="Documento del cliente" required>
                </div>
                <!-- Nombre -->
                <div class="mb-3">
                    <label for="formBasicNombreR" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="formBasicNombreR" name="Nombre" placeholder="Nombre del cliente" required>
                </div>
                <!-- Apellido 1 -->
                <div class="mb-3">
                    <label for="formBasicApellido1R" class="form-label">Apellido 1:</label>
                    <input type="text" class="form-control" id="formBasicApellido1R" name="Apellido1" placeholder="Primer apellido del cliente" required>
                </div>
                <!-- Apellido 2 -->
                <div class="mb-3">
                    <label for="formBasicApellido2R" class="form-label">Apellido 2:</label>
                    <input type="text" class="form-control" id="formBasicApellido2R" name="Apellido2" placeholder="Segundo apellido del cliente" required>
                </div>
                <!-- Dirección -->
                <div class="mb-3">
                    <label for="formBasicDireccionR" class="form-label">Dirección:</label>
                    <input type="text" class="form-control" id="formBasicDireccionR" name="Direccion" placeholder="Dirección del cliente" required>
                </div>
                <!-- Teléfono -->
                <div class="mb-3">
                    <label for="formBasicTelefonoR" class="form-label">Teléfono:</label>
                    <input type="text" class="form-control" id="formBasicTelefonoR" name="Telefono" placeholder="Teléfono del cliente" required>
                </div>
                <!-- Correo Electrónico -->
                <div class="mb-3">
                    <label for="formBasicCorreoR" class="form-label">Correo Electrónico:</label>
                    <input type="email" class="form-control" id="formBasicCorreoR" name="CorreoElectronico" placeholder="Correo electrónico del cliente" required>
                </div>
                <!-- Ciudad (selección) -->
                <div class="mb-3">
                    <label for="formBasicCiudadR" class="form-label">Ciudad:</label>
                    <select class="form-select" id="formBasicCiudadR" name="Ciudad" required>
                        <option value="">Seleccione una ciudad</option>
                        <option value="Bucaramanga">Bucaramanga</option>
                        <option value="Piedecuesta">Piedecuesta</option>
                        <option value="Floridablanca">Floridablanca</option>
                        <option value="Girón">Girón</option>
                    </select>
                </div>
                <!-- Condición de Pago (selección) -->
                <div class="mb-3">
                    <label for="formBasicCondicionPago" class="form-label">Condición de Pago:</label>
                    <select class="form-select" id="formBasicCondicionPagoID" name="CondicionPagoID" required>
                        <option value="">Seleccione una condición de pago</option>
                        <option value="1">Contado</option>
                        <option value="2">Crédito</option>
                    </select>
                </div>
                <!-- Medio de Pago (dependiendo de la Condición de Pago) -->
                <div id="medioPagoContainerR" class="mb-3" style="display: none;">
                    <label for="formBasicMedioPagoR" class="form-label">Medio de Pago:</label>
                    <select class="form-select" id="formBasicMedioPagoR" name="MedioPagoID" required>
                        <option value="">Seleccione un medio de pago</option>
                        <option value="1">Tarjeta de Crédito</option>
                        <option value="2">Transferencia Bancaria</option>
                        <option value="3">Efectivo</option>
                    </select>
                </div>
                <!-- Valor de Cupo (si la Condición de Pago es Crédito) -->
                <div id="valorCupoContainerR" class="mb-3" style="display: none;">
                    <label for="formBasicValorCupoR" class="form-label">Valor de Cupo:</label>
                    <input type="number" class="form-control" id="formBasicValorCupoR" name="ValorCupo" placeholder="Valor del cupo" required>
                </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="handleSubmit()"><p class="btnText">Agregar Cliente</p></button>
            </div>

            </div>
        </div>
    </div>


    



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        function handleCondicionPago() {
            const selectElement = document.getElementById('formBasicCondicionPagoID');
            const medioPagoContainer = document.getElementById('medioPagoContainerR');
            const valorCupoContainer = document.getElementById('valorCupoContainerR');

            // Verificar que el select no sea nulo
            if (selectElement) {
                const condicionPago = selectElement.value;
                // Mostrar u ocultar campos dependiendo de la opción seleccionada
                if (condicionPago === "1") { // Contado
                    medioPagoContainer.style.display = 'block';
                    valorCupoContainer.style.display = 'none';
                } else if (condicionPago === "2") { // Crédito
                    medioPagoContainer.style.display = 'none';
                    valorCupoContainer.style.display = 'block';
                } else {
                    medioPagoContainer.style.display = 'none';
                    valorCupoContainer.style.display = 'none';
                }
            } else {
                console.error('El select de Condición de Pago no se encontró.'); // Para depurar
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const condicionPagoSelect = document.getElementById('formBasicCondicionPagoID');
            // Asegúrate de que el select no sea nulo antes de agregar el evento
            if (condicionPagoSelect) {
                condicionPagoSelect.addEventListener('change', handleCondicionPago);
            } else {
                console.error('El select de Condición de Pago no se encontró en el DOM.'); // Para depurar
            }
        });
    </script>
    
    <script>
        function handleSubmit() {
            // Obtener los datos del formulario
            const formData = {
                Documento: $('#formBasicDocumentoR').val(),
                Nombre: $('#formBasicNombreR').val(),
                Apellido1: $('#formBasicApellido1R').val(),
                Apellido2: $('#formBasicApellido2R').val(),
                Direccion: $('#formBasicDireccionR').val(),
                Telefono: $('#formBasicTelefonoR').val(),
                CorreoElectronico: $('#formBasicCorreoR').val(),
                Ciudad: $('#formBasicCiudadR').val(),
                CondicionPagoID: $('#formBasicCondicionPagoID').val(),
                ValorCupo: $('#formBasicValorCupoR').val(),
                MedioPagoID: $('#formBasicMedioPagoR').val(),
            };
            $.ajax({
                url: 'backend/querys/registerClient.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Manejar la respuesta del servidor
                    alert(response);
                    $('#registerModal').modal('hide'); // Cierra el modal
                    location.reload();
                },
                error: function(xhr) {
                    // Manejar errores
                    alert('Error: ' + xhr.responseText);
                }
            });
        }
    </script>
</body>
</html>




