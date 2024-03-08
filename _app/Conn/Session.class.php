<?php
class Session {
    private $Date;
    private $Cache;
    private $Traffic;
    private $Browser;

    function __construct($Cache = null){
        session_start();
        $this->CheckSession($Cache);
    }

    //Verifica e executa todos os metodos da classe!
    private function CheckSession($Cache = null){
        $this->Date = date('Y-m-d');
        $this->Cache = ((int) $Cache ? $Cache : 5);

        if(empty($_SESSION['useronline'])):
            $this->setTraffic();
            $this->setSession();
            $this->CheckBrowser();
            $this->setUsuario();
            $this->BrowserUpdate();
        else:
            $this->setSession();
            $this->TrafficUpdate();
            $this->sessionUpdate();
            $this->CheckBrowser();
            $this->UsuarioUpdate();
        endif;

        //$this->Date = null;
    }

    // Esta função validata a sessão do usuário, verifica todos os dados do usuário
    private  function setSession(){
        $_SESSION['useronline'] = [
            "session"    => session_id(),
            "startview"  => date('Y-m-d H:i:s'),
            "endview"    => date('Y-m-d H:i:s', strtotime("+{$this->Cache}minutes")),
            'server_ip'  => filter_input(INPUT_SERVER, 'SERVER_ADDR', FILTER_DEFAULT),
            "ip"         => filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_DEFAULT),
            "url"        => filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_DEFAULT),
            "agent"      => filter_input(INPUT_SERVER, "HTTP_USER_AGENT", FILTER_DEFAULT)
        ];
    }

    /*
     * ***************************************
     * *** USUÁRIOS, VISITAS, ATUALIZAÇÕES ***
     * ***************************************
     */

    //Verifica e insere o tréfego na tabela
    private function setTraffic(){
        $this->getTraffic();
        if(!$this->Traffic):
            $ArrSiteViews = ['s_date' => $this->Date, 'users' => 1, 'views' => 1, 'pages' => 1, 'dia' => date('d'), 'mes' => date('m'), 'ano' => date('Y')];
            $crateSiteViews = new Create;
            $crateSiteViews->ExeCreate("site_views", $ArrSiteViews);
        else:
            /*if(!$this->getCookie()):
                //$ArrSiteViews = ['users' => $this->Traffic['users']+1, 'views' => $this->Traffic['views']+1, 'pages' => $this->Traffic['pages']+1];
            else:
                $ArrSiteViews = ['views' => $this->Traffic['views']+1, 'pages' => $this->Traffic['pages']+1];
            endif;

            $updateSitews = new Update;
            $updateSitews->ExeUpdate("site_views", $ArrSiteViews, "WHERE s_date = :date","date={$this->Date}");*/
        endif;
    }

    private function sessionUpdate(){
        $_SESSION['useronline']['endview'] = date('Y-m-d H:i:s', strtotime("+{$this->Cache}minutes"));
        $_SESSION['useronline']['url'] = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_DEFAULT);
    }

    private function TrafficUpdate(){
        $this->getTraffic();

        if(isset($this->Traffic['pages'])): $pg = $this->Traffic['pages']+1; else: $pg = 1; endif;
        $ArrSiteViews = ['pages' => $pg, 'dia' => date('d'), 'mes' => date('m'), 'ano' => date('Y')];
        $UpdateViews  = new Update;
        $UpdateViews->ExeUpdate("site_views", $ArrSiteViews, "WHERE s_date = :date ", "date={$this->Date}");
        
         $this->Traffic = null;
    }

    // Este methodo vai verificar o navegador do usuário...abstract
    private function CheckBrowser(){
        $this->Browser = $_SESSION['useronline']['agent'];

        if(strpos($this->Browser, 'Chrome')):
            $this->Browser = 'Chrome';
        elseif(strpos($this->Browser, 'Firefox')):
            $this->Browser = 'Firefox';
        elseif(strpos($this->Browser, 'MSIE') || strpos($this->Browser, 'Trident/')):
            $this->Browser = 'IE';
        else:
            $this->Browser = 'Outros';
        endif;
    }

    private function getTraffic(){
        $readSiteViews = new Read;
        $readSiteViews->ExeRead("site_views","WHERE s_date = :date", "date={$this->Date}");
        if($readSiteViews->getRowCount()):
            $this->Traffic = $readSiteViews->getRowCount();
        endif;
    }

    private function getCookie(){
        $Cookie = filter_input(INPUT_COOKIE, 'useronline', FILTER_DEFAULT);
        Setcookie("useronline", base64_decode("Helios"), time()+86400);

        if(!$Cookie):
            return false;
        else:
            return true;
        endif;
    }

    // Atualiza a tabela com dados do navegador!
    private function BrowserUpdate(){
        $readAgent = new Read;
        $readAgent->ExeRead("site_views_agent","WHERE name = :agent", "agent={$this->Browser}");

        if(!$readAgent->getResult()):
            $ArrAgent = ['name' => $this->Browser, 'views' => 1];
            $creanteAgent = new Create;
            $creanteAgent->ExeCreate("site_views_agent", $ArrAgent);
        else:
            $ArrAgent = ['views' => $readAgent->getResult()[0]['views'] + 1];
            $updateAgent = new Update;
            $updateAgent->ExeUpdate("site_views_agent", $ArrAgent, "WHERE name= :name", "name={$this->Browser}");
        endif;
    }

    //Cadastra usuarios Online na tabela...
    private function setUsuario(){
        $sesOnline = $_SESSION['useronline'];
        $sesOnline['name'] = $this->Browser;

        $userCreate = new Create;
        $userCreate->ExeCreate("site_views_online", $sesOnline);


        $Data = [
            "session"    => session_id(),
            "startview"  => date('Y-m-d H:i:s'),
            "endview"    => date('Y-m-d H:i:s', strtotime("+{$this->Cache}minutes")),
            'server_ip'  => filter_input(INPUT_SERVER, 'SERVER_ADDR', FILTER_DEFAULT),
            "ip"         => filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_DEFAULT),
            "url"        => filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_DEFAULT),
            "agent"      => filter_input(INPUT_SERVER, "HTTP_USER_AGENT", FILTER_DEFAULT),
            'dia'        => date('d'),
            'mes'        => date('m'),
            'ano'        => date('Y'),
            'hora'       => date('H:i:s')
        ];

        $userCreate->ExeCreate("site_views_static", $Data);
    }

    private function UsuarioUpdate(){
        $ArrOnline = [
            'endview'   => $_SESSION['useronline']['endview'],
            'url'        => $_SESSION['useronline']['url']
        ];

        $userUpdate = new Update;
        $userUpdate->ExeUpdate("site_views_online", $ArrOnline, "WHERE session= :ses", "ses={$_SESSION['useronline']['session']}");

        if(!$userUpdate->getRowCount()):
            $readSes = new Read;
            $readSes->ExeRead("site_views_online", "WHERE session= :onses", "onses={$_SESSION['useronline']['session']}");
            if(!$readSes->getRowCount()):
                $this->setUsuario();
            endif;
        endif;
    }
}