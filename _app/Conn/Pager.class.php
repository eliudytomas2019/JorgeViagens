<?php
class Pager {
    /** DEFINE O PAGER */
    private $Page;
    private $Limit;
    private $Offset;

    /** REALIZA A LEITURA */
    private $Tabela;
    private $Termos;
    private $Places;

    /** DEFINE O PAGINATOR */
    private $Rows;
    private $Link;
    private $MaxLinks;
    private $First;
    private $Last;

    private $Paginator;

    function __construct($Link, $First = null, $Last = null, $MaxLinks = null) {
        $this->Link = (string) $Link;
        $this->First = ( (string) $First ? $First : '&lt;&lt;&lt;' );
        $this->Last = ( (string) $Last ? $Last : '&gt;&gt;&gt;' );
        $this->MaxLinks = ( (int) $MaxLinks ? $MaxLinks : 5);
    }


    public function ExePager($Page, $Limit) {
        $this->Page = ( (int) $Page ? $Page : 1 );
        $this->Limit = (int) $Limit;
        $this->Offset = ($this->Page * $this->Limit) - $this->Limit;
    }

    public function ReturnPage() {
        if ($this->Page > 1):
            $nPage = $this->Page - 1;
            header("Location: {$this->Link}{$nPage}");
        endif;
    }

    public function getPage() {
        return $this->Page;
    }

    public function getLimit() {
        return $this->Limit;
    }

    public function getOffset() {
        return $this->Offset;
    }

    public function ExePaginator($Tabela, $Termos = null, $ParseString = null) {
        $this->Tabela = (string) $Tabela;
        $this->Termos = (string) $Termos;
        $this->Places = (string) $ParseString;
        $this->getSyntax();
    }

    public function getPaginator() {
        return $this->Paginator;
    }

    private function getSyntax() {
        $read = new Read;
        $read->ExeRead($this->Tabela, $this->Termos, $this->Places);
        $this->Rows = $read->getRowCount();

        if ($this->Rows > $this->Limit):
            $Paginas = ceil($this->Rows / $this->Limit);
            $MaxLinks = $this->MaxLinks;

            $this->Paginator = "<ul class=\"pagination \" style='width: 500px !important; display: block!important;' >";
            $this->Paginator .= "<li class=\"page-item disabled\" style='display: inline-block !important; margin-right: 10px !important;'><a title=\"{$this->First}\" href=\"{$this->Link}1\">{$this->First}</a></li>";

            for ($iPag = $this->Page - $MaxLinks; $iPag <= $this->Page - 1; $iPag ++):
                if ($iPag >= 1):
                    $this->Paginator .= "<li class=\"page-item\" style='display: inline-block !important; margin: 0 5px !important; '><a title=\"Página {$iPag}\" href=\"{$this->Link}{$iPag}\" class=\"page-link\">{$iPag}</a></li>";
                endif;
            endfor;

            $this->Paginator .= "<li  class=\"page-item active\" style='display: inline-block !important; margin: 0 0px !important;'><span class=\"page-link\">{$this->Page}</span></li>";

            for ($dPag = $this->Page + 1; $dPag <= $this->Page + $MaxLinks; $dPag ++):
                if ($dPag <= $Paginas):
                    $this->Paginator .= "<li  class=\"page-item\" style='display: inline-block !important; margin-left: 10px!important;'><a title=\"Página {$dPag}\" href=\"{$this->Link}{$dPag}\" class=\"page-link\">{$dPag}</a></li>";
                endif;
            endfor;

            $this->Paginator .= "<li  class=\"page-item\" style='display: inline-block !important; margin-left: 10px !important;'><a title=\"{$this->Last}\" href=\"{$this->Link}{$Paginas}\">{$this->Last}</a></li>";
            $this->Paginator .= "</ul>";
        endif;
    }

}