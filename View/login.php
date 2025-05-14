<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Sinetica</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
        }
        .login-container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 15px;
            padding: 40px 20px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }
        .login-container h1 {
            color: #3498db;
            margin-bottom: 20px;
        }
        .login-container input[type="text"], .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 10px;
            border: 1px solid #ccc;
        }
        .login-container button {
            background-color: #3498db;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 25px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.2s ease;
            width: 100%;
        }
        .login-container button:hover {
            background-color: #2979b9;
        }
        .login-container a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }
        .login-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Bienvenido a Sinetica</h1>
        <h2>Iniciar Sesión</h2>
        <form action="../Controller/AuthController.php" method="POST">
            <input type="hidden" name="action" value="login">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
        </form>
        <p><a href="Registro.php">¿No tienes cuenta? Regístrate</a></p>
    </div>
</body>
</html>
