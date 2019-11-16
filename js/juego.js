var modoRelax = false
var movimientos = 0
var cronometro
var grupoTarjetas = [
    ["🦄", "🐼"],
    ["🦁", "🐵"],
    ["🐳", "🦒", "🦈", "🐇"],
    ["🦉", "🐌", "🦜", "🐍"],
    ["🦊", "🦅", "🐘", "🐸"]
]; //////////////////////Array

var nivelActual = 0
var niveles = [{
    tarjetas: grupoTarjetas[0],
    movimientosMax: 5
}, {
    tarjetas: grupoTarjetas[0].concat(grupoTarjetas[1]),
    movimientosMax: 10
}, {
    tarjetas: grupoTarjetas[0].concat(grupoTarjetas[1], grupoTarjetas[2]),
    movimientosMax: 20
}, {
    tarjetas: grupoTarjetas[0].concat(grupoTarjetas[1], grupoTarjetas[2], grupoTarjetas[3]),
    movimientosMax: 40
}, {
    tarjetas: grupoTarjetas[0].concat(grupoTarjetas[1], grupoTarjetas[2], grupoTarjetas[3], grupoTarjetas[4]),
    movimientosMax: 80
}]

function barajaTarjetas(lasTarjetas) {
    var resultado;

    // resultado = Math.floor(Math.random() * 10 + 1);
    var totalTarjetas = lasTarjetas.concat(lasTarjetas);

    resultado = totalTarjetas.sort(
        function() {
            return 0.5 - Math.random();
        }
    );

    return resultado;
}

function reparteTarjetas(lastarjetas) {

    var mesa = document.querySelector("#mesa");

    var tarjetasBarajas = barajaTarjetas(lastarjetas);

    mesa.innerHTML = "";

    tarjetasBarajas.forEach(function(elemento) {

        var tarjeta = document.createElement("div");

        tarjeta.innerHTML =
            "<div class='tarjeta' data-valor=" +
            elemento +
            ">" +
            "<div class='tarjeta__contenido'>" +
            elemento +
            "</div>" +
            "</div>";

        mesa.appendChild(tarjeta);

    });
};

function descubrir() {
    var descubiertas;
    var tarjetasPendientes;
    var totalDescubiertas = document.querySelectorAll('.descubierta:not(.acertada)');

    // console.log(this.getAttribute("class"));
    // this.setAttribute("id", "tarjetita");

    if (totalDescubiertas.length > 1) {
        return;
    };

    this.classList.add("descubierta");

    document.querySelector("#sonido-carta").cloneNode().play()

    descubiertas = document.querySelectorAll('.descubierta:not(.acertada)');

    if (descubiertas.length < 2) {
        return;
    };

    comparar(descubiertas);
    actualizaContador()

    tarjetasPendientes = document.querySelectorAll('.tarjeta:not(.acertada)')
    if (tarjetasPendientes.length === 0) {
        setTimeout(finalizar, 1000);
    }
};

function comparar(tarjetasAComparar) {
    if (tarjetasAComparar[0].dataset.valor === tarjetasAComparar[1].dataset.valor) {
        acierto(tarjetasAComparar);
    } else {
        error(tarjetasAComparar);
    };
};

function acierto(lasTarjetas) {
    lasTarjetas.forEach(function(elemento) {
        elemento.classList.add("acertada");
    });

    document.querySelector("#sonido-acierto").cloneNode().play()
};

function error(lasTarjetas) {
    setTimeout(function() {
        lasTarjetas.forEach(function(elemento) {
            elemento.classList.add("error");
        });
    }, 100);

    setTimeout(function() {
        lasTarjetas.forEach(function(elemento) {
            setTimeout(function() {
                elemento.classList.remove("descubierta");
            }, 100);

            elemento.classList.remove("error");
        });
    }, 1100);

    document.querySelector("#sonido-error").cloneNode().play()
};

function iniciarCronometro() {
    var segundos = 10
    var minutos = 0
    var segundosTexto
    var minutosTexto

    function actualizaContador() {
        segundos--

        if (segundos < 0) {
            segundos = 59
            minutos--
        }
        if (minutos < 0) {
            segundos = 0
            minutos = 0
            clearInterval(cronometro)
            timeOver()
        }

        segundosTexto = segundos
        minutosTexto = minutos

        if (segundos < 10) {
            segundosTexto = '0' + segundos
        }
        if (minutos < 10) {
            minutosTexto = '0' + minutos
        }

        document.querySelector("#minutos").innerHTML = minutosTexto
        document.querySelector("#segundos").innerHTML = segundosTexto
    }

    cronometro = setInterval(actualizaContador, 1000)
};

