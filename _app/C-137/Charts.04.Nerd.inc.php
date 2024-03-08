<?php

$NewsII = [];
$Commint = [];

$Read = new Read();
$Read->ExeRead("xp_blog", "ORDER BY commint DESC LIMIT 10");
if($Read->getResult()):
    foreach ($Read->getResult() as $key):
        $NewsII[] = $key['title'];
        $Commint[] = $key['commint'];
    endforeach;
endif;