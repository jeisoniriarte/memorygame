<?php 
    session_start();

    if (!isset($_SESSION["loggedin"]) ) {
       header("location:index.php");
    }

    require_once "sql/date.php";
    $user = $_SESSION["username"];
    $sql = "SELECT id, user FROM users WHERE user = '$user'";
    $result = $date->query($sql);
    $row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="es">

<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P26FXXW');</script>
<!-- End Google Tag Manager -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Memory Game</title>
    <link rel="shortcut icon" href="https://img.icons8.com/color/48/000000/mario.png" type="image/x-icon">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/main.css">
</head>

<body class="cambio">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P26FXXW"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <div id="bienvenida" class="bienvenida">
        <h1>👋 ¡Hola! <?php echo $row["user"]; ?>👋</h1>
        <div class="bienvenida-botones">
            <button id="juego-normal">¡Quiero jugar!</button>
            <button id="juego-relax">Modo relax</button>
        </div>
        <a href="sql/close-session.php">Cerrar sesión</a>
    </div>
    <header class="cabecera">
        <div class="contadores">
            <div class="contador-item">
                <h4 class="cabecera-titulo">Movimientos</h4>
                <div class="cabecera-num">
                    <span id="mov">00</span>/<span id="mov-total">00</span>
                </div>
            </div>
            <div id="cronometro" class="contador-item">
                <h4 class="cabecera-titulo">Tiempo</h4>
                <div class="cabecera-num">
                    <span id="minutos">00</span>:<span id="segundos">00</span>
                </div>
            </div>
        </div>
        <div class="nivel">
            <h4 class="cabecera-titulo">Nivel</h4>
            <div class="cabecera-num"><span id="nivel">01</span></div>
        </div>
        <button id="control-nivel" class="control-nivel">…</button>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <img src="https://img.icons8.com/color/48/000000/mario.png" alt="Memory Game">
                <h1>
                    <p class="jumbotron-heading mb-2">Memory Game</p>
                </h1>
            </div>
        </div>
    </div>
    <main>
        <div id="mesa" class="mesa"></div>
        <div id="subeNivel" class="sube-nivel">
            <div class="modal-game">
                <h2>¡Muy bien! 👍</h2>
                <button id="subir">Siguiente nivel</button>
                <button class="reiniciar">Reiniciar</button>
            </div>
        </div>
        <div id="gameOver" class="game-over">
            <div class="modal-game">
                <h2>¡Oh no!</h2>
                <p>Te has quedado sin movimientos 😭</p>
                <button class="reiniciar">Reiniciar</button>
            </div>
        </div>
        <div id="timeOver" class="game-over">
            <div class="modal-game">
                <h2>¡Oh no!</h2>
                <p>Te has quedado sin tiempo 😭</p>
                <button class="reiniciar">Reiniciar</button>
            </div>
        </div>
        <div id="endGame" class="end-game">
            <div class="modal-game">
                <h2>¡Enhorabuena!</h2>
                <p>Has superado todos los niveles 🏆</p>
                <button class="reiniciar">Reiniciar</button>
            </div>
        </div>
    </main>
    <div class="selecciona-nivel">
        <button id="cierra-niveles" class="cierra-niveles">&times;</button>
        <ul></ul>
    </div>


    <audio src="sonidos/acierto.mp3" class="sonido" id="sonido-acierto" preload="auto"></audio>
    <audio src="sonidos/error.mp3" class="sonido" id="sonido-error" preload="auto"></audio>
    <audio src="sonidos/carta.mp3" class="sonido" id="sonido-carta" preload="auto"></audio>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

    <script src="js/juego.js"></script>
</body>

</html>