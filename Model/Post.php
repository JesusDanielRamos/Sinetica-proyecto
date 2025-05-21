<?php
include("../conexion.php");

class Post {

  // Método para obtener todas las publicaciones
// Método para obtener todas las publicaciones, opcionalmente filtradas por categoría
public static function getAll($categoria = null, $orden = 'recientes', $modalidad = null) {
    global $conn;

    // Unificar los valores de orden que deben usar el conteo de likes
    $orden = in_array($orden, ['popular1', 'popular2', 'antiguos']) ? 'popular' : $orden;


    // Definir el ORDER BY según el filtro de orden
    switch ($orden) {
        case 'popular':
            $orderBy = 'like_count DESC';
            break;
        case 'recientes':
        default:
            $orderBy = 'posts.created_at DESC';
            break;
    }

    // Consulta base
    $sql = "
        SELECT 
            posts.*, 
            Usuario.Username, 
            Usuario.PicProfile, 
            Usuario.WorkModality,
            (SELECT COUNT(*) FROM Likes WHERE Likes.PostID = posts.id) AS like_count 
        FROM posts 
        JOIN Usuario ON posts.user_id = Usuario.UserID
        WHERE 1 = 1
    ";

    $types = '';
    $params = [];

    if (!empty($categoria)) {
        $sql .= " AND posts.categoria = ?";
        $types .= 's';
        $params[] = $categoria;
    }

    if (!empty($modalidad)) {
        $sql .= " AND Usuario.WorkModality = ?";
        $types .= 's';
        $params[] = $modalidad;
    }

    $sql .= " ORDER BY $orderBy";

    $stmt = $conn->prepare($sql);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    // Devolver resultados
    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}


public static function getCategorias() {
    global $conn;

    //$sql = "SELECT DISTINCT categoria FROM posts ORDER BY categoria ASC";
    $sql = "SELECT categoria FROM WorkAreas";
    $result = $conn->query($sql);
    $categorias = [];

    while ($row = $result->fetch_assoc()) {
        $categorias[] = $row['categoria'];
    }

    return $categorias;
}


   // Método para crear una nueva publicación
   public static function create($data) {
    global $conn;

    // Preparar la declaración SQL para insertar la publicación con categoría
    $sql = "INSERT INTO posts (user_id, title, content, categoria, image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros
    $stmt->bind_param(
        "issss",
        $data['user_id'],
        $data['title'],
        $data['content'],
        $data['categoria'],  // Esto ahora puede ser una lista de categorías separadas por comas
        $data['image']
    );

    // Ejecutar y devolver el resultado
    return $stmt->execute();
    }


    // Método para verificar si un usuario ha dado like a una publicación
public static function userHasLiked($post_id, $user_id) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM Likes WHERE PostID = ? AND UserID = ?");
    $stmt->bind_param("ii", $post_id, $user_id);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

// Método para añadir un like
public static function addLike($post_id, $user_id) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO Likes (PostID, UserID) VALUES (?, ?)");
    $stmt->bind_param("ii", $post_id, $user_id);

    return $stmt->execute();
}

// Método para eliminar un like
public static function removeLike($post_id, $user_id) {
    global $conn;

    $stmt = $conn->prepare("DELETE FROM Likes WHERE PostID = ? AND UserID = ?");
    $stmt->bind_param("ii", $post_id, $user_id);

    return $stmt->execute();
}

public static function getAllPorUsuario($user_id) {
    global $conn;
    
    $sql = "
        SELECT p.*, u.Username
        FROM posts p
        JOIN Usuario u ON p.user_id = u.UserID
        WHERE p.user_id = ?
        ORDER BY p.created_at DESC
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}


}
?>
