<?php
$title = "Serviços - {$Ass['name']}";

$Seo = new SEO($title, $Ass['content'], "", "index, follow", "{$_SERVER['REQUEST_URI']}}", "Eliúdy Tomás");
$Seo->metaTags();

$yX = explode("-", $title);
include("_app/Include/Section.inc.php");

include("_app/Include/Services.inc.php");
include("_app/Include/Facha.inc.php");
include("_app/Include/Testemunhos.inc.php");
include("_app/Include/Clientes.inc.php");
include("_app/Include/Numbers.inc.php");
?>