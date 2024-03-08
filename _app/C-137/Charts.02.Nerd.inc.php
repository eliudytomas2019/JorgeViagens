<?php

$mes = date('m');
$ano = date('Y');
$dia = date('d');
$Views02 = [];
$PageView02 = [];
$Mes = [];
$Meses = ["", "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];

for($i = 1; $i <= $mes; $i++):
    if($i <= 9): $mounds = "0".$i; else: $mounds = $i; endif;
    $Mes[] = $Meses[$i];

    $Read = new Read();
    $Read->FullRead("SELECT COUNT(id) as views02 FROM site_views_static WHERE mes={$mounds} AND ano={$ano} ");
    if($Read->getResult()): $Views02[] = $Read->getResult()[0]['views02']; endif;

    $Read->FullRead("SELECT SUM(pages) as pages02  FROM site_views WHERE  mes={$mounds} AND ano={$ano} ");
    if($Read->getResult()): $PageView02[] = $Read->getResult()[0]['pages02']; endif;
endfor;