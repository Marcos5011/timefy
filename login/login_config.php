<?php

require '../banco/conexao.php';
session_start();

$usuario = $_POST['usuario'] ?? null;
$senha = $_POST['senha'] ?? null;

if (empty($usuario) || empty($senha)) {
    echo json_encode(['success' => false, 'message' => 'Usuário e senha são obrigatórios.']);
    exit();
}

try {
    $sql = "SELECT * FROM usuarios WHERE emailUsuario = :usuario OR cpfUsuario = :usuario";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($senha, $user['senhaUsuario'])) {
        $_SESSION['usuario'] = $user['emailUsuario'];
        $_SESSION['idUsuario'] = $user['idUsuario'];
        echo json_encode(['success' => true, 'message' => 'Login bem-sucedido.']);
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuário ou senha inválidos.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro ao conectar ao banco de dados: ' . $e->getMessage()]);
}
?>




