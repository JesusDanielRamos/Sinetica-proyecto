<?php
include("../conexion.php");

class Usuario {
    
      // Método para registrar un nuevo usuario en la base de datos
public static function registrar($username, $alias, $email, $password, $PicProfile, $pronombres, $workArea, $workTools, $workModality) {
    global $conn;

    // Hashear la contraseña para almacenarla de forma segura
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Preparar la consulta SQL para insertar un nuevo usuario
    $sql = "
    INSERT INTO Usuario (Username, Alias, Email, Contrasena, PicProfile, Pronombres, WorkArea, WorkTools, WorkModality) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssssss", 
        $username, 
        $alias, 
        $email, 
        $passwordHash, 
        $PicProfile, 
        $pronombres, 
        $workArea, 
        $workTools, 
        $workModality
    );

    // Ejecutar la consulta y devolver el resultado (true si fue exitoso, false si no)
    if ($stmt->execute()) {
        return true;
    } else {
        // Mostrar el error de MySQL para depuración
        error_log("Error en la consulta de registro: " . $stmt->error);
        return false;
    }
}


    // Método para buscar un usuario por su nombre de usuario (Username)
    public static function buscarPorUsername($username) {
        global $conn;

        // Preparar la consulta para buscar el usuario
        $sql = "SELECT * FROM Usuario WHERE Username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        // Obtener el resultado y verificar si se encontró un usuario
        $result = $stmt->get_result();
        return ($result->num_rows > 0) ? $result->fetch_assoc() : null;
    }

    // Método para buscar un usuario por su ID
public static function buscarPorId($user_id) {
    global $conn;

    // Preparar la consulta para buscar el usuario por ID
    $sql = "SELECT * FROM Usuario WHERE UserID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    // Obtener el resultado y verificar si se encontró un usuario
    $result = $stmt->get_result();
    return ($result->num_rows > 0) ? $result->fetch_assoc() : null;
}

   // Método para actualizar el perfil de un usuario
   public static function actualizarPerfil($user_id, $bio, $profile_image) {
    global $conn;

    // Preparar la consulta para actualizar el perfil del usuario
    $sql = "UPDATE  PicProfile = ? WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $profile_image, $user_id);

    // Ejecutar la consulta y devolver el resultado (true si fue exitoso, false si no)
    return $stmt->execute();
}

}
