<?php
session_start();
include_once("../Model/Post.php");
include_once("../Model/Usuario.php");

if (!isset($_SESSION['UserID'])) {
    header("Location: ../View/login.php");
    exit;
}

// Variables de usuario
$current_user_id = $_SESSION['UserID'];
$current_page = basename($_SERVER['PHP_SELF']);
$usuario = Usuario::buscarPorId($current_user_id);

// Filtros desde la URL
$orden = $_GET['orden'] ?? 'recientes';
$categoriaSeleccionada = $_GET['categoria'] ?? null;


$modalidadURL = strtolower($_GET['modalidad'] ?? '');
$modalidadSeleccionada = null;
if (isset($_GET['modalidad'])) {
    $mapaModalidades = [
        'virtual' => 'Remota',
        'híbrido' => 'Mixta',
        'presencial' => 'Presencial'
    ];
    $modalidadSeleccionada = $mapaModalidades[strtolower($_GET['modalidad'])] ?? null;
}


// Obtener publicaciones filtradas
$posts = Post::getAll($categoriaSeleccionada, $orden, $modalidadSeleccionada);

// Obtener categorías disponibles
$categorias = Post::getCategorias();

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/estilo.css?v=<?= time() ?>">

    <meta charset="UTF-8">
    <title>Publicaciones</title>
    <style>
    .morado{ background-color: #9B8AED!important; }
        .crema{ background-color: #eef0db!important; }
        
        .nav_filtros li.activo {
        background-color: #9B8AED; /* Morado claro */
        font-weight: bold;
         }

         .nav_filtros li:first-child {
            
        }

         .nav_filtros li a{
        text-decoration: none;

         }

        .nav_filtros li.activo a {
            
            text-decoration: none;
        }

        
        </style>
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
            <li class="<?= $modalidadURL === 'virtual' ? 'activo' : '' ?>">
                <a href="posts.php?modalidad=virtual<?= $categoriaSeleccionada ? '&categoria=' . urlencode($categoriaSeleccionada) : '' ?>&orden=<?= urlencode($orden) ?>">VIRTUAL</a>
            </li>
            <li class="<?= $modalidadURL === 'híbrido' ? 'activo' : '' ?>">
                <a href="posts.php?modalidad=híbrido<?= $categoriaSeleccionada ? '&categoria=' . urlencode($categoriaSeleccionada) : '' ?>&orden=<?= urlencode($orden) ?>">HÍBRIDO</a>
            </li>
            <li class="<?= $modalidadURL === 'presencial' ? 'activo' : '' ?>">
                <a href="posts.php?modalidad=presencial<?= $categoriaSeleccionada ? '&categoria=' . urlencode($categoriaSeleccionada) : '' ?>&orden=<?= urlencode($orden) ?>">PRESENCIAL</a>
            </li>
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
                <li class="<?= ($_GET['orden'] ?? 'recientes') === 'popular1' ? 'activo' : '' ?>">
                <a href="posts.php?orden=popular1<?= $categoriaSeleccionada ? '&categoria=' . urlencode($categoriaSeleccionada) : '' ?>">+ POPULAR</a>
            </li>
                    <li class="<?= ($_GET['orden'] ?? 'recientes') === 'recientes' ? 'activo' : '' ?>">
                        <a href="posts.php?orden=recientes<?= $categoriaSeleccionada ? '&categoria=' . urlencode($categoriaSeleccionada) : '' ?>">CRONOLÓGICO</a>
                    </li>
                    <li class="<?= ($_GET['orden'] ?? 'recientes') === 'popular2' ? 'activo' : '' ?>">
                        <a href="posts.php?orden=popular2<?= $categoriaSeleccionada ? '&categoria=' . urlencode($categoriaSeleccionada) : '' ?>">PUNTOS</a>
                    </li>
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
