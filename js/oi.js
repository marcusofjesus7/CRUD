document.addEventListener('DOMContentLoaded', function () {
    const modalUsuarioEl = document.getElementById('modalUsuario');
    const modalSaudeEl = document.getElementById('exampleModalToggle2'); // ID do Modal 2
    const btnAvancar = document.getElementById('btnAvancar');

    if (!modalUsuarioEl || !modalSaudeEl || !btnAvancar) return;

    // Inicializa as instâncias dos modais
    const modalUsuario = new bootstrap.Modal(modalUsuarioEl);
    const modalSaude = new bootstrap.Modal(modalSaudeEl);

    btnAvancar.addEventListener('click', function (e) {
        e.preventDefault();

        // 1. Define a função que abre o Modal 2
        function onHidden() {
            modalSaude.show(); // Abre o Modal 2
            // Remove o listener para evitar que abra de novo por engano
            modalUsuarioEl.removeEventListener('hidden.bs.modal', onHidden); 
        }

        // 2. Adiciona o listener: quando o Modal 1 estiver totalmente escondido...
        modalUsuarioEl.addEventListener('hidden.bs.modal', onHidden);

        // 3. Esconde o Modal 1, o que irá disparar o listener acima.
        modalUsuario.hide();
    });
});