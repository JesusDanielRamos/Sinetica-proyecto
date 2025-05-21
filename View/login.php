<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/estilo.css">
    <title>Registro - Sinetica</title>
    
</head>
<body>
    <div class="contenedor_columna">
       

        <!-- Contenido principal -->
        <div class="top_nav">
                <div class="top_nav_izquierda"> 
                SINETICA 
                </div>
                <div class="top_nav_derecha">
                    IDENTIFICARME
                </div>
        </div>
        <div class="nav">
            <div>
                <p class="p_izq">
                INICIAR SESIÓN
                </p>
            </div>
            <div>
                <p class="p_der">
                <a href="Registro.php">REGISTRARME</a>
                </p>
            </div>
        </div>
        <div class="login-container">
            <form id="form-login" action="../Controller/AuthController.php" method="POST" class="registro">
                <input type="hidden" name="action" value="login">
                <label for="username">NOMBRE DE USUARIO</label>
                <input type="text" name="username" placeholder="Username" required>
                <label for="password">CONTRASEÑA</label>
                <input type="password" name="password" placeholder="Contraseña" required>
            </form>
        </div>
        <div class="imagen_fondo">
            <img src="../assets/llave.svg" alt="">
        </div>
        <div class="bottom_nav">
            <div class="tercio_izquierdo">
         <a href="about.php">@Copyright----Sinetica2025</a>

            </div>
            <div class="dos_tercios_derecha">
                <button id="btn_login">INICIAR SESIÓN</button>
            </div>
        </div>
    </div>

    <script>
        // Cuando la página haya cargado completamente, espera un poco antes de ocultar la pantalla de carga
        
        document.getElementById("btn_login").addEventListener("click", function() {
            
        document.getElementById("form-login").submit();
        });
    </script>
</body>
</html>
