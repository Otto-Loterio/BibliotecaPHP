    <?php
    require_once 'config.php';
    $pdo = conectarDB();

    $mensagemCadastro = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $ano = $_POST['ano'];

        // Prepared Statement: o jeito padrão com PDO
        $sql = "INSERT INTO livros (titulo, autor, ano)
                VALUES (:titulo, :autor, :ano)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['titulo' => $titulo, 'autor' => $autor, 'ano' => $ano]);

        $id = $pdo->lastInsertId();

        $mensagemCadastro = "Livro cadastrado! ID: $id";
    }
    ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/cadastrar.css">
    <link rel="stylesheet" href="./css/reset.css">
    <title>Cadastro de Livros</title>
</head>
<body>
    <nav> 
        <a href="./index.php">Página Inicial</a> 
        <a href="./cadastrar.php">Cadastrar</a> 
        <a href="./emprestar.php">Emprestar</a> 
    </nav>
    <!-- Formulário HTML -->
    <h2>Cadastro de livros</h2>
    <form method="POST">
        <input type="text" name="titulo" placeholder="Titulo">
        <input type="text" name="autor" placeholder="Autor">
        <input type="number" name="ano" placeholder="Ano de publicação">
        <button type="submit">Cadastrar livro</button>
        <?php $mensagemCadastro ?>
    </form>
</body>
</html>