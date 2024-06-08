<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrate</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="img">
        <img src="img/2.jpg" alt="">
    </div>

    <div class="form">
        <h2>Registrate</h2>
        <?php
        session_start();
        // Mostrar el mensaje de error relacionado con el registro
        if (isset($_SESSION['registro_error'])) {
            echo "<p>{$_SESSION['registro_error']}</p>";
            unset($_SESSION['registro_error']); // Limpiar la variable de sesión después de mostrar el mensaje
        }
        if (isset($_SESSION['registro_exitoso'])) {
            echo "<p>{$_SESSION['registro_exitoso']}</p>";
            unset($_SESSION['registro_exitoso']); // Limpiar la variable de sesión después de mostrar el mensaje
        }
        ?>
        <form action="registro.php" method="POST">
            <div class="nombre">
                <div class="name">
                    <span>Nombre:</span> <br><br>
                    <input type="text" name="name" pattern="[A-Za-z0-9_-]" required>
                </div>

                <div class="email">
                    <span>Correo:</span> <br><br>
                    <input type="email" name="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}" required>
                </div>

                <div class="password">
                    <span>Contraseña:</span> <br><br>
                    <input type="password" name="password" pattern="[A-Za-z0-9_-]{1,20}" required>
                </div>


                <div class="confirm-password">
                    <span>Confirmar Contraseña:</span> <br><br>
                    <input type="password" name="confirm_password" style="    width: 120%; 
                padding: 10px; 
                border: 1px solid #ccc; 
                border-radius: 4px;
                box-sizing: border-box; 
                font-family: Poppins, sans-serif;
                font-size: 16px;">
                </div> <br><br>


                <div class="button">
                    <button>
                        <samp style="font-family: Poppins, sans-serif;">Registrarse</samp>
                    </button>
                </div>
        </form>
        <div class="registrar">
            <h5><a href="index.php">Iniciar Sesión</a></h5>
        </div>
    </div>
</body>

</html>