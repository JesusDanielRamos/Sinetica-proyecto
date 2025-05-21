<?php
session_start();
include_once("../Model/Post.php");
include_once("../Model/Usuario.php");

// Verificamos si el usuario ha iniciado sesión
if (!isset($_SESSION['UserID'])) {
    header("Location: ../View/login.php");
    exit;
}

// Obtener todas las publicaciones
$posts = Post::getAll();
// Obtener el ID del usuario actual
$current_user_id = $_SESSION['UserID'];
//obtiene el nombre de la pagina actual
$current_page = basename($_SERVER['PHP_SELF']);
// Obtener todas las categorías para el filtro
$categorias = Post::getCategorias();

// Obtener la categoría seleccionada (si existe)
$categoriaSeleccionada = $_GET['categoria'] ?? null;

// Obtener todas las publicaciones (con o sin filtro)
$posts = Post::getAll($categoriaSeleccionada);
$usuario = Usuario::buscarPorId($current_user_id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/estilo.css">
    <meta charset="UTF-8">
    <title>Publicaciones</title>
    <style>.morado{ background-color: #9B8AED!important; }
        .crema{ background-color: #eef0db!important; }</style>
</head>
<body>
    
<div class="contenedor_todo_posts">
        <div class="top_nav_main">
            <div class="top_nav_izquierda_main"> 
            <a href="posts.php" style="text-decoration: none; color: inherit;">SINETICA </a>
            </div>
            <div class="top_nav_derecha_main">
                COMUNIDAD
            </div>
        </div>
        <div class="nav_main">
            <div class="nav_tercio">
                <ul class="nav_filtros">
                    <li>VIRTUAL</li>
                    <li>HÍBRIDO</li>
                    <li>PRESENCIAL</li>
                </ul>
            </div>
            <div id="filtro_categoria">
                <form method="GET">
                <select name="categoria" onchange="this.form.submit()">
                    <option value="">Todas las categorías</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= htmlspecialchars($categoria ?? '') ?>" <?= $categoria === $categoriaSeleccionada ? 'selected' : '' ?>>
                        <?= htmlspecialchars($categoria ?? '') ?>
                        </option>
                        <?= htmlspecialchars($categoria) ?>
                        </option>
                        <?= htmlspecialchars($categoria) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
            </div>

            <div class="nav_tercio">
                <ul class="nav_filtros">
                    <li>+ POPULAR</li>
                    <li>CRONOLÓGICO</li>
                    <li>PUNTOS</li>
                </ul>
                
            </div>
        </div>
    

    <div class="container">
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <div class="author">
                    
                    <a class="profile-link" href="perfil.php?user_id=<?= htmlspecialchars($post['user_id'] ?? '') ?>">
                        @<?= htmlspecialchars($post['Username'] ?? '') ?>
                    </a>
                    <p class="categoria"> <?= htmlspecialchars($post['categoria'] ?? '') ?></p>
                </div>
                <?php if (!empty($post['image'])): ?>
                    <img class="post-image" src="../uploads/<?= htmlspecialchars($post['image'] ?? '') ?>" alt="Imagen del post">
                <?php endif; ?>
                <!-- <p class="date">Publicado el <?= htmlspecialchars($post['created_at']) ?></p> -->
                <h3 class="title"><?= htmlspecialchars($post['title'] ?? '') ?></h3>
                
                <p class="content"><?= nl2br(htmlspecialchars($post['content'] ?? '')) ?></p>


                
                
                
            </div>
            <div class="barra_like_conectar">
                    <div class="like">
                    <form class="form_like" method="POST" action="../Controller/like_controller.php">
                        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                        <?php $hasLiked = Post::userHasLiked($post['id'], $current_user_id); ?>
                        <button type="submit" class="like-btn<?= $hasLiked ? ' liked' : '' ?>">
                        ⬤ <?= $hasLiked ? '✓' : '+1' ?>
                        </button>
                    </form>
                    </div>
                    <div class="conectar">
                    <a href="perfil.php?user_id=<?= htmlspecialchars($post['user_id']) ?>">
                            CONECTAR
                    </a>
                    </div>
                </div>
        <?php endforeach; ?>
    </div>
    <div id=crear_publicacion>
        <button><a class="btn-publicar" href="crear_post.php">Crear publicación</a></button>
    </div>
    <div class="bottom_nav_main">
            <div class="izquierda">
            Yo soy <br> @<?= htmlspecialchars($usuario['Username']  ?? '') ?>
                
            </div>
            <div class="derecha">
                <div class="<?= $current_page === 'posts.php' ? 'morado' : 'crema' ?>">
                    <a href="">Comunidad</a>
                </div>
                <div>
                    <a class="profile-btn" href="perfil.php?user_id=<?= $current_user_id ?>">Mi Perfil</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
