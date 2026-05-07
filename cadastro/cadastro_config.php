<?php

require '../banco/conexao.php';

$nome = $_POST['nome'] ?? null;
$email = $_POST['email'] ?? null;
$cpf = $_POST['cpf'] ?? null;
$telefone = $_POST['telefone'] ?? null;
$data_nascimento = $_POST['data_nascimento'] ?? null;
$senha = $_POST['senha'] ?? null;
$confirmar_senha = $_POST['confirmar_senha'] ?? null;

if (empty($nome) || empty($email) || empty($cpf) || empty($telefone) || empty($data_nascimento) || empty($senha) || empty($confirmar_senha)) {
    echo json_encode(['success' => false, 'message' => 'Todos os campos são obrigatórios.']);
    exit();
}

if ($senha !== $confirmar_senha) {
    echo json_encode(['success' => false, 'message' => 'As senhas não coincidem.']);
    exit();
} 

try {
   $sqlCheck = "SELECT idUsuario FROM usuarios WHERE emailUsuario = :email LIMIT 1";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->bindParam(':email', $email);
    $stmtCheck->execute();

    if ($stmtCheck->rowCount() > 0) {
        echo json_encode(['success' => false, 'message' => 'Este e-mail já está cadastrado.']);
        exit();
    }

    $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

    $sql = "INSERT INTO usuarios (nomeUsuario, emailUsuario, cpfUsuario, telefoneUsuario, dataNascimento, senhaUsuario) VALUES (:nome, :email, :cpf, :telefone, :data_nascimento, :senha)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':data_nascimento', $data_nascimento);
    $stmt->bindParam(':senha', $senhaHash);
    

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Cadastro realizado com sucesso.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao cadastrar usuário.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro ao conectar ao banco de dados: ' . $e->getMessage()]);
}