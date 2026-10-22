<?php
require_once 'config.php';
$pdo = conectarDB();

$sql = "SELECT * FROM livros ORDER BY id_livros DESC";
$stmtLivros = $pdo->query($sql);
$livros = $stmtLivros->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/index.css">
    <title>Biblioteca Etec</title>
</head>
<body>
    <nav> 
        <a href="./index.php">Página Inicial</a> 
        <a href="./cadastrar.php">Cadastrar</a> 
        <a href="./emprestar.php">Emprestar</a> 
    </nav>
    
    <!-- Container que gerencia a barra de rolagem -->
    <div class="tabela-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Autor</th>
                    <th>Ano</th>
                    <th>Disponível</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($livros as $livro) : ?>
                    <tr>
                        <td><?php echo $livro['id_livros']; ?></td>
                        <td><?php echo $livro['titulo']; ?></td>
                        <td><?php echo $livro['autor']; ?></td>
                        <td><?php echo $livro['ano']; ?></td>
                        <!-- Adicionado classes dinâmicas para colorir o texto -->
                        <td class="<?php echo $livro['disponivel'] == 1 ? 'disponivel' : 'indisponivel'; ?>">
                            <?php echo $livro['disponivel'] == 1 ? 'Disponível' : "Indisponível"; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table> 
    </div>
</body>
</html>