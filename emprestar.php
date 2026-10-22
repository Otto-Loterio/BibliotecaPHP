<?php
require_once 'config.php';
$pdo = conectarDB();

$mensagemEmprestimo = "";
$mensagemDevolucao = "";

$sql = "SELECT * FROM livros ORDER BY id_livros DESC";

$stmtLivros = $pdo->query($sql);
$livros = $stmtLivros->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_livros = $_POST['id_livros'];
        $acao = $_POST['acao'];


        if ($acao == 'emprestar'){
            $sql = "SELECT * FROM livros WHERE id_livros = :id";
    
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id_livros]);
    
            $livro = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($livro['disponivel'] == 0) {
    
            $mensagemEmprestimo = "Esse livro não tá disponível pra você, palhaço.";
    
            } else {
    
            $sql = "UPDATE livros SET disponivel = 0 WHERE id_livros = :id";
    
            $stmtDisponivel = $pdo->prepare($sql);
            $stmtDisponivel->execute(['id' => $id_livros]);
            
    
            $mensagemEmprestimo = "Livro emprestado com sucesso!";
            }
        }

        if ($acao == 'devolver'){
            $sql = "SELECT * FROM livros WHERE id_livros = :id";
    
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id_livros]);
    
            $livro = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($livro['disponivel'] == 1) {
    
            $mensagemDevolucao = "Esse livro já foi devolvido";
    
            } else {
    
            $sql = "UPDATE livros SET disponivel = 1 WHERE id_livros = :id";
    
            $stmtDisponivel = $pdo->prepare($sql);
            $stmtDisponivel->execute(['id' => $id_livros]);
            
    
            $mensagemDevolucao = "Livro devolvido com sucesso!";
            }
        }

    }
    
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/emprestar.css">
    <link rel="stylesheet" href="./css/reset.css">
    <title>Emprestimo de Livros</title>
</head>
<body>
    <nav> 
        <a href="./index.php">Página Inicial</a> 
        <a href="./cadastrar.php">Cadastrar</a> 
        <a href="./emprestar.php">Emprestar</a> 
    </nav> 
    <div class="emprestimo">
    <form method="POST">
        <label for="id_livros">Escolha o livro que você quer pegar emprestado:</label>
        <select id="id_livros" name="id_livros">
        <option value="">Selecione...</option>

        <?php foreach ($livros as $livro) : ?>
            <option value="<?php echo $livro['id_livros'] ?>"><?php echo $livro['titulo']; ?>
        <?php endforeach; ?>

    </select>
    <button type="submit" name="acao" value="emprestar">Pegar livro emprestado</button>
    </form>
    <?php echo "<p> $mensagemEmprestimo </p>" ?>
    </div>
    <div class="devolucao">
        <form method="POST">
        <label for="id_livros">Escolha o livro que você quer devolver:</label>
        <select id="id_livros" name="id_livros">
        <option value="">Selecione...</option>

        <?php foreach ($livros as $livro) : ?>
            <option value="<?php echo $livro['id_livros'] ?>"><?php echo $livro['titulo']; ?>
        <?php endforeach; ?>

    </select>
    <button type="submit" name="acao" value="devolver">Devolver livro</button>
    </form>
    <?php echo "<p> $mensagemDevolucao </p>" ?>
    </div>
</body>
</html>