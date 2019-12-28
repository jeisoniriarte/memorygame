<?php
    require 'sql/code-login.php';
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
    <link rel="shortcut icon" href="images/memory-48.png" type="image/x-icon">
    <!-- Bootstrap & Apis -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
    <!-- Estilos -->
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P26FXXW"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <div id="login" class="back-main flex">
        <div class="container back-main-container">
            <div class="image-logo">
                <img src="images/memory-96.png" alt="Memory Game">
            </div>
            <div class="row m-0">
                <div class="col-lg-5 user-register">
                    <div class="sesion">
                        <p class="text-center">Iniciar Sesión</p>
                        <form id="form-user" action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> " method="post">
                            <label> Usuario: <input type="text" id="user" name="username" value=""/>
                                <span class="msg-error"> <?php echo $username_error; ?> </span>
                            </label>

                            <label> Contraseña: <input type="password" id="pass" name="password" value=""/>
                                <span class="msg-error"> <?php echo $password_error; ?> </span>
                            </label>

                            <button id="boton" class="button-login" type="submit" data-toggle="modal" data-target="#modal-confirm">Ingresar</button>
                        </form>
                    </div>
                    <div class="text-center">
                        <span class="footer-login">¿Aún no te has registrado?
                            <a class="enlace" href="register.php">Regístrate</a>
                        </span>
                    </div>
                </div>
                <div class="col-lg-7 fondo-img">
                    <div class="capa"></div>
                    <div class="text-title">
                        <!-- <div class="image-logo">
                            <img src="images/memory-96.png" alt="Memory Game">
                        </div> -->
                        <h1>Memory Game</h1>
                        <p>Disfruta y diviértete en un juego muy didáctico y con gran diseño, gran variedad entre los iconos de animales fabulosos para que te entretengas. Pensado especialmente para ti...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <!-- <div class="modal modal-confirm fade" id="modal-confirm" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div id="bienvenida" class="mensaje"></div>
        </div>
    </div> -->

    <!-- Bootstrap, Apis & Framework-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Estilos -->
    <!-- <script src="js/inicio.js"></script> -->
</body>

</html>