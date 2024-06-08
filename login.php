<?php
session_start();
require_once "conexion.php";

// Archivos log
function insertarRegistroEvento($nivel, $mensaje) {
    global $conn;
    $sql = "INSERT INTO registros (nivel, mensaje) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nivel, $mensaje);
    $stmt->execute();
    $stmt->close();
}

$inicio_sesion_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['intentos']) && $_SESSION['intentos'] >= 3) {
        $tiempo_transcurrido = time() - $_SESSION['inicio_espera'];
        $tiempo_restante = 60 - $tiempo_transcurrido; 
        if ($tiempo_transcurrido < 60) {
            $_SESSION['inicio_sesion_error'] = "Has excedido el límite de intentos de inicio de sesión. Por favor, inténtalo nuevamente en $tiempo_restante segundos.";
            header("Location: index.php"); 
            exit;
        }  else {
            unset($_SESSION['intentos']);
            unset($_SESSION['inicio_espera']);
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["email"];
    $contraseña = $_POST["password"];

    if ($stmt = $conn->prepare("SELECT * FROM usuarios WHERE correo = ?")) {
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows == 1) {
            $fila = $resultado->fetch_assoc();
            $contraseña_bd = $fila["contraseña"];

            if (password_verify($contraseña, $contraseña_bd)) {
                unset($_SESSION['intentos']);
                unset($_SESSION['inicio_espera']);

                $_SESSION["correo"] = $correo;
                header("Location: tabla.php");
                exit;
            } else {

                if (isset($_SESSION['intentos'])) {
                    $_SESSION['intentos']++;
                } else {
                    $_SESSION['intentos'] = 1;
                    $_SESSION['inicio_espera'] = time(); 
                }
                $inicio_sesion_error = "Error: Contraseña incorrecta.";
                insertarRegistroEvento("ERROR", "Intento de inicio de sesión: $correo");
            }
        } else {
            $inicio_sesion_error = "Error: Usuario no encontrado.";
            insertarRegistroEvento("ERROR", "Usuario no encontrado para el correo: $correo");
        }

        $_SESSION['inicio_sesion_error'] = $inicio_sesion_error;

        header("Location: index.php");
        exit;

        $stmt->close();
    }
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    session_start();
    require_once "conexion.php";

    if (isset($_POST['usuarios']) && isset($_POST['contraseña'])) {
        $usuario = $mysqli->real_escape_string($_POST['usuarios']);
        $contraseña = $mysqli->real_escape_string($_POST['contraseña']);

        if ($consulta = $mysqli->prepare("SELECT * FROM usuarios WHERE correo = ? AND contraseña = ?")) {
            $consulta->bind_param('ss', $usuario, $contraseña);
            $consulta->execute();

            $resultado = $consulta->get_result();

            if ($resultado->num_rows == 1) {
                $datos = $resultado->fetch_assoc();
                echo json_encode(array('error' => false));
            } else {
                echo json_encode(array('error' => true));
                insertarRegistroEvento("ERROR", "Intento de inicio de sesión AJAX fallido");
            }

            $consulta->close();
        }
    }
}

$conn->close();
?>
