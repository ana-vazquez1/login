<?php

$passwordform = "12345678";

echo md5($passwordform).'<br>';
echo sha1($passwordform).'<br>';

echo password_hash($passwordform, PASSWORD_DEFAULT).'<br>'; // Quité "algo:"

$passwordbd = password_hash($passwordform, PASSWORD_DEFAULT); // Quité "algo:"

if (password_verify("123456789", $passwordbd)) { // Cambié la contraseña a "12345678"
    echo "password correcto";
} else {
    echo "password incorrecto";
}
?>
