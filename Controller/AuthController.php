<?php
session_start();
include("../conexion.php");
include("../Model/Usuario.php");

$action = $_POST['action'] ?? '';

if ($action === 'register') {
    $username = trim($_POST['username']);
    $alias = trim($_POST['alias']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $pronombres = trim($_POST['pronombres']);
    $workArea = $_POST['WorkArea'] ?? '';
    $workTools = $_POST['WorkTools'] ?? '';
    $workModality = $_POST['WorkModality'] ?? '';
    
    $picProfile = 'default.jpg';


    
    // Procesar imagen de perfil
    if (isset($_FILES['PicProfile']) && $_FILES['PicProfile']['error'] === UPLOAD_ERR_OK) {
        $imageTmp = $_FILES['PicProfile']['tmp_name'];
        $imageName = uniqid() . '_' . basename($_FILES['PicProfile']['name']);
        $imagePath = "../uploads/profiles/" . $imageName;
        
        // Verificar que la carpeta de perfiles exista
        if (!is_dir("../uploads/profiles")) {
            mkdir("../uploads/profiles", 0777, true);
        }

        // Mover archivo y actualizar nombre de perfil
        if (move_uploaded_file($imageTmp, $imagePath)) {
            $picProfile = $imageName;
        }
    }

    // Registrar usuario
    if (Usuario::registrar($username, $alias, $email, $password, $picProfile, $pronombres, $workArea, $workTools, $workModality)) {
        header("Location: ../View/login.php");
        exit;
    } else {
        echo "Error al registrar usuario.";
    }
    
    
} 



// Manejo del login
if ($action === 'login') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $usuario = Usuario::buscarPorUsername($username);

    if ($usuario && password_verify($password, $usuario['Contrasena'])) {
        $_SESSION['UserID'] = $usuario['UserID'];
        $_SESSION['Username'] = $usuario['Username'];
        
        header("Location: ../View/posts.php");
        exit;
    } else {
        // Si falla el login
        header("Location: /View/Login.php?error=1");
        exit;

    }
} 
else {
    error_log("Error al registrar usuario: " . $stmt->error);
    echo "Error al registrar usuario.";


}

error_log("Error al registrar usuario: " . $stmt->error);
echo "Error al registrar usuario.";