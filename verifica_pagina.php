<?php
if (!file_exists('index.php')) {
    // A index não foi encontrada, redirecionar para a página 404
    header("HTTP/1.0 404 Not Found");
    include("__404.inc.php"); // Substitua pelo caminho da sua página 404
    exit;
}
// Continuar com o restante do código se a index existir
?>
