let contador = 0;
const divContador = document.querySelector('.contador');
const textoContador = document.querySelector('.contador p');
const grilla = document.querySelector('.grilla');

// Obtener el nivel del usuario que se ha importado desde el archivo .blade
var nivelUsuario = nivel;

divContador.addEventListener('click', () => {
    if (contador < 10) {
        contador++;
        textoContador.innerText = contador;
    }
});

setInterval(() => {
    if (contador <= 10) {
        textoContador.innerText = contador;
    } else {
        contador = 0;
        textoContador.innerText = '0';

        var casillas = document.querySelectorAll('.casilla');
        var casillasLibres = Array.from(casillas).filter(casilla => !casilla.querySelector('img'));

        if (casillasLibres.length > 0) {
            nuevaConsola();
        } else {
            contador = 11;
            textoContador.innerText = 'FULL!';
        }
    }
    contador++;
}, 1000);

function obtenerIdConsola(src) {
    const mapaConsolas = {
        "/images/psp.png": 1,
        "/images/gameboy.png": 2,
        "/images/gameboyadvance.png": 3,
        "/images/play3.png": 4,
        "/images/nswitch.png": 5,
        "/images/ds.png": 6,
        "/images/wii.png": 7,
        "/images/defect.png": 8,
        // Agrega más rutas de imagen y sus IDs correspondientes
    };

    // Normaliza la URL para obtener solo la parte del path y a minúsculas
    const url = new URL(src);
    const path = url.pathname.toLowerCase();

    console.log(path);
    return mapaConsolas[path] || 0; // Devuelve 0 si no se encuentra la ruta de imagen
}

function obtenerRutaImagenConsola(id) {
    const mapaConsolas = {
        1: "/images/psp.png",
        2: "/images/gameboy.png",
        3: "/images/gameboyadvance.png",
        4: "/images/play3.png",
        5: "/images/nswitch.png",
        6: "/images/ds.png",
        7: "/images/wii.png",
        8: "/images/defect.png",
        // Agrega más IDs y sus rutas de imagen correspondientes
    };
    return mapaConsolas[id] || "/images/defect.png"; // Devuelve una imagen por defecto si no se encuentra el ID
}

function nuevaConsola() {
    var casillas = document.querySelectorAll('.casilla');
    var casillasLibres = Array.from(casillas).filter(casilla => !casilla.querySelector('img'));

    if (casillasLibres.length > 0) {
        var nuevaCasilla = casillasLibres[Math.floor(Math.random() * casillasLibres.length)];
        var imagenConsola = obtenerRutaImagenConsola(1); 

        nuevaCasilla.innerHTML = `<img src='${imagenConsola}' alt='img'>`;
        var posicion = Array.from(nuevaCasilla.parentNode.children).indexOf(nuevaCasilla) + 1;

        fetch('/agregar-consola', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ id_consola: 1, posicion: posicion })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    } else {
        console.log("No hay casillas libres disponibles.");
    }
}

