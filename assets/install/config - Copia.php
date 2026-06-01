<?php

// Configurações do banco de dados
$config_host = "localhost";  // Ou veja no cPanel se for diferente
$config_user = "willth96_dbsite";
$config_pass = "u&@m,o,^)N_y";
$config_sql = "willth96_siteinstitucional";

// Tentando conectar ao banco de dados
try {
    // Conexão com o banco de dados usando PDO
    $conn = new PDO("mysql:host=$config_host;dbname=$config_sql", $config_user, $config_pass);
    
    // Definir o modo de erro para exceções
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Se a conexão for bem-sucedida
    //echo "Conexão bem-sucedida com o banco de dados '$config_sql'!";
} catch (PDOException $e) {
    // Caso ocorra algum erro na conexão
    echo "Falha ao conectar ao banco de dados: " . $e->getMessage();
}

?>
