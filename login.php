<?php
    include "conexao.php";

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    /*prepare() monta a query com "?" no lugar do valor, em vez de colar a variável direto no texto.
    isso impede que alguém digite algo tipo ' OR '1'='1 no campo de email e burle o login (SQL Injection).*/
    $sql = "SELECT * FROM usuario WHERE email = ?";
    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        die("Erro ao preparar consulta: " . $conexao->error);
    }

    $stmt->bind_param("s", $email); /*"s" = o valor é uma string, e aqui o valor real entra no lugar do "?"*/
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 0) {
        die("Usuário não encontrado!");
    }

    $usuario = $resultado->fetch_assoc();

    if (password_verify($senha, $usuario['senha'])) {
        header("Location: home.html");
        exit();
    } else {
        echo "<script>alert('Senha incorreta!'); window.location.href = 'index.html';</script>";
        exit();
    }

    $stmt->close();
    $conexao->close();
?>
