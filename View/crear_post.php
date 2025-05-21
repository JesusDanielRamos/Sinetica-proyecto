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
include_once("../Model/Usuario.php");

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
// Obtener categorías
$categorias = Post::getCategorias();

// Capturar categoría seleccionada si hubo un submit previo
$categoriaSeleccionada = $_POST['categoria'] ?? '';
$current_user_id = $_SESSION['UserID'];
$usuario = Usuario::buscarPorId($current_user_id);

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/estilo.css">

    <title>Crear nueva publicación</title>
    <style>
        .morado{ background-color: #9B8AED!important; }
        .crema{ background-color: #eef0db!important; }
        input[type="text"], textarea {
            width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;
        }
        input[type="file"] {
            margin-bottom: 15px;
        }
        
        
        a { text-decoration: none; color: #007bff; }
    </style>
</head>
<body>
<div class="contenedor_todo_posts">
        <div class="top_nav_main">
            <div class="top_nav_izquierda_main"> 
            <a href="posts.php" style="text-decoration: none; color: inherit;">SINETICA </a>
            </div>
            <div class="top_nav_derecha_main">
                PUBLICAR
            </div>
        </div>

<div class="form-container">
    <h2>Crear nueva publicación</h2>

    <form id="form-publicar" action="../Controller/guardar_post.php" method="POST" enctype="multipart/form-data">
        <label for="subir_imagen" id="label_de_subir_imagen" class="subir_imagen_label">
            Subir foto
            <div id="imagen_placeholder">
                <img id="imagen_post"src="../assets/subir_imagen.svg" alt="">
            </div>
        </label>
        <input id="subir_imagen" type="file" name="image" accept="image/*">  

        <input id="input_titulo" type="text" name="title" placeholder="Título del proyecto" required>

        <textarea id="input_descripcion_post" name="content" placeholder="Descripción / detalles del proyecto" rows="5" required></textarea>

        <div id="#contenedor_select">
            <select name="categoria" id="categoria" required>
                <option value="">Categoría</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= htmlspecialchars($categoria ?? '') ?>"
                        <?= $categoria === $categoriaSeleccionada ? 'selected' : '' ?>>
                        <?= htmlspecialchars($categoria ?? '') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        

        
        <button type="submit">Publicar</button>
        </form>
    
</div>
<div class="bottom_nav_main">
    <div class="izquierda">
        Yo soy <br> @<?= htmlspecialchars($usuario['Username']  ?? '') ?>    
    </div>
    <div class="derecha ">
        <div style="background-color: #9B8AED">
            <a href="perfil.php">Atrás</a>
        </div>
        <div>
            <a href="posts.php">Comunidad</a>

        </div>
    </div>
</div>
<script>
document.querySelectorAll('.opcion').forEach(function(item) {
    item.addEventListener('click', function() {
        const valor = this.getAttribute('data-value');
        document.getElementById('categoriaInput').value = valor;

        // Opcional: resaltar seleccionado
        document.querySelectorAll('.opcion').forEach(el => el.classList.remove('seleccionado'));
        this.classList.add('seleccionado');
    });
});
document.getElementById('subir_imagen').addEventListener('change', function(event) {
    const input = event.target;
    const placeholder = document.getElementById('imagen_placeholder');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            placeholder.innerHTML = `<img src="${e.target.result}" alt="Vista previa" style="max-width: 100%;  object-fit: contain;">`;
        };
        document.querySelector("#imagen_post").style.width="100%!important";
        reader.readAsDataURL(input.files[0]);
    }
});
</script>
</body>
</html>
