<?php include 'conexao.php'; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro de Tarefa</title>
</head>
<body>
    <h1>Cadastro de Tarefa</h1>
    <form action="" method="POST", class="box">
        Setor: <input type="text", class="setor", name="setor" required><br>
        Prioridade: <input type="text", class="prioridade", name="prioridade" required><br>
        Descrição: <input type="text", class="descricao", name="descricao" required><br>
        Status: <input type="text", class="status", name="status" required><br>
        
        Usuário Responsável:
        <select name="usu_codigo" required, class="usu">
            <option value="">Selecione um usuário</option>
            <?php
            $sql = "SELECT usu_codigo, nome FROM usuarios";
            foreach ($pdo->query($sql) as $usuario) {
                echo "<option value='{$usuario['usu_codigo']}'>{$usuario['nome']}</option>";
            }
            ?>
        </select><br>

        <input type="submit" name="cadastrar" value="Cadastrar">
        <p><a href="menu.php"><button>Voltar</button></a></p>

    </form>

    <?php
    if (isset($_POST['cadastrar'])) {
        $setor = $_POST['setor'];
        $prioridade = $_POST['prioridade'];
        $descricao = $_POST['descricao'];
        $status = $_POST['status'];
        $usu_codigo = $_POST['usu_codigo'];

        $sql = "INSERT INTO tarefas (setor, prioridade, descricao, status, usu_codigo) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$setor, $prioridade, $descricao, $status, $usu_codigo])) {
            echo "<p>Tarefa cadastrada com sucesso!</p>";
        } else {
            echo "<p>Erro ao cadastrar tarefa.</p>";
        }
    }
    ?>


</body>
</html>
