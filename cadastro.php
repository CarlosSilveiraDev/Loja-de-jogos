<?php
$host = "localhost";
$usuario = "root";
$senha_db = "";
$banco = "cadastro";

$conn = new mysqli($host, $usuario, $senha_db, $banco);

if ($conn->connect_error) {
    die("Erro ao conectar: " . $conn->connect_error);
}

$nome           = trim($_POST['nome']);
$email          = trim($_POST['email']);
$confirma_email = trim($_POST['confirma_email']);
$senha          = $_POST['senha'];
$confirma_senha = $_POST['confirma_senha'];

if ($email !== $confirma_email) {
    die("Erro: Os e-mails não coincidem.");
}

if ($senha !== $confirma_senha) {
    die("Erro: As senhas não coincidem.");
}

if (strlen($senha) < 6) {
    die("Erro: A senha deve ter pelo menos 6 caracteres.");
}

$check = $conn->prepare("SELECT id FROM `usuário` WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    die("Erro: Este e-mail já está cadastrado.");
}
$check->close();

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO `usuário` (nome, email, senha) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nome, $email, $senha_hash);

if ($stmt->execute()) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro ao cadastrar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>