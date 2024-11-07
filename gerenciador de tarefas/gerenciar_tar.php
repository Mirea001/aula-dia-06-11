<?php include 'conexao.php'; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Tarefas</title>
</head>
<body>
    <h1>Gerenciar Tarefas</h1>

    <!-- Lista de Tarefas -->
    <table border="1">
        <tr>
            <th>Código</th>
            <th>Setor</th>
            <th>Prioridade</th>
            <th>Descrição</th>
            <th>Status</th>
            <th>Usuário Responsável</th>
            <th>Ações</th>
        </tr>
        <?php
        // Consulta para listar tarefas com o nome do usuário responsável
        $sql = "SELECT t.tar_codigo, t.setor, t.prioridade, t.descricao, t.status, u.nome AS usuario_nome
                FROM tarefas t
                LEFT JOIN usuarios u ON t.usu_codigo = u.usu_codigo";
        $stmt = $pdo->query($sql);
        
        // Exibe as tarefas na tabela
        while ($tarefa = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>{$tarefa['tar_codigo']}</td>
                    <td>{$tarefa['setor']}</td>
                    <td>{$tarefa['prioridade']}</td>
                    <td>{$tarefa['descricao']}</td>
                    <td>{$tarefa['status']}</td>
                    <td>{$tarefa['usuario_nome']}</td>
                    <td>
                        <form action='' method='POST' style='display:inline;'>
                            <input type='hidden' name='editar_id' value='{$tarefa['tar_codigo']}'>
                            <input type='submit' name='editar' value='Editar'>
                        </form>
                        <form action='' method='POST' style='display:inline;'>
                            <input type='hidden' name='excluir_id' value='{$tarefa['tar_codigo']}'>
                            <input type='submit' name='excluir' value='Excluir' onclick='return confirm(\"Deseja excluir esta tarefa?\");'>
                        </form>
                    </td>
                  </tr>";
        }
        ?>
    </table>

    <!-- Formulário de Edição de Tarefa -->
    <?php
    if (isset($_POST['editar'])) {
        $tar_codigo = $_POST['editar_id'];
        
        // Busca os dados da tarefa para edição
        $sql = "SELECT * FROM tarefas WHERE tar_codigo = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$tar_codigo]);
        $tarefa = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <h2>Editar Tarefa</h2>
    <form action="" method="POST">
        <input type="hidden" name="tar_codigo" value="<?php echo $tarefa['tar_codigo']; ?>">
        Setor: <input type="text" name="setor" value="<?php echo $tarefa['setor']; ?>" required><br>
        Prioridade: <input type="text" name="prioridade" value="<?php echo $tarefa['prioridade']; ?>" required><br>
        Descrição: <input type="text" name="descricao" value="<?php echo $tarefa['descricao']; ?>" required><br>
        Status: <input type="text" name="status" value="<?php echo $tarefa['status']; ?>" required><br>
        
        Usuário Responsável:
        <select name="usu_codigo" required>
            <?php
            $sqlUsuarios = "SELECT usu_codigo, nome FROM usuarios";
            foreach ($pdo->query($sqlUsuarios) as $usuario) {
                $selected = $usuario['usu_codigo'] == $tarefa['usu_codigo'] ? 'selected' : '';
                echo "<option value='{$usuario['usu_codigo']}' $selected>{$usuario['nome']}</option>";
            }
            ?>
        </select><br>

        <input type="submit" name="atualizar" value="Atualizar Tarefa">
    </form>
    <?php
    }

    // Atualizar Tarefa
    if (isset($_POST['atualizar'])) {
        $tar_codigo = $_POST['tar_codigo'];
        $setor = $_POST['setor'];
        $prioridade = $_POST['prioridade'];
        $descricao = $_POST['descricao'];
        $status = $_POST['status'];
        $usu_codigo = $_POST['usu_codigo'];

        $sql = "UPDATE tarefas SET setor = ?, prioridade = ?, descricao = ?, status = ?, usu_codigo = ? WHERE tar_codigo = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$setor, $prioridade, $descricao, $status, $usu_codigo, $tar_codigo])) {
            echo "<p>Tarefa atualizada com sucesso!</p>";
            header("Refresh:0");
        } else {
            echo "<p>Erro ao atualizar tarefa.</p>";
        }
    }

    // Excluir Tarefa
    if (isset($_POST['excluir'])) {
        $tar_codigo = $_POST['excluir_id'];

        $sql = "DELETE FROM tarefas WHERE tar_codigo = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$tar_codigo])) {
            echo "<p>Tarefa excluída com sucesso!</p>";
            header("Refresh:0");
        } else {
            echo "<p>Erro ao excluir tarefa.</p>";
        }
    }
    ?>

    <p><a href="menu.php"><button>Voltar</button></a></p>
    
</body>
</html>
