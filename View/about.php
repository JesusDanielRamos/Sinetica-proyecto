<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Sinetica</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/ribes-black" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/vg5000" rel="stylesheet">
    <style>
        body {
            
            background-color: #eef0db !important;
            color: #333;
            margin: 0;
            padding: 2rem;
            
        }
        h1 {
            text-align: center;
            font-family: 'Ribes-Black', sans-serif;
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: #333;
        }
        .color-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            max-width: 1200px;
            margin: auto;
        }
        .color-card {
            background-color: #fff;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .color-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
        }
        .color-block {
            height: 150px;
            border-radius: 1rem 1rem 0 0;
        }
        .color-info {
            padding: 1.5rem;
            text-align: center;
            font-family: 'VG5000', sans-serif;
        }
        .color-name {
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }
        .color-code {
            font-size: 0.9rem;
            color: #777;
        }
        
         
img{
    max-width: 100%;
}
 
.container-all{
    position: relative;
    max-width: 1000px;
    width: 100%;
    overflow: hidden;
    
}
 
.slide{
    display: flex;
    transform: translate3d(0,0,0);
    transition: all 600ms;
    animation-name: autoplay;
    animation-duration: 15s;
    animation-direction: alternate;
    animation-fill-mode: forwards;
    animation-iteration-count: infinite;
}
 
.item-slide{
    position: relative;
    display: flex;
    flex-direction: column;
    flex-shrink: 0;
    flex-grow: 0;
    max-width: 100%;
}
 
.pagina{
    position: absolute;
    bottom: 20px;
    left: 0;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    width: 100%;
}
 
.pagina-item{
    display: flex;
    flex-direction: column;
    align-items: center;
    border:  2px solid white;
    width: 16px;
    height: 16px;
    overflow: hidden;
    cursor: pointer;
    background: rgba(255, 255, 255, 0.5);
    margin: 0 10px;
    text-align: center;
    transition: all 300ms;
}
 
.pagina-item:hover{
    transform: scale(2);
}
 
.pagina-item img{
    display: inline-block;
    max-width: none;
    height: 100%;
    transform: scale(1);
    opacity: 0;
    transition: all 900ms;
}
 
.pagina-item:hover img{
    opacity: 1;
    transform: scale(1);
}

.carrousel{
    margin: 30px 0;
     display: flex;
    align-items: center;
    justify-content: center;
}
 
input[id="1"]:checked ~ .slide{
    animation: none;
    transform: translate3d(0,0,0);
}
 
input[id="1"]:checked ~ .pagina .pagina-item[for="1"]{
    background: #fff;
}
 
input[id="2"]:checked ~ .slide{
    animation: none;
    transform: translate3d(100% * 1), 0, 0;
}
 
input[id="2"]:checked ~ .pagina .pagina-item[for="2"]{
    background: #fff;
}
 
input[id="3"]:checked ~ .slide{
    animation: none;
    transform: translate3d(100% * 2), 0, 0;
}
 
input[id="3"]:checked ~ .pagina .pagina-item[for="3"]{
    background: #fff;
}
 
input[id="4"]:checked ~ .slide{
    animation: none;
    transform: translate3d(100% * 3), 0, 0;
}
 
input[id="4"]:checked ~ .pagina .pagina-item[for="4"]{
    background: #fff;
}
 
input[id="5"]:checked ~ .slide{
    animation: none;
    transform: translate3d(100% * 4), 0, 0;
}
 
input[id="5"]:checked ~ .pagina .pagina-item[for="5"]{
    background: #fff;
}
 
@keyframes autoplay{
    20%{
        transform: translate(calc(-100% * 0));
 
    }
 
    40%{
        transform: translate(calc(-100% * 1));
        
    }
 
    60%{
        transform: translate(calc(-100% * 2));
        
    }
 
    80%{
        transform: translate(calc(-100% * 3));
        
    }
 
    100%{
        transform: translate(calc(-100% * 4));
        
    }
}
    </style>
     <link rel="stylesheet" href="/css/estilo.css">
