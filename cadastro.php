<?php
    include "conexao.php"; /*"copia e cola" a outra pasta aqui dentro*/

    $nome = $_POST['nome']; /*post recebe oq o usuário digitou no input 'nome' e guarda nessa variável que criei*/
    $email = $_POST['email'];
    $confirma_email = $_POST['confirma_email'];
    $senha = $_POST['senha'];
    $confirma_senha = $_POST['confirma_senha'];

    if ($email !== $confirma_email) {
        die("Erro! os e-mails não coincidem.");
    }

    if ($senha !== $confirma_senha) {
        die("Erro! as senhas não coincidem.");
    }

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT); /*faz a senha chegar no banco de dados embaralhada e irreversível*/

    /*prepare() monta a query com "?" no lugar dos valores, em vez de colar a variável direto no texto.
    isso impede que alguém digite algo tipo ' OR '1'='1 num campo e altere o comando SQL (SQL Injection).*/
    $sql = "INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($sql);

    if (!$stmt) {
        die("Erro ao preparar consulta: " . $conexao->error);
    }

    $stmt->bind_param("sss", $nome, $email, $senha_hash); /*"sss" = os 3 valores são strings, e aqui sim os valores reais entram no lugar dos "?"*/
    $resultado = $stmt->execute();

    if ($resultado) {
        echo "Cadastro realizado com sucesso!"; /*se o envio da mensagem para o sql der certo*/
    } else {
        echo "Erro ao cadastrar: " . $stmt->error; /*caso o envio der erro, aparece a mensagem informando o erro que ocorreu*/
    }

    $stmt->close();
    $conexao->close();
?>
