<?php
ob_start();
require_once("Config.inc.php");

$Read = new Read();
$Read->ExeRead("xp_config");
if($Read->getResult()): $Ass = $Read->getResult()[0]; else: $Ass = null; endif;
?>
<!DOCTYPE html>
<html lang="<?= $language; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página não encontrada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
        }

        .error-code {
            font-size: 6rem;
            font-weight: bold;
            color: #e74c3c;
        }

        .error-message {
            font-size: 1.5rem;
            color: #333;
        }

        .go-home {
            margin-top: 20px;
        }

        .go-home a {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="error-code">404</div>
    <div class="error-message">Página não encontrada</div>
    <div class="go-home"><a href="<?= HOME; ?>">Voltar para a página inicial</a></div>
</div>
</body>
</html>
<?php
ob_end_flush();