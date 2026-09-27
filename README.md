# ServerPlayer

Loja de jogos com sistema de login e cadastro de usuários, desenvolvida em HTML, CSS e PHP.

## Funcionalidades

- Cadastro de usuário com senha criptografada (hash)
- Login com verificação de credenciais no banco de dados
- Catálogo de jogos na página inicial
- Página de detalhes individual para cada jogo

## Tecnologias

- HTML5 e CSS3
- PHP (com extensão MySQLi)
- MySQL (via XAMPP)

## Estrutura do projeto

```
├── index.html          # Tela de login
├── style.css
├── login.php           # Processa o login
├── cadastro.html        # Tela de criação de conta
├── cadastro.css
├── cadastro.php         # Processa o cadastro
├── conexao.php          # Conexão com o banco de dados
├── home.html            # Catálogo de jogos
├── home.css
├── jogo-gta5.html        # Detalhes de cada jogo
├── jogo-assasinscreed.html
├── jogo-minecraft.html
├── jogo-fifa22.html
├── jogo.css
├── perfil.html           # Perfil do usuário
├── perfil.css
└── img/                  # Imagens do projeto
```

## Como rodar o projeto

### Pré-requisitos
- [XAMPP](https://www.apachefriends.org/) instalado, com Apache e MySQL

### Passo a passo

1. Clone este repositório dentro da pasta `htdocs` do XAMPP:
   ```
   C:\xampp\htdocs\
   ```

2. Abra o **XAMPP Control Panel** e inicie os módulos **Apache** e **MySQL**.

3. Crie o banco de dados no phpMyAdmin (`http://localhost/phpmyadmin`):
   ```sql
   CREATE DATABASE cadastro;

   USE cadastro;

   CREATE TABLE usuario (
       id INT AUTO_INCREMENT PRIMARY KEY,
       nome VARCHAR(100) NOT NULL,
       email VARCHAR(100) NOT NULL UNIQUE,
       senha VARCHAR(255) NOT NULL
   );
   ```

4. Acesse pelo navegador:
   ```
   http://localhost/nome-da-pasta-do-projeto/
   ```

## Configuração do banco de dados

As credenciais de acesso ao banco ficam em `conexao.php`:

| Variável | Valor padrão |
|---|---|
| Host | `localhost` |
| Usuário | `root` |
| Senha | *(vazia)* |
| Banco | `cadastro` |

## Autores

- @kaduvtt_
