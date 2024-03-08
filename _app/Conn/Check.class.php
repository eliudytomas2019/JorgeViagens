<?php
class Check{
    private static $Data;
    private static $Format;

    private $Result, $Error;

    public function getResult(){return $this->Result;}
    public function getError(){return $this->Error;}

    public static function CheckNamePro($name){
        //header('Content-Type: text/html; charset=utf-8');
        //$CleanPro = preg_replace('/[^a-zA-Z0-9áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙãõÃÕâêîôûÂÊÎÔÛçÇ ]/', '', $name);
        self::$Format = array();

        self::$Format['a'] = '"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        self::$Format['b'] = '                                 ';

        self::$Data = strtr($name, self::$Format['a'], self::$Format['b']);
        return self::$Data;
    }

    public static function Email($Email){
        self::$Data = (string) $Email;
        self::$Format = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';

        if(preg_match(self::$Format, self::$Data)):
            return true;
        else:
            return false;
        endif;
    }

    public static function Name($Name){
        self::$Format = array();

        self::$Format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        self::$Format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

        self::$Data = strtr($Name, self::$Format['a'], self::$Format['b']);
        self::$Data = strip_tags(trim(self::$Data));
        self::$Data = str_replace(' ', '-', self::$Data);
        self::$Data = str_replace(array('-----','----','---','--'), '-', self::$Data);
        return strtolower(utf8_encode(self::$Data));
    }

    public function Hash($Name){
        $Format = array();

        $Format['a'] = '"!@$%&*()_-+{[}]/?;:.,\\\'<>°ºª';
        $Format['b'] = 'AbCdRjWyXz910OnPmW3c2Jq2RcW23Mz2Gh';

        $Data = strtr($Name, $Format['a'], $Format['b']);
        $Data = strip_tags(trim($Data));

        $this->Error = $Data;
        $this->Result = true;
    }

    public static function Data($Data){
        self::$Format = explode(' ', $Data);
        self::$Data   = explode('/', self::$Format[0]);

        if(empty(self::$Format[1])):
            self::$Format[1] = date('H:i:s');
        endif;

        self::$Data = self::$Data[2]. '-'.self::$Data[1].'-'.self::$Data[0].' '.self::$Format[1];
        return self::$Data;
    }

    public static function Words($String, $Limite, $Pointer = null){
        self::$Data = strip_tags(trim($String));
        self::$Format = (int) $Limite;

        $ArrWords = explode(' ', self::$Data);
        $NumWords = count($ArrWords);
        $NewWords = implode(' ', array_slice($ArrWords, 0, self::$Format));

        $Pointer = (empty($Pointer) ? '...' : ' '.$Pointer);
        $Result = (self::$Format < $NumWords ? $NewWords.$Pointer : $String);
        return $Result;
    }

    public static function CatByName($CategoryName){
        $read = new Read;
        $read->ExeRead("public", "WHERE name = :name", "name={$CategoryName}");

        if($read->getRowCount()):
            return $read->getRowCount()[0]['id'];
        else:
            WSError("A Categoria {$CategoryName} não foi encontrada!", WS_ERROR);
            die;
        endif;
    }

    public static function UserOnline(){
        $now = date('Y-m-d H:i:s');
        $deleteUserOnline = new Delete;
        $deleteUserOnline->ExeDelete("site_views_online", "WHERE endview < :now", "now={$now}");

        $readUserOnline = new Read;
        $readUserOnline->ExeRead('site_views_online');
        return $readUserOnline->getRowCount();
    }

    public static function Image($ImageUrl, $ImageDesc, $ImageW = null, $ImageH = null){
        self::$Data = 'uplodas'.$ImageUrl;

        if(file_exists(self::$Data) && !is_dir(self::$Data)):
            $patch = HOME;
            $imagem = self::$Data;
            return $patch.$imagem;
            return "<img src=\"{$patch}/tim.php?src={$patch}/{$imagem}&w={$ImageH}\" alt=\"{$ImageDesc}\" title=\"{$ImageDesc}\">";
        else:
            return false;
        endif;
    }
}