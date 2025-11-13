// === LISTA DE DOCUMENTOS ===
const documentos = [
    "Homem Rádio", "Escalador N1", "Escalador N2", "Escalador N3",
    "CNH", "Direção Defensiva", "Transporte de Passageiros", "Transporte de Produtos Perigosos",
    "NR5", "NR6", "NR7", "NR10", "NR11", "NR12", "NR13", "NR18", "NR20", "NR23", "NR26",
    "NR33", "NR35", "Operador de Motosserra", "Equip. Pequeno Porte", "Brigadista", "ROF"
];

// === GERA CHECKBOXES ===
function gerarCheckboxes() {
    const container = document.getElementById('checkboxContainer');
    container.innerHTML = documentos.map(doc => {
        const id = slug(doc);
        return `
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="${id}" id="chk_${id}" onchange="toggleCampo('${id}', '${doc}')">
                        <label class="form-check-label" for="chk_${id}">${doc}</label>
                    </div>
                `;
    }).join('');
}

// === SLUG ===
function slug(text) {
    return text.toLowerCase().replace(/[^a-z0-9]+/g, '_').replace(/^_+|_+$/g, '');
}

// === ADICIONA/REMOVE CAMPO ===
function toggleCampo(id, nome) {
    const container = document.getElementById('documentosContainer');
    const campo = document.getElementById(`campo_${id}`);

    if (document.getElementById(`chk_${id}`).checked && !campo) {
        const div = document.createElement('div');
        div.id = `campo_${id}`;
        div.className = 'documento-item';
        div.innerHTML = `
                    <div class="row g-2">
                        <div class="col-md-6">
                            <label class="form-label">${nome} - Data</label>
                            <input type="date" class="form-control form-control-sm" name="${id}_data" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">${nome} - Upload</label>
                            <input type="file" class="form-control form-control-sm" name="${id}_upload" accept=".pdf,.jpg,.jpeg,.png" required>
                            <small class="text-muted">Máx. 5MB</small>
                        </div>
                    </div>
                `;
        container.appendChild(div);
    } else if (!document.getElementById(`chk_${id}`).checked && campo) {
        campo.remove();
    }
}

// === SALVAR ===
function salvar() {
    const form = document.getElementById('usuarioForm');
    const formData = new FormData(form);

    // Validação de arquivos
    for (let [key, file] of formData.entries()) {
        if (file instanceof File && file.size > 0) {
            if (file.size > 5 * 1024 * 1024) {
                alert(`Arquivo muito grande: ${key.replace('_upload', '')}`);
                return;
            }
        }
    }

    // Envia pro backend (exemplo)
    console.log('Enviando:');
    for (let [key, value] of formData.entries()) {
        console.log(key, value.name || value);
    }

    alert('Salvo com sucesso!');
    bootstrap.Modal.getInstance(document.getElementById('modalUsuario')).hide();
}

// === INICIA ===
document.addEventListener('DOMContentLoaded', () => {
    gerarCheckboxes();
});