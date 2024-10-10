<link rel=stylesheet href='theme/globalStyles.css'>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<?php
    // Incluir conexión y archivo de consulta
    include 'backend/DB/connection.php';
    include 'backend/querys/clientList.php';

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $nombreCompleto = $row['Nombre'] . ' ' . $row['Apellido1'] . ' ' . $row['Apellido2'];
            $estado = $row['Estado'] == 1 ? 'Activo' : 'Inactivo';
?>
    
    <div class="card" data-bs-toggle="modal" data-bs-target="#editClientModal"
            data-documento="<?php echo $row['Documento']; ?>"
            data-nombre="<?php echo $row['Nombre']; ?>"
            data-apellido1="<?php echo $row['Apellido1']; ?>"
            data-apellido2="<?php echo $row['Apellido2']; ?>"
            data-direccion="<?php echo $row['Direccion']; ?>"
            data-telefono="<?php echo $row['Telefono']; ?>"
            data-correo="<?php echo $row['CorreoElectronico']; ?>"
            data-ciudad="<?php echo $row['Ciudad']; ?>"
            data-condicion-pago="<?php echo $row['CondicionPago']; ?>"
            data-valor-cupo="<?php echo $row['ValorCupo']; ?>"
            data-medio-pago="<?php echo $row['MedioPago']; ?>"
            data-estado="<?php echo $row['Estado']; ?>">
        <div class="iconCardContainer">
            <svg class="cardIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/></svg>
        </div>

        <div class="infoCard">
            <p class="cardName"><?php echo $nombreCompleto; ?></p>
            <div class="switchContainer">
                <p>Estado: 
                    <label class="switch">
                        <input type="checkbox" <?php echo $row['Estado'] == 1 ? 'checked' : ''; ?> disabled>
                        <span class="slider round"></span>
                    </label>
                    <?php echo $estado; ?>
                </p>
            </div>
        </div>

        <div class="cardInfo">
            <div class="cardText">
                <p>Documento: <?php echo $row['Documento']; ?></p>
                <p>Dirección: <?php echo $row['Direccion']; ?></p>
                <p>Teléfono: <?php echo $row['Telefono']; ?></p>
                <p>Correo: <?php echo $row['CorreoElectronico']; ?></p>
                <p>Ciudad: <?php echo $row['Ciudad']; ?></p>
                <p>Condición de Pago: <?php echo $row['CondicionPago']; ?></p>

                <?php if ($row['CondicionPago'] === 'Contado') : ?>
                    <p>Medio de Pago: <?php echo $row['MedioPago']; ?></p>
                <?php else : ?>
                    <p>Valor del Cupo: <?php echo $row['ValorCupo']; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Modal Editar Cliente -->
    <div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="editClientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editClientModalLabel">Editar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateClientForm">
                    <div class="modal-body">
                        <div class="mb-3 d-flex flex-row">
                            <div class="me-3">
                                <p >Estado: </p>
                            </div>
                            <div class="switch">
                                <input type="checkbox" class="form-check-input" id="estadoCheck" name="Estado">
                                <label class="slider round" for="estadoCheck"></label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="formBasicDocumento" class="form-label">Documento:</label>
                            <input type="text" class="form-control" id="formBasicDocumento" name="Documento" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="formBasicNombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="formBasicNombre" name="Nombre" required>
                        </div>

                        <div class="mb-3">
                            <label for="formBasicApellido1" class="form-label">Apellido 1:</label>
                            <input type="text" class="form-control" id="formBasicApellido1" name="Apellido1" required>
                        </div>

                        <div class="mb-3">
                            <label for="formBasicApellido2" class="form-label">Apellido 2:</label>
                            <input type="text" class="form-control" id="formBasicApellido2" name="Apellido2" required>
                        </div>

                        <div class="mb-3">
                            <label for="formBasicDireccion" class="form-label">Dirección:</label>
                            <input type="text" class="form-control" id="formBasicDireccion" name="Direccion" required>
                        </div>

                        <div class="mb-3">
                            <label for="formBasicTelefono" class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" id="formBasicTelefono" name="Telefono" required>
                        </div>

                        <div class="mb-3">
                            <label for="formBasicCorreo" class="form-label">Correo Electrónico:</label>
                            <input type="email" class="form-control" id="formBasicCorreo" name="CorreoElectronico" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="formBasicCiudad" class="form-label">Ciudad:</label>
                            <select class="form-select" id="formBasicCiudad" name="Ciudad" required>
                                <option value="">Seleccione una ciudad</option>
                                <option value="Bucaramanga">Bucaramanga</option>
                                <option value="Piedecuesta">Piedecuesta</option>
                                <option value="Floridablanca">Floridablanca</option>
                                <option value="Girón">Girón</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="formBasicCondicionPago" class="form-label">Condición de Pago:</label>
                            <select class="form-select" id="formBasicCondicionPago" name="CondicionPago" readonly block>
                                <option value="">Seleccione una condición de pago</option>
                                <option value="1">Contado</option>
                                <option value="2">Crédito</option>
                            </select>
                        </div>

                        <div class="mb-3" id="valorCupoContainer">
                            <label for="formBasicValorCupo" class="form-label">Valor de Cupo:</label>
                            <input type="number" class="form-control" id="formBasicValorCupo" name="ValorCupo" required>
                        </div>

                        <div class="mb-3" id="medioPagoContainer">
                            <label for="formBasicMedioPago" class="form-label">Medio de Pago:</label>
                            <select class="form-select" id="formBasicMedioPago" name="MedioPago" readonly>
                                <option value="">Seleccione un medio de pago</option>
                                <option value="1">Tarjeta de Crédito</option>
                                <option value="2">Transferencia Bancaria</option>
                                <option value="3">Efectivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<?php
        }
    } else {
        echo "No se encontraron clientes.";
    }
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    const modal = document.getElementById('editClientModal');
    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Botón que abrió el modal

        // Extraer los datos de los atributos data- de la tarjeta
        const documento = button.getAttribute('data-documento');
        const nombre = button.getAttribute('data-nombre');
        const apellido1 = button.getAttribute('data-apellido1');
        const apellido2 = button.getAttribute('data-apellido2');
        const direccion = button.getAttribute('data-direccion');
        const telefono = button.getAttribute('data-telefono');
        const correo = button.getAttribute('data-correo');
        const ciudad = button.getAttribute('data-ciudad');
        const condicionPago = button.getAttribute('data-condicion-pago');
        const valorCupo = button.getAttribute('data-valor-cupo');
        const medioPago = button.getAttribute('data-medio-pago');
        const estado = button.getAttribute('data-estado');

        var condiconPagoID = 0;
        var medioPagoID = 0;

        // Llenar los campos del modal con los datos extraídos
        document.getElementById('formBasicDocumento').value = documento;
        document.getElementById('formBasicNombre').value = nombre;
        document.getElementById('formBasicApellido1').value = apellido1;
        document.getElementById('formBasicApellido2').value = apellido2;
        document.getElementById('formBasicDireccion').value = direccion;
        document.getElementById('formBasicTelefono').value = telefono;
        document.getElementById('formBasicCorreo').value = correo;
        document.getElementById('formBasicCiudad').value = ciudad;

        if (condicionPago === 'Contado') {
            condiconPagoID = 1;
        }else{
            condiconPagoID = 2;
        }

        document.getElementById('formBasicCondicionPago').value = condiconPagoID;

        if (medioPago === 'Tarjeta de crédito') {
            medioPagoID = 1;
        } else if (medioPago === 'Transferencia bancaria') {
            medioPagoID = 2;
        } else {
            medioPagoID = 3;
        }

        // Mostrar u ocultar campos según la condición de pago
        if (condiconPagoID === 1) { // Contado
            document.getElementById('medioPagoContainer').style.display = 'block';
            document.getElementById('valorCupoContainer').style.display = 'none';
            document.getElementById('formBasicMedioPago').value = medioPagoID;
        } else { // Crédito
            document.getElementById('medioPagoContainer').style.display = 'none';
            document.getElementById('valorCupoContainer').style.display = 'block';
            document.getElementById('formBasicValorCupo').value = valorCupo;
        }

        // Manejar el estado
        document.getElementById('estadoCheck').checked = estado == 1;
    });
</script>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#updateClientForm').on('submit', function(event) {
            event.preventDefault(); // Prevenir el comportamiento por defecto del formulario

            const formData = $(this).serialize(); // Serializar los datos del formulario
            console.log(formData);

            $.ajax({
                type: 'POST',
                url: 'backend/querys/updateClient.php',
                data: formData,
                dataType: 'json',
                success: function(data) {
                    // Mostrar un mensaje de éxito o error
                    alert(data.message);
                    
                    if (data.message === 'Cliente actualizado correctamente') {
                        // Cerrar el modal usando Bootstrap
                        const modal = bootstrap.Modal.getInstance(document.getElementById('editClientModal'));
                        modal.hide();

                        // Aquí puedes recargar la página o actualizar la lista de clientes si es necesario
                        location.reload(); // Esto recargaría la página entera
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Manejar errores
                    console.error('Error: ' + textStatus, errorThrown);
                }
            });
        });
    });
</script>
