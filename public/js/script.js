let contador = 0;
/* let nivelUsuario = {{ Auth::user()->nivel ?? 'null' }};
console.log(nivelUsuario); */
const divContador = document.querySelector('.contador');
const textoContador = document.querySelector('.contador p');
const grilla = document.querySelector('.grilla');

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
        var casillasLibres = [];
        for (var i = 0; i < casillas.length; i++) {
            if (casillas[i].querySelector('img') == null) {
                casillasLibres.push(casillas[i]);
            }
        }

        if (casillasLibres.length > 0) {
            nuevaConsola();
        } else {
            contador = 11;
            textoContador.innerText = 'FULL!';
        }

    }
    contador++;
}, 1000);

function nuevaConsola() {
    var casillas = document.querySelectorAll('.casilla');
    var casillasLibres = [];
    for (var i = 0; i < casillas.length; i++) {
        if (casillas[i].querySelector('img') == null) {
            casillasLibres.push(casillas[i]);
        }
    }

    if (casillasLibres.length > 0) {
        var nuevaCasilla = casillasLibres[Math.floor(Math.random() * casillasLibres.length)];
        
        // Asegúrate de pasar la URL correcta para la imagen
        var imagenConsola = "images/psp.jpg"; // Ajusta esto según tu ruta de imagen real

        nuevaCasilla.innerHTML = "<img src='" + imagenConsola + "' alt='img'>";
        var posicion = Array.from(nuevaCasilla.parentNode.children).indexOf(nuevaCasilla) + 1;
        console.log(posicion);

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


function pruebas() {
    contador = 0;
    textoContador.innerText = contador;

    grilla.innerHTML += '<div class="casilla bg-gray-200 p-4 text-center w-24 h-24"></div>';

    fetch('/incrementar-casillas')
        .then(response => response.json())
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
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

        let casillaSoltada = null;
        for (let i = 0; i < casillasCoords.length; i++) {
            const coords = casillasCoords[i];
            if (mouseX >= coords.left && mouseX <= coords.right && mouseY >= coords.top && mouseY <= coords.bottom) {
                casillaSoltada = i + 1;
                break;
            }
        }

        if (casillaSoltada !== null) {
            const imagenCasilla = grilla.children[casillaSoltada - 1].querySelector('img');
            if (imagenCasilla && draggedElement.src === imagenCasilla.src) {
                console.log('Son la misma consola');
            } else {
                console.log('Son distintas consolas');
            }
            console.log('El ratón fue soltado en la casilla:', casillaSoltada);
        } else {
            const divContenedor = draggedElement.parentElement;
            divContenedor.innerHTML = '';
            const nuevaImagen = document.createElement('img');
            nuevaImagen.src = draggedElement.src;
            nuevaImagen.alt = 'Imagen de consola';
            divContenedor.appendChild(nuevaImagen);
            console.log('El ratón fue soltado fuera de cualquier casilla.');
        }

        dragging = false;
        draggedElement = null;
    }
});
