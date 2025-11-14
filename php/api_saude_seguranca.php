<?php
header("Content-Type: application/json"); // Resposta em JSON
include "db.php"; // Conexão com o banco

$method = $_SERVER['REQUEST_METHOD']; // Captura o método HTTP

// ---------------- LISTAR REGISTROS ----------------
if ($method === 'GET') {
    $sql = "SELECT * FROM saude_seguranca"; // Consulta todos os registros
    $result = $conn->query($sql);

    $rows = [];
    while ($row = $result->fetch_assoc()) { // Percorre cada linha
        $rows[] = $row;
    }
    echo json_encode($rows); // Retorna os dados em JSON
}

// ---------------- CRIAR REGISTRO ----------------
if ($method === 'POST') {
    // Captura os dados enviados
    $funcionario_id = $_POST['funcionario_id'];
    $aso_data       = $_POST['aso_data'];
    $aso_arquivo    = null;

    // Verifica se foi enviado um arquivo
    if (!empty($_FILES['aso_arquivo']['name'])) {
        $diretorio = "../uploads/";
        if (!is_dir($diretorio)) mkdir($diretorio, 0777, true);

        $nomeArquivo = uniqid() . "_" . basename($_FILES['aso_arquivo']['name']);
        $caminho = $diretorio . $nomeArquivo;

        move_uploaded_file($_FILES['aso_arquivo']['tmp_name'], $caminho);
        $aso_arquivo = $caminho;
    }

    // Prepara a query de inserção
    $stmt = $conn->prepare("INSERT INTO saude_seguranca (funcionario_id, aso_data, aso_arquivo) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $funcionario_id, $aso_data, $aso_arquivo);
    $stmt->execute();

    echo json_encode(["status" => "ok"]);
}
?>
