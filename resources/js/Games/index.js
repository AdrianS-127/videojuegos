window.onload = () => {
    setTimeout(() => {
        if (document.getElementById('alerta') != null) {
            document.getElementById('alerta').remove();
        }
    }, 3000);
};

let btnEliminar = document.querySelector('#btnEliminar');
let lblNombre = document.querySelector('#lblNombre');

// Definir función que recibe id y nombre para configurar el modal
window.setInfo = (id, name) => {
    const btnEliminar = document.querySelector('#btnEliminar');
    btnEliminar.setAttribute('data-id', id); // Guardamos el id del juego en el botón
    lblNombre.innerHTML = 'Eliminaras el juego: <b>' + name + '</b>';
};

// Al hacer clic en el botón 'Continuar', eliminamos el juego
btnEliminar.addEventListener('click', function() {
    const gameId = btnEliminar.getAttribute('data-id');
    if (gameId) {
        // Enviamos el formulario de eliminación
        const form = document.getElementById(`frm_${gameId}`);
        form.submit();  // Hacer submit al formulario que elimina el juego
    }
});
