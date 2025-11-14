<?php
// === LISTA DE DOCUMENTOS ===
$documentos = [
    "Homem Rádio", "Escalador N1", "Escalador N2", "Escalador N3",
    "CNH", "Direção Defensiva", "Transporte de Passageiros", "Transporte de Produtos Perigosos",
    "NR5", "NR6", "NR7", "NR10", "NR11", "NR12", "NR13", "NR18", "NR20", "NR23", "NR26",
    "NR33", "NR35", "Operador de Motosserra", "Equip. Pequeno Porte", "Brigadista", "ROF"
];

// === FUNÇÃO SLUG ===
function slug($text) {
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9]+/', '_', $text);
    return trim($text, '_');
}

// === DIVIDE EM 3 COLUNAS ===
$chunks = array_chunk($documentos, ceil(count($documentos) / 3));
?>

<div class="container">
  <div class="row">
    <?php foreach ($chunks as $coluna): ?>
      <div class="col-md-4">
        <?php foreach ($coluna as $doc): 
          $id = slug($doc); ?>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="<?= $id ?>" id="chk_<?= $id ?>"
                   onclick="toggleCampo('<?= $id ?>','<?= htmlspecialchars($doc, ENT_QUOTES) ?>')">
            <label class="form-check-label" for="chk_<?= $id ?>"><?= $doc ?></label>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<div id="documentosContainer" class="mt-3"></div>

<script>
function toggleCampo(id, nome) {
  const container = document.getElementById('documentosContainer');
  const campo = document.getElementById(`campo_${id}`);
  const chk = document.getElementById(`chk_${id}`);

  if (chk && chk.checked && !campo) {
    const div = document.createElement('div');
    div.id = `campo_${id}`;
    div.className = 'documento-item mb-2';
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
  } else if (chk && !chk.checked && campo) {
    campo.remove();
  }
}
</script>
