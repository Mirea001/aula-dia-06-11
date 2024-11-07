<?php include 'conexao.php'; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
</head>
<body>
    <h1>Cadastro de Usuário</h1>
    <form action="" method="POST">
        Nome: <input type="text" name="nome" required><br>
        Email: <input type="email" name="email" required><br>
        <input type="submit" name="cadastrar" value="Cadastrar">
    </form>

    <?php
    if (isset($_POST['cadastrar'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        $sql = "INSERT INTO usuarios (nome, email) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$nome, $email])) {
            echo "<p>Usuário cadastrado com sucesso!</p>";
        } else {
            echo "<p>Erro ao cadastrar usuário.</p>";
        }
    }
    ?>
    
    <p><a href="menu.php"><button>Voltar</button></a></p>

</body>
</html>
