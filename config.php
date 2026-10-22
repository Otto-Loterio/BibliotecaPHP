<?php
// Configuração do banco de dados
define('DB_HOST', 'localhost');
define('DB_NAME', 'bibliotecadb_etec');
define('DB_USER', 'root');
define('DB_PASS', '');

function conectarDB() {
    try {
        $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
            DB_USER,
            DB_PASS
        );
        $pdo->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
        return $pdo;
    }
    
    catch(PDOException $e) {
        die("Erro de conexão: " . $e->getMessage());
        }
}