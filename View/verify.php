<?php
$hashGuardado = '$2y$10$F9Eh/Zwl9KmBFhtBOkRb/O0rTFeoNgja1L/1zNStEy9DkXHfM0P1O'; // reemplaza con un hash real desde tu base
$passwordIngresado = '1234'; // o la que hayas usado

if (password_verify($passwordIngresado, $hashGuardado)) {
    echo "¡Contraseña correcta!";
} else {
    echo "Contraseña incorrecta.";
}
?>
