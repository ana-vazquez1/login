<?php
session_start();

// Mostrar el mensaje de error si existe
if (isset($_SESSION['inicio_sesion_error'])) {
    echo "<script>alert('{$_SESSION['inicio_sesion_error']}');</script>";
    unset($_SESSION['inicio_sesion_error']); // Limpiar el mensaje de error después de mostrarlo
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="img">
        <img src="img/2.jpg" alt="">
    </div>

    <div class="form">
        <h2>Iniciar Sesión</h2>
        <form action="login.php" method="POST">
            <div class="email">
                <span>Correo:</span> <br><br>
                <input type="text" name="email" pattern="[A-Za-z0-9_-]{1,20}" required>
            </div>

            <div class="password">
                <span>Contraseña:</span> <br><br>
                <input type="password" name="password" pattern="[A-Za-z0-9_-]{1,20}" required>
            </div>

            <div class="button">
                <button>
                    <samp style="font-family: Montserrat, sans-serif;">Entrar</samp>
                </button>
            </div>
        </form>
        <div class="registrar">
            <h5>¿No tienes cuenta? <a href="registrar.php">Registrate</a></h5>
        </div>
    </div>
</body>
</html>
