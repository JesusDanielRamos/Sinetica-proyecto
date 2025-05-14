<?php
session_start();

// Elimina todas las variables de sesión
session_unset();

// Destruye la sesión
session_destroy();

// Redirige al login u otra página pública
header("Location: ../View/login.php");
exit;
?>
