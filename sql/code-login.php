<?php

    //INICIALIZAR LA SESION
    session_start();

    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        header("location: juego.php");
        exit;
    }

    require_once "date.php";

    $username = $password = "";
    $username_error = $password_error = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        
        if (empty(trim($_POST["username"]))){
            $username_error = "Ingrese un usuario."; 
        } else {
            $username = trim($_POST["username"]);
        }

        if (empty(trim($_POST["password"]))){
            $password_error = "Ingrese una contraseña."; 
        } else {
            $password = trim($_POST["password"]);
        }

        //VALIDAR CREDENCIALES
        if (empty($username_error) && empty($password_error)) {
            
            $sql = "SELECT id, user, email, password FROM users WHERE user = ?";

            if($stmt = mysqli_prepare($date, $sql)){
                
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                $param_username = $username;

                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                }

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $user, $email, $hashed_password);

                    if (mysqli_stmt_fetch($stmt)) {
                        
                        if (password_verify($password, $hashed_password)) {
                            //session_start();

                            // ALMACENAR DATOS EN VARIABLES DE SESION
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $user;

                            header("location: juego.php");
                        }else {
                        $password_error = "La contraseña que has introducido es incorrecta.";
                        }
                    }
                }else {
                    $username_error = "Este usuario no existe";
                    }
            }else {
                echo "Algo salio mal, intentelo mas tarde";
                }
        }

        mysqli_close($date);
    }

?>