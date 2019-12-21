function recogeDatos(evento) {
    evento.preventDefault();

    var user = document.querySelector("#user").value;
    var pass = document.querySelector("#pass").value;
    var clave = 1997;

    var bienvenida = document.querySelector("#bienvenida p");
    var mensajePass;

    var mensaje;

    if (pass == clave) {
        mensajePass = "es correcta.";
    } else if (pass <= 1996 || pass >= 1998) {
        mensajePass = "es incorrecta, lo sentimos.";
    } else {
        mensajePass = "esta erronea, tiene que agregar un maximo de cuatro números.";
    }

    mensaje =
        "Hola " +
        user +
        ', tu contraseña "' +
        pass +
        '" ' +
        mensajePass;

    bienvenida.innerHTML = mensaje;
}

var miForm = document.querySelector("#form-user");

miForm.addEventListener("submit", recogeDatos);