
let modalInstance = null;

document.addEventListener('DOMContentLoaded', function () {
    modalInstance = new bootstrap.Modal(document.getElementById('modalUsuario'));
});

function modalUsuario() {
    modalInstance.show();
}