function actualizaContador() {
    var movimientosTexto
    movimientos++
    movimientosTexto = movimientos

    if (movimientos >= niveles[nivelActual].movimientosMax && !modoRelax) {
        gameOver()
        return
    }

    if (movimientos < 10) {
        movimientosTexto = '0' + movimientos
    }

    document.querySelector("#mov").innerHTML = movimientosTexto
}

function maxContador() {
    var movimientosMaxTexto = niveles[nivelActual].movimientosMax
    if (movimientosMaxTexto < 10) {
        movimientosMaxTexto = '0' + movimientosMaxTexto
    }
    document.querySelector("#mov-total").innerHTML = movimientosMaxTexto
}

function escribeNiveles() {
    var menuNiveles = document.querySelector(".selecciona-nivel ul")
    niveles.forEach(function(elemento, indice) {
        var controlNivel = document.createElement("li")
        controlNivel.innerHTML =
            "<button class='nivel' data-nivel=" +
            indice +
            ">Nivel " +
            (indice + 1) +
            "</button>"
        menuNiveles.appendChild(controlNivel)
    })
}

function cambiaNivel() {
    var nivel = parseInt(this.dataset.nivel)
    nivelActual = nivel
    actualizaNivel()
    iniciar()
}

function muestraMenuNiveles(evento) {
    evento.stopPropagation()
    document.querySelector(".selecciona-nivel").classList.toggle("visible")
}

function ocultaMenuNiveles() {
    document.querySelector(".selecciona-nivel").classList.remove("visible")
}

function clickFueraDeMenu(evento) {
    if (evento.target.closest(".selecciona-nivel")) {
        return
    }
    document.querySelector(".selecciona-nivel").classList.remove("visible")
}

function teclaEscCierraMenu(evento) {
    if (evento.key === "Escape") {
        ocultaMenuNiveles()
    }
}

function subeNivel() {
    nivelActual++
}

function actualizaNivel() {
    var nivelTexto = nivelActual + 1
    if (nivelActual < 10) {
        nivelTexto = '0' + nivelTexto
    }
    document.querySelector("#nivel").innerHTML = nivelTexto
}

function cargaNuevoNivel() {
    subeNivel()
    actualizaNivel()
    iniciar()
}

function finalizar() {
    clearInterval(cronometro)
    if (nivelActual < niveles.length - 1) {
        document.querySelector("#subeNivel").classList.add("visible")
    } else {
        document.querySelector("#endGame").classList.add("visible")
    }
}

function gameOver() {
    clearInterval(cronometro)
    document.querySelector("#gameOver").classList.add("visible")
}

function timeOver() {
    document.querySelector("#timeOver").classList.add("visible")
}

function iniciar() {
    movimientos = 0
    reparteTarjetas(niveles[nivelActual].tarjetas);
    document.querySelector("#mov").innerHTML = "00"
    maxContador()
    document.querySelector(".selecciona-nivel").classList.remove("visible")
    document.querySelector("#endGame").classList.remove("visible")
    document.querySelector("#timeOver").classList.remove("visible")
    document.querySelector("#gameOver").classList.remove("visible")
    document.querySelector("#subeNivel").classList.remove("visible")

    document.querySelectorAll(".tarjeta").forEach(function(elemento) {
        elemento.addEventListener("click", descubrir);
    });

    if (!modoRelax) {
        iniciarCronometro()
    } else {
        document.querySelector("#cronometro").classList.add("cronometro-oculto")
    }
}

function reiniciar() {
    nivelActual = 0
    actualizaNivel()
    iniciar()
}

function iniciaJuegoNormal() {
    modoRelax = false
    document.querySelector("#bienvenida").classList.remove("visible")
    iniciar()
    document.querySelector(".control-nivel").classList.add("control-oculto")
}

function iniciaJuegoRelax() {
    modoRelax = true
    document.querySelector("#bienvenida").classList.remove("visible")
    iniciar()
}

// Escribimos los niveles dinamicamente
escribeNiveles()

//Asignamos eventos iniciales
document.querySelectorAll(".reiniciar").forEach(function(elemento) {
    elemento.addEventListener("click", reiniciar)
})

document.querySelector("#juego-normal").addEventListener("click", iniciaJuegoNormal)

document.querySelector("#juego-relax").addEventListener("click", iniciaJuegoRelax)

document.querySelector("#control-nivel").addEventListener("click", muestraMenuNiveles)

document.querySelector("#cierra-niveles").addEventListener("click", ocultaMenuNiveles)

document.querySelectorAll(".nivel").forEach(function(elemento) {
    elemento.addEventListener("click", cambiaNivel)
})

document.querySelector("#subir").addEventListener("click", cargaNuevoNivel)

document.querySelector("body").addEventListener("click", clickFueraDeMenu)

document.addEventListener("keydown", teclaEscCierraMenu)

//Mostramos pantalla de bienvenida
document.querySelector("#bienvenida").classList.add("visible")