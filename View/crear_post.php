<?php
session_start();

// Verificamos si el usuario ha iniciado sesión
if (!isset($_SESSION['UserID'])) {
    header("Location: ../View/login.php");
    exit;
}

// Incluimos la conexión a la base de datos
include("../conexion.php");
require_once '../Model/Post.php';

// Inicializamos la lista de categorías
$categorias = [];

// Obtenemos las categorías desde la tabla WorkAreas
$sql = "SELECT Categoria FROM WorkAreas";
$result = $conn->query($sql);

// Verificamos que se hayan encontrado resultados
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Añadimos cada categoría al arreglo
        $categorias[] = $row['Categoria'];
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear nueva publicación</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .form-container { background: white; padding: 20px; max-width: 600px; margin: auto; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h2 { margin-bottom: 20px; }
        input[type="text"], textarea {
            width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;
        }
        input[type="file"] {
            margin-bottom: 15px;
        }
        button {
            background-color: #28a745; color: white; padding: 10px 20px;
            border: none; border-radius: 5px; cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        a { text-decoration: none; color: #007bff; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Crear nueva publicación</h2>

    <form action="../Controller/guardar_post.php" method="POST" enctype="multipart/form-data">
        <label>Título:</label>
        <input type="text" name="title" required>

        <label>Contenido:</label>
        <textarea name="content" rows="5" required></textarea>

        <label>Categoría:</label>
        <select name="categoria[]" required>
            <option value="">Seleccione una categoría</option>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?= htmlspecialchars($categoria) ?>"><?= htmlspecialchars($categoria) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Imagen (opcional):</label>
        <input type="file" name="image" accept="image/*">

        <button type="submit">Publicar</button>
    </form>

    <br>
    <a href="posts.php">← Volver a publicaciones</a>
</div>

</body>
</html>
