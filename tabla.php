<?php
/*session_start();
include 'conexion.php';

if(!isset($_SESSION['nombre'])){
    echo '
    <script>
        alert("Por favor inicia sesión para acceder a esta página.");
        setTimeout(function () {
            window.location.href = "index.php";
        }, 1200);
    </script>';
    die();
}
$sql = "SELECT * FROM usuarios";
$res = mysqli_query($conexion,$sql);
*/
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/tabla.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.11.3/i18n/Spanish.json"></script>
</head>

<body>
    <div class="container">
        <h3>Tabla de Registro <a href="cerrarsesion.php"><i class="fi fi-rr-exit"></i></a></h3>
        <form id="formulario">
            <label for="nombre">Nombre:</label><br><br>
            <input type="text" id="nombre" name="nombre">

            <label for="email">Correo electrónico:</label><br><br>
            <input type="email" id="email" name="email">

            <label for="telefono">Teléfono:</label><br><br>
            <input type="tel" id="telefono" name="telefono" pattern="[0-9]{10}"> <br><br>

            <button>Enviar</button>
        </form>
    </div>

    <table id="miTabla" class="display">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo electrónico</th>
                <th>Teléfono</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <script>
        $('#formulario').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'guardar.php',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    alert(response);
                    location.reload();
                }
            });
        });

        $(document).ready(function() {
            var dataTable = $('#miTabla').DataTable({
                columns: [{
                        data: 'nombre'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'telefono'
                    },
                ],
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                }
            });

            $.ajax({
                url: 'obtener_datos.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    dataTable.rows.add(data).draw();
                },
                error: function(xhr, status, error) {
                    alert("Error al cargar los datos.");
                    console.error(xhr.responseText);
                }
            });
        });
    </script>
</body>

</html>