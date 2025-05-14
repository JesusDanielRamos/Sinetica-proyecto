<!DOCTYPE html>
<html>
<head>
    <title>Registro - Sinetica</title>
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
        /* Pantalla de carga */
        #loadingScreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8); /* Fondo translúcido */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* El contenido principal */
        #content {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Pantalla de carga -->
    <div id="loadingScreen">
        <div class="spinner"></div>
    </div>

    <!-- Contenido principal -->
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

    <script>
        // Cuando la página haya cargado completamente, espera un poco antes de ocultar la pantalla de carga
        window.addEventListener('load', function() {
            // Establecer un retraso antes de ocultar la pantalla de carga (2 segundos en este caso)
            setTimeout(function() {
                document.getElementById('loadingScreen').style.display = 'none';  // Ocultamos la pantalla de carga
                document.getElementById('content').style.display = 'block';  // Mostramos el contenido principal
            }, 2000); // 2000 milisegundos = 2 segundos
        });
    </script>
</body>
</html>
