<?php
/**
 * Created by PhpStorm.
 * User: Kwanzar Soft
 * Date: 10/05/2020
 * Time: 23:27
 */

class Login{
    private $Level, $Username, $Levels, $Password, $Error, $Result, $Session, $PoE, $Cache, $Data;
    const
        entity = 'xp_users';

    /**
     * @param $Level
     */
    function __construct($Level, $Cache = null){
        $this->Level = (int) $Level;
        if(isset($_SESSION['userlogin'])):
            $this->Cache = ((int) $Cache ? $Cache : 2);
            $this->UpdateTimes();
        endif;
    }

    private function UpdateTimes(){
        $this->Data['session_end'] = date('Y-m-d H:i:s', strtotime("+{$this->Cache}minutes"));

        $Update = new Update();
        $Update->ExeUpdate(self::entity, $this->Data, "WHERE id=:i", "i={$_SESSION['userlogin']['id']}");
    }

    /**
     * @return mixed
     */
    public function getResult(){
        return $this->Result;
    }

    /**
     * @return mixed
     */
    public function getError(){
        return $this->Error;
    }

    public function getLevels(){
        return $this->Levels;
    }

    public function CheckLogin(){
        if(empty($_SESSION['userlogin']) || $_SESSION['userlogin']['level'] < $this->Level):
            unset($_SESSION['userlogin']);
            return false;
        else:
            return true;
        endif;
    }

    /**
     * @param array $DataLogin
     * @param null $Session
     */
    public function ExeLogin(array $DataLogin, $Session = null){
        $this->Username = (String) strip_tags(trim($DataLogin['user']));
        $this->Password = (String) strip_tags(trim($DataLogin['pass']));
        $this->Session  = (String) $Session;

        $this->setLogin();
    }

    public function setLogin(){
        if(empty($this->Username) || empty($this->Password)):
            $this->Error  = ["Ops: preencha todos os campos para prosseguir com o Login", WS_INFOR];
            $this->Result = false;
        elseif(!$this->getUser()):
            $this->Error  = ["Ops: username ou senha incorrecta!", WS_ALERT];
            $this->Result = false;
        elseif($this->Result['level'] < $this->Level):
            $this->Error  = ["Ops: <strong>{$this->Result['name']}</strong>, você não tem permissão para acessar essa área!", WS_ALERT];
            $this->Result = false;
        else:
            $this->Execute();
        endif;
    }

    /**
     * @return bool
     */
    private function getUser(){
        $this->Password = md5($this->Password);

        $read = new Read;
        $read->ExeRead(self::entity, "WHERE username=:user AND password=:pass ", "user={$this->Username}&pass={$this->Password}");

        if($read->getResult()):
            $this->Result = $read->getResult()[0];
            $this->Limite($read->getResult()[0]);
            return true;
        else:
            return false;
        endif;
    }

    private function Limite($l){
        $this->PoE = $l;

        if(date('i') >= 58): $n = "01"; else: $n =  date('i') + 2; endif;
        $agora  = date('Y-m-d H:i:s');
        $li     = $n;
        $limite = date('Y-m-d ').date('H:').$li.date(':s');

        $data['session_end'] = $limite;
        $data['session_start']  = $agora;

        $Update = new Update();
        $Update->ExeUpdate(self::entity, $data, "WHERE id=:i", "i={$this->PoE['id']}");

        if($Update->getResult()):
            return true;
        else:
            return false;
        endif;
    }

    private function Execute(){
        if(!session_id()):
            session_start();
        endif;

        $_SESSION['userlogin'] = $this->Result;
        $this->Error  = ["Olá, <strong>{$this->Result['name']}</strong>, seja bem-vindo(a)! Aguarde o redirecionamento.", WS_ACCEPT];
        $this->Levels = $this->Result['level'];
        $this->Result = true;
    }

    /**
     * @param $id
     * @param $password
     */
    public function LockScreen($id, $password){
        $this->Password = $password;
        $this->Session = $id;

        $Read = new Read();
        $Read->ExeRead(self::entity, "WHERE id=:i", "i={$this->Session}");


        if($Read->getResult()):
            $this->Password = md5($this->Password);
            $eL = $Read->getResult()[0];

            if($this->Password == $eL['password']):
                $this->UpdateCreen();
            else:
                $this->Error  = ["Opsss!: a senha está incorreta. Tente novamente!", WS_INFOR];
                $this->Result = false;
            endif;
        endif;
    }

    private function UpdateCreen(){
        $Data['block'] = 1;

        $Update = new Update();
        $Update->ExeUpdate(self::entity, $Data, "WHERE id=:i ", "i={$this->Session}");

        if($Update->getResult()):
            $this->Error  = ["Ecrã desbloqueado com sucesso! Aguarde o redirecionamento...", WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Error  = ["Opsss!: aconteceu um erro inesperado ao atualizar a sessão!", WS_ERROR];
            $this->Result = false;
        endif;
    }
}