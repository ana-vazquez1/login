<?php
session_start();
require_once "conexion.php";

$registro_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["name"];
    $correo = $_POST["email"];
    $contraseña = $_POST["password"];
    $confirmar_contraseña = $_POST["confirm_password"];

    if ($contraseña != $confirmar_contraseña) {
        $registro_error = "Error: La contraseña y la confirmación de contraseña no coinciden.";
        $_SESSION['registro_error'] = $registro_error;
        header("Location: registrar.php");
        exit;
    } else {
        $contraseña_encriptada = password_hash($contraseña, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nombre, correo, contraseña) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nombre, $correo, $contraseña_encriptada);
        
        if ($stmt->execute()) {
            $_SESSION['registro_exitoso'] = "¡Registro exitoso!";
            header("Location: registrar.php");
            exit; 
        } else {
            echo "Error al registrar usuario: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
