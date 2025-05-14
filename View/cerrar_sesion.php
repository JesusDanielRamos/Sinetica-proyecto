<?php
session_start();
include_once("../Model/Usuario.php");

// Verificamos si el usuario ha iniciado sesión
if (!isset($_SESSION['UserID'])) {
    header("Location: ../View/login.php");
    exit;
}

// Obtener el ID del usuario actual
$current_user_id = $_SESSION['UserID'];
$usuario = Usuario::buscarPorId($current_user_id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>YA TE VAS?</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
        }
        .confirm-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 15px;
            padding: 40px 20px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }
        .confirm-container h2 {
            margin-bottom: 20px;
        }
        .confirm-container a, .confirm-container form button {
            background-color: #3498db;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            margin: 10px;
            transition: background-color 0.2s ease;
            cursor: pointer;
            border: none;
        }
        .confirm-container a:hover, .confirm-container form button:hover {
            background-color: #2979b9;
        }
        .confirm-container .cancel-btn {
            background-color: #e74c3c;
        }
        .confirm-container .cancel-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="confirm-container">
        <h2>¿Ya te vas?</h2>
        <form action="../logout.php" method="POST">
            <button type="submit">Sí, cerrar sesión</button>
        </form>
        <a href="perfil.php?user_id=<?= $current_user_id ?>" class="cancel-btn">Cancelar</a>
    </div>
</body>
</html>
