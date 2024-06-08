<?php
include 'conexion.php';

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];

$sql = "INSERT INTO datos (nombre, email, telefono) VALUES ('$nombre', '$email', '$telefono')";

if ($conn->query($sql) === TRUE) {
    echo "Registro insertado correctamente.";
} else {
    echo "Error al insertar el registro: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
