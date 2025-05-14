<?php
session_start();
include_once("../Model/Post.php");
include_once("../conexion.php");

// Verificamos si el usuario ha iniciado sesión
if (!isset($_SESSION['UserID'])) {
    header("Location: ../View/login.php");
    exit;
}

// Obtenemos los datos del formulario
$post_id = $_POST['post_id'];
$user_id = $_SESSION['UserID'];

// Verificamos si el usuario ya ha dado like
if (Post::userHasLiked($post_id, $user_id)) {
    // Si ya ha dado like, lo eliminamos
    Post::removeLike($post_id, $user_id);
} else {
    // Si no ha dado like, lo añadimos
    Post::addLike($post_id, $user_id);
}

// Redirigimos de vuelta a la página de publicaciones
header("Location: ../View/posts.php");
exit;
?>
