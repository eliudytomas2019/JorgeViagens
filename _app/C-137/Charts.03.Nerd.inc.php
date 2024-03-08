<?php

$News = [];
$Views = [];

$Read = new Read();
$Read->ExeRead("xp_blog", "ORDER BY views DESC LIMIT 10");
if($Read->getResult()):
    foreach ($Read->getResult() as $key):
        $News[] = $key['title'];
        $Views[] = $key['views'];
    endforeach;
endif;