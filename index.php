<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/css/estilo.css">
    <title>Registro - Sinetica</title>
    
</head>
<body>
    <div class="contenedor_columna">
        <!-- Pantalla de carga -->
        <div id="loadingScreen">
            <div id="titulo">SINETICA</div>
            <div id="barra">

                <div id="progreso"><p id="porcentaje">0%</p></div></div>
            <div id="manos"><img src="/assets/inicio.svg" alt=""></div>
        </div>

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
                <a href="/View/Registro.php">REGISTRARME</a>
                </p>
            </div>
        </div>
        <div class="login-container">
            <form id="form-login" action="/Controller/AuthController.php" method="POST" class="registro">
                <input type="hidden" name="action" value="login">
                <label for="username">NOMBRE DE USUARIO</label>
                <input type="text" name="username" placeholder="Username" required>
                <label for="password">CONTRASEÑA</label>
                <input type="password" name="password" placeholder="Contraseña" required>
            </form>
        </div>
        <div class="imagen_fondo">
            <img src="/assets/llave.svg" alt="">
        </div>
        <div class="bottom_nav">
            <div class="tercio_izquierdo">
                 <a href="View/about.php" >@Copyright----Sinetica2025 </a>
            </div>
            <div class="dos_tercios_derecha">
                <button id="btn_login">INICIAR SESIÓN</button>
            </div>
        </div>
    </div>

    <script>
        // Cuando la página haya cargado completamente, espera un poco antes de ocultar la pantalla de carga
       if (!localStorage.getItem('loadingShown')) {

        const duration = 5000;
        const porcentaje = document.getElementById("porcentaje");
        let percent = 0;

        const interval = setInterval(() => {
            percent++;
            porcentaje.textContent = percent + "%";

            if (percent >= 100) {
                clearInterval(interval);
            }
        }, duration / 100);

        // Oculta la pantalla de carga después de 5 segundos
        setTimeout(function() {
            document.getElementById('loadingScreen').style.display = 'none';
            // Marca como mostrado
            localStorage.setItem('loadingShown', 'true');
        }, 5000);
        } else {
        // Si ya se mostró antes, oculta directamente
        document.getElementById('loadingScreen').style.display = 'none';
        }
        document.getElementById("btn_login").addEventListener("click", function() {
            
        document.getElementById("form-login").submit();
        });
    </script>



    <!-- Modal de error -->
    <div id="modal-error" style="display: none;" class="modal-error">
        <div class="modal-contenido">
            <p>Usuario o contraseña incorrectos.</p>
            <button onclick="cerrarModal()">Cerrar</button>
        </div>
    </div>

    <style>
    .modal-error {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999;
    }
    .modal-contenido {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
    }
    </style>

    <script>
    function cerrarModal() {
        document.getElementById('modal-error').style.display = 'none';
    }

    // Mostrar modal si hay error en la URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('error') === '1') {
        document.getElementById('modal-error').style.display = 'flex';
    }
    </script>

</body>
</html>
