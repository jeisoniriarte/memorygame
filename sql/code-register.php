<?php 

    //INICIALIZAR LA SESION
    session_start();

    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        header("location: juego.php");
        exit;
    }

    //Incluir archivo de conexión a la base de datos
    require_once "date.php";

    //Definir variables e inicializar con valores vacios
    $username = $mail = $password = "";
    // $form_user = "";
    $username_error = $mail_error = $password_error = "";

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        
        // VALIDANDO INPUT NOMBRE DE USUARIO
        if(empty(trim($_POST["username"]))) {
            $username_error = "Ingrese un nombre de usuario.";
        } else {
            //prepara un declaracion de seleccion
            $sql = "SELECT id FROM users WHERE user = ?";

            if ($stmt = mysqli_prepare($date, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                $param_username = trim($_POST["username"]);

                if (mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1){
                        $username_error = "Este nombre de usuario ya existe.";
                    }else {
                        $username = trim($_POST["username"]);
                    }
                } else {
                    echo "Algo salió mal, inténtalo nuevamente.";
                }
            }
        }

        // VALIDANDO INPUT EMAIL
        if(empty(trim($_POST["mail"]))) {
            $mail_error = "Ingrese su correo electrnico.";
        } else {
            //prepara un declaracion de seleccion
            $sql = "SELECT id FROM users WHERE email = ?";

            if ($stmt = mysqli_prepare($date, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_mail);

                $param_mail = trim($_POST["mail"]);

                if (mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1){
                        $mail_error = "Este correo ya existe.";
                    }else {
                        $mail = trim($_POST["mail"]);
                    }
                } else {
                    echo "Algo salió mal, inténtalo nuevamente.";
                }
            }
        }

        // VALIDANDO INPUT CONTRASEÑA
        if(empty(trim($_POST["password"]))) {
            $password_error = "Ingrese una contraseña.";
        } else if (strlen(trim($_POST["password"])) < 6) {
            $password_error = "La contraseña debe de tener al menos 6 caracteres.";
        } else {
            $password = trim($_POST["password"]);
        }

        //  COMPROBANDO LOS ERRORES DE ENTRADA ANTES DE INSERTAR LOS DATOS EN LA BASE DE DATOS
        if(empty($username_error) && empty($mail_error) && empty($password_error)) {

            $sql = "INSERT INTO users (user, email, password) VALUE (?, ?, ?)";

            if ($stmt = mysqli_prepare($date, $sql)){
                mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_mail, $param_password);

                // ESTABLECIENDO PARAMETROS
                $param_username = $username;
                $param_mail = $mail;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // ENCRIPTANDO CONTRASEÑA

                if (mysqli_stmt_execute($stmt)){
                    header("location: index.php");
                } else {
                    echo "Algo salió mal, inténtelo nuevamente.";
                }
            }
        }

        mysqli_close($date);

    }

?>