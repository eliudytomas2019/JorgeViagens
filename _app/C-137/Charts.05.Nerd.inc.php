<?php


$NewsIII = [];
$Likes = [];

$Read = new Read();
$Read->ExeRead("xp_category", "ORDER BY views DESC LIMIT 10");
if($Read->getResult()):
    foreach ($Read->getResult() as $key):
        $NewsIII[] = $key['category'];
        $Likes[] = $key['views'];
    endforeach;
endif;