</head>
<body>
    <div class="top_nav_main">
            <div class="top_nav_izquierda_main"> 
            <a href="../index.php" style="text-decoration: none; color: inherit;">SINETICA </a>
            </div>
            <div class="top_nav_derecha_main">
                ABOUT
            </div>
        </div>
    <h1 style="margin-top: 150px">About Us - Sinetica</h1>
    <p style="text-align: center; font-family: 'Montserrat', sans-serif; margin:20px 30px; font-size: 1.1rem; color: #555;">
        Sinetica consiste en el desarrollo de una página web que ofrece un espacio digital para que profesionales y entusiastas del diseño puedan publicar y exhibir sus portafolios. La plataforma está pensada para facilitar la conexión entre diseñadores, proveedores de servicios y clientes potenciales. Su finalidad es destacar y promover el talento del ecosistema creativo de Ciudad Juárez, al mismo tiempo que impulsa la colaboración y la visibilidad del sector.
    </p>
    
    <p style="text-align: center; font-family: 'Montserrat', sans-serif; margin-bottom: 2rem; font-size: 1.1rem; color: #555;">
        Las fuentes utilizadas para este proyecto son <strong>Ribes-Light</strong>, <strong>Ribes-Black</strong> y <strong>VG5000</strong>, seleccionadas para reflejar nuestra identidad única y creativa.
    </p>

    <div style="text-align: center; margin-bottom: 2rem;">
        <h2>Sinetica.fun</h2>
        <img src="../assets/qrcode-sinetica.png" alt="Código QR" style="width: 200px; border-radius: 1rem; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
    </div>
    
     <div style="text-align: center; margin-bottom: 2rem;">
         <h2>Github</h2>
        <img src="../assets/qrcode-github.png" style="width: 200px;  border-radius: 1rem; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
    </div>

      <div style="text-align: center; margin-bottom: 2rem;">
         <h2>Diagrama de sitio</h2>
        <img src="../assets/diagramaFlechas.png" alt="Código QR" style="width: 400px; height:400px; border-radius: 1rem; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
    </div>
     <div style="text-align: center; margin-top: 3rem; padding: 1rem; ">
      <a href="about.php" style=" text-decoration: none;">© Copyright----Sinetica 2025 </a>  Todos los derechos reservados.
    </div>
    <h2 style="text-align: center; margin-bottom: 2rem;">Paleta de colores</h2>
    <div class="color-container">
        
        <div class="color-card">
            <div class="color-block" style="background-color: #F96E46;"></div>
            <div class="color-info">
                <div class="color-name">Color 1</div>
                <div class="color-code">#F96E46</div>
            </div>
        </div>
        <div class="color-card">
            <div class="color-block" style="background-color: #eef0db;"></div>
            <div class="color-info">
                <div class="color-name">Color 2</div>
                <div class="color-code">#eef0db</div>
            </div>
        </div>
        <div class="color-card">
            <div class="color-block" style="background-color: #2c3e50;"></div>
            <div class="color-info">
                <div class="color-name">Color 3</div>
                <div class="color-code">#2c3e50</div>
            </div>
        </div>
        <div class="color-card">
            <div class="color-block" style="background-color: #9B8AED;"></div>
            <div class="color-info">
                <div class="color-name">Color 4</div>
                <div class="color-code">#9B8AED</div>
            </div>
        </div>
    </div>
    
    <div class="carrousel">
        
        <div class="container-all">
        <input type="radio" name="image-slide" id="1" hidden>
        <input type="radio" name="image-slide" id="2" hidden>
        <input type="radio" name="image-slide" id="3" hidden>
        <input type="radio" name="image-slide" id="4" hidden>
        <input type="radio" name="image-slide" id="5" hidden>
 
        <div class="slide">
            <div class="item-slide">
                <img src="../uploads/1.jpg" alt="" srcset="">
            </div>
            <div class="item-slide">
                <img src="../uploads/2.png" alt="" srcset="">
            </div>
            <div class="item-slide">
                <img src="../uploads/3.jpg" alt="" srcset="">
            </div>
            <div class="item-slide">
                <img src="../uploads/4.jpg" alt="" srcset="">
            </div>
            <div class="item-slide">
                <img src="../uploads/5.png" alt="" srcset="">
            </div>
        </div>
 
        <div class="pagina">
                <div class="pagina-item" for="1">
                    <img src="../uploads/1.jpg" alt="" srcset="">
                </div>
                <div class="pagina-item" for="1">
                    <img src="../uploads/2.png" alt="" srcset="">
                </div>
                <div class="pagina-item" for="1">
                    <img src="../uploads/3.jpg" alt="" srcset="">
                </div>
                <div class="pagina-item" for="1">
                    <img src="../uploads/4.jpg" alt="" srcset="">
                </div>
                <div class="pagina-item" for="1">
                    <img src="../uploads/5.png" alt="" srcset="">
                </div>
        </div>
    </div>
        
   
 
    
</body>

</html>
