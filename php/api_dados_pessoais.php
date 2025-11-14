<?php
header("Content-Type: application/json"); // resposta em JSON
include "db.php"; // inclui a conexão

$method = $_SERVER['REQUEST_METHOD']; // pega o método HTTP (GET, POST, DELETE)

// ---------------- LISTAR ----------------
if ($method === 'GET') {
    // Consulta todos os registros
    $sql = "SELECT * FROM dados_pessoais";
    $result = $conn->query($sql);

    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row; // adiciona cada linha ao array
    }
    echo json_encode($rows); // devolve em JSON
}

// ---------------- CRIAR ----------------
if ($method === 'POST') {
    // Pega os dados enviados pelo formulário
    $matricula   = $_POST['matricula'];
    $funcionario = $_POST['funcionario'];
    $status      = $_POST['status'];
    $foto        = null;

    // Se foi enviada uma foto
    if (!empty($_FILES['foto_perfil']['name'])) {
        $diretorio = "uploads/"; // pasta onde salvar
        if (!is_dir($diretorio)) mkdir($diretorio, 0777, true);

        $nomeArquivo = uniqid() . "_" . basename($_FILES['foto_perfil']['name']);
        $caminho = $diretorio . $nomeArquivo;

        move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $caminho);
        $foto = $caminho; // guarda o caminho no banco
    }

    // Insere no banco
    $stmt = $conn->prepare("INSERT INTO dados_pessoais (matricula, funcionario, foto_perfil, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $matricula, $funcionario, $foto, $status);
    $stmt->execute();

    echo json_encode(["status" => "ok"]);
}

// ---------------- DELETAR ----------------
if ($method === 'DELETE') {
    // Pega o ID enviado
    parse_str(file_get_contents("php://input"), $dados);
    $id = $dados['id'];

    // Exclui do banco
    $stmt = $conn->prepare("DELETE FROM dados_pessoais WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo json_encode(["status" => "ok"]);
}
?>
