<?php

$mes = date('m');
$ano = date('Y');
$dia = date('d');
$Views01 = [];
$PageView = [];
$dias = [];

for($i = 1; $i <= $dia; $i++):
    if($i <= 9): $mounds = "0".$i; else: $mounds = $i; endif;
    $dias[] += $mounds;

    $Read = new Read();
    $Read->FullRead("SELECT COUNT(id) as views01 FROM site_views_static WHERE dia={$mounds} AND mes={$mes} AND ano={$ano} ");
    if($Read->getResult()): $Views01[] = $Read->getResult()[0]['views01']; endif;


    $Read->FullRead("SELECT SUM(pages) as pages01  FROM site_views WHERE dia={$mounds} AND mes={$mes} AND ano={$ano} ");
    if($Read->getResult()): $PageView[] = $Read->getResult()[0]['pages01']; endif;
endfor;