function pruebas(nuevaConsola) {
    console.log(nuevaConsola);
    const casillas = grilla.children.length;

    if (nuevaConsola > nivelUsuario) {
        // Actualizar el nivel del usuario
        nivelUsuario += 1;

        fetch('/subir-nivel', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Nivel del usuario actualizado:', data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
        
        // Añadir casillas si es necesario
        if (nuevaConsola >= 4) {
            if (casillas == 4) {
                grilla.classList.add('grid-cols-3');
            } else if (casillas == 9) {
                grilla.classList.add('grid-cols-4');
            } else if (casillas == 12) {
                grilla.classList.add('grid-cols-5');
            } else if (casillas == 20) {
                grilla.classList.add('grid-cols-6');
            } else if (casillas > 25) {
                grilla.classList.add('grid-cols-7');
            }

            grilla.innerHTML += '<div class="casilla bg-transparent p-2 sm:p-4 text-center w-16 h-16 sm:w-24 sm:h-24">';
    
            fetch('/incrementar-casillas')
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

    }
}

let dragging = false;
let draggedElement = null;
let originalWidth = null;
let originalHeight = null;
let casillasCoords = [];

document.addEventListener('mousedown', (event) => {
    if (event.target.tagName === 'IMG') {
        dragging = true;
        draggedElement = event.target;
        originalWidth = draggedElement.width;
        originalHeight = draggedElement.height;
        draggedElement.style.width = originalWidth + 'px';
        draggedElement.style.height = originalHeight + 'px';
        event.preventDefault();
        obtenerCoordenadasCasillas();
    }
});

document.addEventListener('mousemove', (event) => {
    if (dragging && draggedElement) {
        draggedElement.style.position = 'absolute';
        draggedElement.style.left = event.pageX - (originalWidth / 2) + 'px';
        draggedElement.style.top = event.pageY - (originalHeight / 2) + 'px';
    }
});

function obtenerCoordenadasCasillas() {
    casillasCoords = [];
    const casillas = document.querySelectorAll('.casilla');
    casillas.forEach((casilla) => {
        const rect = casilla.getBoundingClientRect();
        const coords = {
            top: rect.top + window.scrollY,
            left: rect.left + window.scrollX,
            bottom: rect.bottom + window.scrollY,
            right: rect.right + window.scrollX
        };
        casillasCoords.push(coords);
    });
}

document.addEventListener('mouseup', (event) => {
    if (dragging) {
        const mouseX = event.pageX;
        const mouseY = event.pageY;
        const divContenedor = draggedElement.parentElement;

        let casillaSoltada = null;
        for (let i = 0; i < casillasCoords.length; i++) {
            const coords = casillasCoords[i];
            if (mouseX >= coords.left && mouseX <= coords.right && mouseY >= coords.top && mouseY <= coords.bottom) {
                casillaSoltada = i + 1;
                break;
            }
        }

        if (casillaSoltada !== null && divContenedor !== grilla.children[casillaSoltada - 1]) {
            const divDestino = grilla.children[casillaSoltada - 1];
            const imagenCasilla = divDestino.querySelector('img');

            if (imagenCasilla && draggedElement.src.toLowerCase() === imagenCasilla.src.toLowerCase()) {
                // Obtener el ID de la consola actual y la siguiente consola
                let idConsolaActual = obtenerIdConsola(imagenCasilla.src.toLowerCase());
                let idConsolaSiguiente = idConsolaActual + 1;
                console.log(idConsolaActual, idConsolaSiguiente);
                    
                let nuevaImagenSrc = obtenerRutaImagenConsola(idConsolaSiguiente);
                
                // Actualizar la casilla de destino con la nueva consola
                divDestino.innerHTML = `<img src="${nuevaImagenSrc}" alt="img">`;
                divContenedor.innerHTML = '';
                
                // Enviar la solicitud para mezclar consolas
                let posicionOrigen = Array.from(divContenedor.parentNode.children).indexOf(divContenedor) + 1;
                let posicionDestino = Array.from(divDestino.parentNode.children).indexOf(divDestino) + 1;
                fetch('/mezclar-consolas', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ 
                        id_consola_destino: idConsolaSiguiente, 
                        posicion_origen: posicionOrigen,
                        posicion_destino: posicionDestino
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
                
                pruebas(idConsolaSiguiente);
                console.log('Son la misma consola, se combinan y se actualiza a la siguiente consola.');
                
            } else if (imagenCasilla) {
                let imagenOrigen = draggedElement.src;
                let imagenDestino = imagenCasilla.src;

                // Poner la imagen de la consola arrastrada en la casilla destino
                divDestino.innerHTML = `<img src="${imagenOrigen}" alt="img">`;

                // Poner la imagen de la casilla destino en la casilla de la consola arrastrada
                divContenedor.innerHTML = `<img src="${imagenDestino}" alt="img">`;

                // Enviar la solicitud para intercambiar consolas
                let posicionOrigen = Array.from(divContenedor.parentNode.children).indexOf(divContenedor) + 1;
                let posicionDestino = Array.from(divDestino.parentNode.children).indexOf(divDestino) + 1;
                fetch('/intercambiar-consolas', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ 
                        posicion_origen: posicionOrigen,
                        posicion_destino: posicionDestino
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });

                console.log('Son distintas consolas y se intercambian.');
            } else {
                // La casilla destino está vacía, mover la consola a esta posición
                let imagenOrigen = draggedElement.src;
                divDestino.innerHTML = `<img src="${imagenOrigen}" alt="img">`;
                divContenedor.innerHTML = '';

                // Enviar la solicitud para actualizar la posición de la consola
                let posicionOrigen = Array.from(divContenedor.parentNode.children).indexOf(divContenedor) + 1;
                let posicionDestino = Array.from(divDestino.parentNode.children).indexOf(divDestino) + 1;
                fetch('/actualizar-posicion-consola', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ 
                        posicion_origen: posicionOrigen,
                        posicion_destino: posicionDestino
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });

                console.log('Consola movida a una casilla vacía.');
            }

            console.log('El ratón fue soltado en la casilla:', casillaSoltada);
        } else {
            const nuevaImagen = document.createElement('img');
            nuevaImagen.src = draggedElement.src;
            nuevaImagen.alt = 'Imagen de consola';
            draggedElement.remove();
            divContenedor.appendChild(nuevaImagen);
            console.log('El ratón fue soltado fuera de cualquier casilla o en la misma casilla.');
        }

        dragging = false;
        draggedElement = null;
    }
});
