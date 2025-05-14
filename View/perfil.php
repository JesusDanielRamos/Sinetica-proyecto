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
$profile_user_id = $_GET['user_id'];
$usuario = Usuario::buscarPorId($profile_user_id);

// Verificar si es su propio perfil
$is_own_profile = ($current_user_id == $profile_user_id);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de <?= htmlspecialchars($usuario['Username']) ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
        }
        .profile-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }
        .profile-container img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }
        .profile-container h2 {
            margin: 0 0 10px 0;
        }
        .profile-container p {
            color: #555;
        }
        .btn-back {
            display: inline-block;
            background-color: #3498db;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            margin-bottom: 20px;
            transition: background-color 0.2s ease;
        }
        .btn-back:hover {
            background-color: #2979b9;
        }
        .btn-edit {
            display: inline-block;
            background-color: #2ecc71;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            margin-bottom: 20px;
            transition: background-color 0.2s ease;
        }
        .btn-edit:hover {
            background-color: #27ae60;
        }
         .logout-btn {
            display: block;
            background-color: #f04a27;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
            transition: background-color 0.2s ease;
        }
        .logout-btn:hover {
            background-color: #bf2100;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <img src="../uploads/profiles/<?= htmlspecialchars($usuario['PicProfile'] ?: 'default.jpg') ?>" alt="Imagen de perfil">
        <h2>@<?= htmlspecialchars($usuario['Username']) ?></h2>
        <p><?= nl2br(htmlspecialchars($usuario['bio'] ?: 'Este usuario no tiene biografía.')) ?></p>

        <a href="Home.php" class="btn-back">Regresar</a>
        <?php if ($is_own_profile): ?>
            <a href="editar_perfil.php" class="btn-edit">Editar perfil</a>
            <a href="cerrar_sesion.php" class="logout-btn">Cerrar sesión</a>
        <?php endif; ?>
    </div>
</body>
</html>
