<?php
$status = 1;

$Read = new Read();
$Read->ExeRead("xp_seo", "WHERE status=:st", "st={$status}");

if($Read->getResult()):
    $Angola = $Read->getResult()[0];

    $Seo = new SEO($page, $Angola['description'], $Angola['keywords'], "noindex, nofollow", "{$_SERVER['REQUEST_URI']}}", $Angola['author']);
    $Seo->metaTags();
endif;