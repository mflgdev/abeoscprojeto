<?php
// Define caminho absoluto da raiz do projeto (siteinstitucional)
define('ROOT_PATH', realpath(__DIR__ . '/../'));

// Detecta protocolo (http ou https)
$protocolo = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';

// Detecta domínio e caminho base do script atual
$dominio = $_SERVER['HTTP_HOST'];
$caminho = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

// Define BASE_URL completo (exemplo: https://localhost/siteinstitucional)
define('BASE_URL', $protocolo . '://' . $dominio . '/siteinstitucional');
$baseURL = BASE_URL;

// Ativa a pasta includes como diretório de includes válidos
set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__);

// Carrega a config do banco (fora da pasta do site)
require_once ROOT_PATH . '/assets/install/config.php';

// Configurações gerais
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'pt_BR.UTF-8', 'pt_BR', 'Portuguese_Brazil.1252', 'portuguese');
ini_set('default_charset', 'UTF-8');

// Função para detectar AJAX
if (!function_exists('is_ajax')) {
    function is_ajax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
}

// Inclui navbar e footer só se NÃO for AJAX
if (!is_ajax()) {
    include_once ROOT_PATH . '/navbar.php';

    register_shutdown_function(function () {
        include_once ROOT_PATH . '/footer.php';
    });
}
/*
// Para garantir que o BASE_URL fique disponível no frontend, insira este script no <head> de suas páginas:
// <script>window.BASE_URL = "<?= BASE_URL ?>";</script>*/
