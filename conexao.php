<?php
// Configuração de conexão com o banco de dados usando MySQLi
$host = 'localhost';  // ou '127.0.0.1'
$dbname = 'relatorio';
$username = 'root';  // Usuário padrão do XAMPP
$password = '';      // Senha padrão do XAMPP (em branco)

// Criando a conexão
$conn = new mysqli($host, $username, $password, $dbname);

// Verificar se houve erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
