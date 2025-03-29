window.onload = () => {
    setTimeout(() => {
        if (document.getElementById('alerta') != null) {
            document.getElementById('alerta').remove();
        }
    }, 3000);
};

let btnEliminar = document.querySelector('#btnEliminar');
let lblNombre = document.querySelector('#lblNombre');
let modal = new bootstrap.Modal(document.getElementById('modalConfirmacion')); // Inicializar el modal
let formEliminar; // Variable para almacenar el formulario de eliminación

// Configurar el modal con la información del juego
window.setInfo = (id, name) => {
    // Establecer el ID y nombre del juego
    formEliminar = document.getElementById('frm_' + id); // Obtener el formulario correspondiente
    lblNombre.innerHTML = 'Eliminarás el juego: <b>' + name + '</b>'; // Mostrar el nombre del juego
    modal.show(); // Mostrar el modal
};

// Configurar el evento de eliminación
btnEliminar.addEventListener('click', () => {
    if (formEliminar) {
        formEliminar.submit(); // Enviar el formulario
    }
});
