<?php
define('HOME', 'http://localhost/JorgeViagens/');
define("THEME","JorgeViagens/");
define("INCLUDE_PATH", HOME . 'themes' . THEME);
define("REQUIRE_PATH", 'theme'.DIRECTORY_SEPARATOR.THEME);

define('HOST', "localhost");
define('USER', "root");
define('PASS', "");
define('DBSA', "project_xp");

$supported_languages = ['en', 'pt', 'fr'];
if (isset($_GET['lang']) && in_array($_GET['lang'], $supported_languages)):
    $language = $_GET['lang'];
else:
    $language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

    if (!in_array($language, $supported_languages)):
        $language = 'pt';
    endif;
endif;

spl_autoload_register(function ($Class){
    $cDir = ['Conn', '2024'];
    $iDir = null;

    foreach($cDir as $dirName):
        if(!$iDir && file_exists(__DIR__.DIRECTORY_SEPARATOR."_app".DIRECTORY_SEPARATOR."{$dirName}".DIRECTORY_SEPARATOR."{$Class}.class.php") && !is_dir(__DIR__.DIRECTORY_SEPARATOR."{$dirName}".DIRECTORY_SEPARATOR."{$Class}.class.php")):
            include_once(__DIR__.DIRECTORY_SEPARATOR."_app".DIRECTORY_SEPARATOR."{$dirName}".DIRECTORY_SEPARATOR."{$Class}.class.php");
            $iDir = true;
        endif;
    endforeach;

    if(!$iDir):
        trigger_error("Não foi possível incluir a {$Class}.class.php", E_USER_ERROR);
    endif;
});

$Read = new Read();
$Read->ExeRead("xp_config");
if($Read->getResult()):
    foreach ($Read->getResult() as $Ass):
        define('MailHost', $Ass['email_host']);
        define('Email', $Ass['email']);
        define('SenhaEmail', $Ass['email_senha']);
        define('PortaEmail', $Ass['email_porta']);
        define('EmailName', $Ass['email_name']);
    endforeach;
endif;

spl_autoload_register(function ($Class){
    $cDir = ['Conn', 'AppData'];
    $iDir = null;

    foreach($cDir as $dirName):
        if(!$iDir && file_exists(__DIR__.DIRECTORY_SEPARATOR."_app".DIRECTORY_SEPARATOR."{$dirName}".DIRECTORY_SEPARATOR."{$Class}.class.php") && !is_dir(__DIR__.DIRECTORY_SEPARATOR."{$dirName}".DIRECTORY_SEPARATOR."{$Class}.class.php")):
            include_once(__DIR__.DIRECTORY_SEPARATOR."_app".DIRECTORY_SEPARATOR."{$dirName}".DIRECTORY_SEPARATOR."{$Class}.class.php");
            $iDir = true;
        endif;
    endforeach;

    if(!$iDir):
        trigger_error("Não foi possível incluir a {$Class}.class.php", E_USER_ERROR);
    endif;
});

define('WS_ACCEPT', 'accept');
define('WS_INFOR', 'infor');
define('WS_ALERT', 'alert');
define('WS_ERROR', 'error');

function WSError($ErrMsg, $ErrNo, $ErrDie = null){
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ACCEPT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));

    echo "<p class=\"trigger {$CssClass}\">{$ErrMsg}<span class=\"ajax_close\"></span></p>";

    if($ErrDie):
        die;
    endif;
}
function PHPError($ErrNo, $ErrMsg, $ErrFile, $ErrLine){
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ALERT : WS_ERROR));

    echo "<p class=\"trigger{$CssClass}\">";
    echo "<b> Erro na linha: # {$ErrLine} ::</b> {$ErrMsg} <br/>";
    echo "<small>{$ErrFile}</small>";
    echo "<span class=\"ajax_close\"></span></p>";

    if($ErrNo == E_USER_ERROR):
        die;
    endif;
}
set_error_handler('PHPError');