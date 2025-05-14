<?php
include("../conexion.php");

class Post {

  // Método para obtener todas las publicaciones
// Método para obtener todas las publicaciones, opcionalmente filtradas por categoría
public static function getAll($categoria = null) {
    global $conn;

    // Si se especifica una categoría, se filtra por ella
    if ($categoria) {
        $sql = "
        SELECT 
            posts.*, 
            Usuario.Username, 
            Usuario.PicProfile, 
            (SELECT COUNT(*) FROM Likes WHERE Likes.PostID = posts.id) AS like_count 
        FROM posts 
        JOIN Usuario ON posts.user_id = Usuario.UserID
        WHERE posts.categoria = ?
        ORDER BY posts.created_at DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $categoria);
    } else {
        // Si no se especifica una categoría, se traen todas las publicaciones
        $sql = "
        SELECT 
            posts.*, 
            Usuario.Username, 
            Usuario.PicProfile, 
            (SELECT COUNT(*) FROM Likes WHERE Likes.PostID = posts.id) AS like_count 
        FROM posts 
        JOIN Usuario ON posts.user_id = Usuario.UserID
        ORDER BY posts.created_at DESC";

        $stmt = $conn->prepare($sql);
    }

    // Ejecutar la consulta y devolver los resultados
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

public static function getCategorias() {
    global $conn;

    $sql = "SELECT DISTINCT categoria FROM posts ORDER BY categoria ASC";
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



}
?>
