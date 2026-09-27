<?php
    $host = "localhost"; /*variável que guarda o endereço do servidor do banco, local host é identificando que está rodando no próprio pc*/
    $usuario_bd = "root";  /*Identificar o adm do banco de dados*/
    $senha_bd = ""; /*senha padrão que utiliza para acessar o banco de dados, NADA*/
    $banco = "cadastro"; /*nome do banco criado no mysql*/
    $conexao = new mysqli($host, $usuario_bd, $senha_bd, $banco); /*ligação direta do php com o banco de dados*/

        if ($conexao->connect_error) {
            die("Erro de conexão: " . $conexao->connect_error);/*Se der erro pra conectar no banco, para tudo e mostra na tela qual foi o erro. Se não der erro, o código continua normalmente pra baixo.*/        
            }
?>
