<?php
class Create extends Conn{
    /**
     * @var $Tabela = Variável que vai capitar a tabela a ser conectada...
     * @var $Dados = Variável que vai capitar o <b>array</b> dos Dados a ser cadastrados...
     * @var $Result = Variável que vai retornar os resultados da busca...
     */
    private $Tabela;
    private $Dados;
    private $Result;

    /** @var PDOStatement */
    private $Create;

    /** @var PDO */
    private $Conn;

    /**
     * <b>ExeCreate:</b> Executa um cadastramento simpletes no banco de dados utilizando o prepared stand
     * @param STRING $Tabela = Esta é a tabela que será consultada ou que será inserida os dados...
     * @param STRING $Dados  = Array que vai dos dados, que retornará...
     */

    public function ExeCreate ($Tabela, array $Dados){
        $this->Tabela = (string) $Tabela;
        $this->Dados  =  $Dados;
        $this->getSyntax();
        $this->Execute();
    }

    public function getResult(){
        return $this->Result;
    }

    /**
     * **************************************************
     * **************************************************
     * **************** PRIVATE METHODOS ****************
     * **************************************************
     * **************************************************
     */

    private function Connect(){
        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($this->Create);
    }

    private function getSyntax(){
        $Fileds = implode(', ', array_keys($this->Dados));
        $Places = ':' . implode(', :', array_keys($this->Dados));
        $this->Create = "INSERT INTO {$this->Tabela} ({$Fileds}) VALUES ({$Places})";
    }

    /**
     * @param Vai Executar a conexão com o banco de dados...
     */

    private function Execute(){
        $this->Connect();
        try{
            $this->Create->execute($this->Dados);
            $this->Result = $this->Conn->lastInsertId();
        }catch (PDOException $e){
            $this->Result = null;
            WSError("<b>Erro ao cadastrar: </b> {$e->getMessage()}", $e->getCode());
        }
    }
}