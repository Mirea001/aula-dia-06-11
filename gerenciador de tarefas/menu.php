<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Menu Principal - Sistema de Gerenciamento de Tarefas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #fafad2;
        }
        .menu {
            text-align: center;
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #fafad2;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        .menu a {
            display: block;
            margin: 10px 0;
            text-decoration: none;
            color: #fafad2;
            background-color: #de7700;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .menu a:hover {
            background-color: #de7700;
        }
    </style>
</head>
<body>
    <div class="menu">
        <h1>Bem-vindo ao Sistema de Tarefas</h1>
        <p>Escolha uma opção abaixo para começar:</p>
        
        <a href="cad_usuario.php">Cadastrar Usuário</a>
        <a href="cad_tarefas.php">Cadastrar Tarefa</a>
        <a href="gerenciar_tar.php">Gerenciar Tarefas</a>
    </div>
</body>
</html>
