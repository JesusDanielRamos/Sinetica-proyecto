<?php
session_start();
include("../conexion.php");
include("../Model/Post.php");

// Verificamos que el usuario ha iniciado sesión
if (!isset($_SESSION['UserID'])) {
    header("Location: ../View/login.php");
    exit;
}

// Obtenemos el ID del usuario desde la sesión
$user_id = $_SESSION['UserID'];
$title = trim($_POST['title']);
$content = trim($_POST['content']);
$imageName = null;

// Validación básica
if (empty($title) || empty($content) || empty($_POST['categoria'])) {
    echo "Todos los campos son obligatorios.";
    exit;
}

// Procesamiento de la categoría (puede ser múltiple)
$categoria = is_array($_POST['categoria']) ? implode(", ", $_POST['categoria']) : $_POST['categoria'];

// Procesamiento de la imagen
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $imageTmp = $_FILES['image']['tmp_name'];
    $imageName = uniqid() . "_" . basename($_FILES['image']['name']);
    $imagePath = "../uploads/" . $imageName;

    // Verificamos que la carpeta de uploads exista
    if (!is_dir("../uploads")) {
        mkdir("../uploads", 0777, true);
    }

    move_uploaded_file($imageTmp, $imagePath);
}

// Creamos el array de datos para el modelo
$data = [
    'user_id' => $user_id,
    'title' => $title,
    'content' => $content,
    'categoria' => $categoria,  // Usa la variable $categoria correctamente
    'image' => $imageName
];

 // Mostrar todo el contenido de $_POST y $_FILES para debug
 echo "<pre>";
 print_r($_POST);
 print_r($_FILES);
 echo "</pre>";

// Guardamos la publicación
if (Post::create($data)) {
    header("Location: ../View/posts.php");
    exit;
} else {
    
    echo "Error al guardar la publicación: " . $conn->error;
}

?>
