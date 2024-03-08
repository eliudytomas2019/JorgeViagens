<?php
class ProjectXP{
    public function StatusNews($postId){
        $this->postId = (int) $postId;
        $this->Data['status'] = 1;

        $Update = new Update();
        $Update->ExeUpdate(self::blog, $this->Data, "WHERE id=:i ", "i={$this->postId}");

        if($Update->getResult()):
            $this->Error = ["A publicação foi atualizada com sucesso!", WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Error = ["Aconteceu um erro inesperado ao atualizar a publicação!", WS_ERROR];
            $this->Result = false;
        endif;
    }

    public function UpdateBlog($ClienteData, $logotype, $postId){
        unset($ClienteData['SendPostFormL']);
        unset($this->Data);
        $this->logotype = $logotype;
        $this->ID = $postId;

        $this->Data['content'] = ($ClienteData['content']);
        $this->Data['title'] = strip_tags(trim($ClienteData['title']));
        $this->Data['id_category'] = strip_tags(trim($ClienteData['id_category']));
        $this->Data['id_author'] = strip_tags(trim($ClienteData['id_author']));
        $this->Data['data'] = strip_tags(trim($ClienteData['data']));
        $this->Data['hora'] = strip_tags(trim($ClienteData['hora']));

        $this->Data['credito_imagem'] = strip_tags(trim($ClienteData['credito_imagem']));
        if(empty($this->Data['credito_imagem'])): $this->Data['credito_imagem'] = "Insira a fonte"; endif;

        if(empty($this->Data['title']) || empty($this->Data['id_category']) || empty($this->Data['content'])):
            $this->Error = ["Preencha todos os campos para prosseguir!", WS_INFOR];
            $this->Result = false;
        else:
            $this->TempoDeLeitura();
            $this->SendLogoty();
            if($this->Result):
                $this->Data['cover'] = $this->logotype['logotype'];
            endif;

            $this->Data['title_link'] = strip_tags(trim($ClienteData['title_link']));
            $this->Data['link'] = strip_tags(trim($ClienteData['link']));

            $date = explode("-", $this->Data['data']);
            if($date[0] < date('Y') || $date[0] == date('Y') && $date[1] < date('m') && $date[2] < date('d')):
                $this->Error = ["Não é permitido agendar publicação para uma data passada!", WS_ERROR];
                $this->Result = false;
            elseif($this->Data['data'] != date('Y-m-d')):
                $this->Data['status'] = 0;
                $this->Data['dia'] = $date[2];
                $this->Data['mes'] = $date[1];
                $this->Data['ano'] = $date[0];
            else:
                $this->Data['status'] = 1;
                $this->Data['dia'] = date('d');
                $this->Data['mes'] = date('m');
                $this->Data['ano'] = date('Y');
            endif;

            $this->UpdateNews();
        endif;
    }

    private function UpdateNews(){
        $Update = new Update();
        $Update->ExeUpdate(self::blog, $this->Data, "WHERE id=:i AND lang=:lg ", "i={$this->ID}&lg={$this->lang}");

        if($Update->getResult()):
            $this->Error = ["O formulário foi atualizado com sucesso!", WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Result = false;
            $this->Error = ["Aconteceu um erro inesperado ao atualizar o formulário!", WS_ERROR];
        endif;
    }

    public function CreateBlog($ClienteData, $logotype){
        unset($ClienteData['SendPostFormL']);
        unset($this->Data);
        $this->logotype = $logotype;

        $this->Data['content'] = ($ClienteData['content']);
        $this->Data['title'] = strip_tags(trim($ClienteData['title']));
        $this->Data['id_category'] = strip_tags(trim($ClienteData['id_category']));
        $this->Data['id_author'] = strip_tags(trim($ClienteData['id_author']));
        $this->Data['data'] = strip_tags(trim($ClienteData['data']));
        $this->Data['hora'] = strip_tags(trim($ClienteData['hora']));

        $this->Data['credito_imagem'] = strip_tags(trim($ClienteData['credito_imagem']));
        if(empty($this->Data['credito_imagem'])): $this->Data['credito_imagem'] = "Insira a fonte"; endif;

        if(empty($this->Data['title']) || empty($this->Data['id_category']) || empty($this->Data['content'])):
            $this->Error = ["Preencha todos os campos para prosseguir!", WS_INFOR];
            $this->Result = false;
        else:
            $this->TempoDeLeitura();
            $this->SendLogoty();
            if($this->Result):
                $this->Data['cover'] = $this->logotype['logotype'];
            endif;

            $this->Data['title_link'] = strip_tags(trim($ClienteData['title_link']));
            $this->Data['link'] = strip_tags(trim($ClienteData['link']));

            $date = explode("-", $this->Data['data']);
            if($date[0] < date('Y') || $date[0] == date('Y') && $date[1] < date('m') && $date[2] < date('d')):
                $this->Error = ["Não é permitido agendar publicação para uma data passada!", WS_ERROR];
                $this->Result = false;
            elseif($this->Data['data'] != date('Y-m-d')):
                $this->Data['status'] = 0;
                $this->Data['dia'] = $date[2];
                $this->Data['mes'] = $date[1];
                $this->Data['ano'] = $date[0];
            else:
                $this->Data['status'] = 1;
                $this->Data['dia'] = date('d');
                $this->Data['mes'] = date('m');
                $this->Data['ano'] = date('Y');
            endif;

            $Read = new Read();
            $Read->ExeRead(self::category, "WHERE id=:i ", "i={$this->Data['id_category']}");

            if(!$Read->getResult()):
                $this->Error = ["Não encontramos a categoria selecionada!", WS_ALERT];
                $this->Result = false;
            else:
                $this->Category['posts'] = $Read->getResult()[0]['posts'] + 1;
            endif;

            $Read->ExeRead(self::author, "WHERE id=:i ", "i={$this->Data['id_author']}");

            if(!$Read->getResult()):
                $this->Result = false;
                $this->Error = ["Não encontramos o autor selecionado!", WS_ALERT];
            else:
                $this->Author['posts'] = $Read->getResult()[0]['posts'] + 1;
            endif;

            $Read->ExeRead(self::blog, "ORDER BY id DESC LIMIT 1");
            if($Read->getResult()):
                $id_key = $Read->getResult()[0]['id'] + 1;
                $this->Data['key_word'] = md5($id_key);
            else:
                $this->Data['key_word'] = md5(1);
            endif;

            $this->CreateNews();
            if($this->Result):
                $Update = new Update();
                $Update->ExeUpdate(self::category, $this->Category, "WHERE id=:i ", "i={$this->Data['id_category']}");

                if(!$Update->getResult()):
                    $this->Result = false;
                    $this->Error = ["Aconteceu um erro inesperado ao atualizar a categoria!", WS_ALERT];
                endif;

                $Update->ExeUpdate(self::author, $this->Author, "WHERE id=:i ", "i={$this->Data['id_author']}");

                if(!$Update->getResult()):
                    $this->Error = ["Aconteceu um erro inesperado ao atualizar o autor!", WS_ALERT];
                    $this->Result = false;
                endif;
            endif;
        endif;
    }

    private function CreateNews(){
        $Create = new Create();
        $Create->ExeCreate(self::blog, $this->Data);

        if($Create->getResult()):
            $this->Error = ["A publicação foi salva com sucesso!", WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Result = false;
            $this->Error = ["Aconteceu um erro ao salvar a publicações!", $this->Error];
        endif;
    }

    public function CategoryUpdate($ClienteData, $logotype, $postId){
        $this->Data['category'] = strip_tags(trim($ClienteData['category']));
        $this->Data['content'] = ($ClienteData['content']);
        $this->logotype = $logotype;
        $this->ID = $postId;

        if(empty($this->Data['category']) || !isset($this->Data['category'])):
            $this->Error = ["Preencha o campo categoria para prosseguir!", WS_ALERT];
            $this->Result = false;
        else:
            $this->SendLogoty();
            if($this->Result):
                $this->Data['cover'] = $this->logotype['logotype'];
            endif;

            $this->Data['lang'] = $this->lang;
            $this->Data['data'] = date('d-m-Y');
            $this->Data['hora'] = date('H:i:s');

            $this->UpdateCategory();
        endif;
    }

    private function UpdateCategory(){
        $Update = new Update();
        $Update->ExeUpdate(self::category, $this->Data, "WHERE id=:i AND lang=:lg ", "i={$this->ID}&lg={$this->lang}");

        if($Update->getResult()):
            $this->Error = ["O formulário foi atualizado com sucesso!", WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Result = false;
            $this->Error = ["Aconteceu um erro inesperado ao atualizar o formulário!", WS_ERROR];
        endif;
    }

    public function Category($ClienteData, $cover){
        $this->Data['category'] = strip_tags(trim($ClienteData['category']));
        $this->Data['content'] = ($ClienteData['content']);
        $this->logotype = $cover;

        if(empty($this->Data['category']) || !isset($this->Data['category'])):
            $this->Error = ["Preencha o campo categoria para prosseguir!", WS_ALERT];
            $this->Result = false;
        else:
            $Read = new Read();
            $Read->ExeRead(self::category, "WHERE category=:i ", "i={$this->Data['category']}");

            if($Read->getResult()):
                $this->Error = ["A categoria <strong>{$this->Data['category']}</strong> já encontra-se registrada!", WS_INFOR];
                $this->Result = false;
            else:
                $this->SendLogoty();
                if($this->Result):
                    $this->Data['cover'] = $this->logotype['logotype'];
                endif;

                $this->Data['lang'] = $this->lang;
                $this->Data['data'] = date('d-m-Y');
                $this->Data['hora'] = date('H:i:s');
                $this->Data['status'] = 1;

                $this->CreateCategory();
            endif;
        endif;
    }

    private function CreateCategory(){
        $Create = new Create();
        $Create->ExeCreate(self::category, $this->Data);

        if($Create->getResult()):
            $this->Error = ["A Categoria foi criada com sucesso!", WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Result = false;
            $this->Error = ["Aconteceu um erro inesperado ao salvar a categoria!", WS_ERROR];
        endif;
    }

    public function UpdateFaqs($ClienteData, $postId){
        $this->ID = $postId;
        unset($ClienteData['SendPostFormL']);

        $this->Data['title'] = strip_tags(trim($ClienteData['title']));
        $this->Data['content'] = ($ClienteData['content']);

        if(in_array("", $this->Data)):
            $this->Error = ["Preencha todos os campos para continuar com o processo!", WS_INFOR];
            $this->Result = false;
        else:
            $this->Data['lang'] = $this->lang;

            $this->FaqsUpdate();
        endif;
    }

    private function FaqsUpdate(){
        $Update = new Update();
        $Update->ExeUpdate(self::faqs, $this->Data, "WHERE id=:i AND lang=:lg ", "i={$this->ID}&lg={$this->lang}");

        if($Update->getResult()):
            $this->Error = ["O formulário foi atualizado com sucesso!", WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Result = false;
            $this->Error = ["Aconteceu um erro inesperado ao atualizar o formulário!", WS_ERROR];
        endif;
    }

    public function Faqs($ClienteData){
        unset($ClienteData['SendPostFormL']);

        $this->Data['title'] = strip_tags(trim($ClienteData['title']));
        $this->Data['content'] = ($ClienteData['content']);

        if(in_array("", $this->Data)):
            $this->Error = ["Preencha todos os campos para continuar com o processo!", WS_INFOR];
            $this->Result = false;
        else:
            $this->Data['lang'] = $this->lang;
            $this->Data['status'] = 1;
            $this->Data['hora'] = date('H:i:s');
            $this->Data['data'] = date('d-m-Y');

            $this->CreateFaqs();
        endif;
    }

    private function CreateFaqs(){
        $Create = new Create();
        $Create->ExeCreate(self::faqs, $this->Data);

        if($Create->getResult()):
            $this->Error = ["Operação realizada com sucesso!", WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Error = ["Aconteceu um erro inesperado ao salvar a operação, atualize a página e tente novamente!", WS_ERROR];
            $this->Result = false;
        endif;
    }

    public function UpdateNumber($ClienteData, $postId){
        $this->ID = $postId;
        unset($ClienteData['SendPostFormL']);

        $this->Data['number_1'] = strip_tags(trim($ClienteData['number_1']));
        $this->Data['number_2'] = strip_tags(trim($ClienteData['number_2']));
        $this->Data['number_3'] = strip_tags(trim($ClienteData['number_3']));
        $this->Data['number_4'] = strip_tags(trim($ClienteData['number_4']));

        if(in_array("", $this->Data)):
            $this->Error = ["Preencha todos os campos para continuar com o processo!", WS_INFOR];
            $this->Result = false;
        else:
            $this->Data['lang'] = $this->lang;

            $this->NumberUpdate();
        endif;
    }

    private function NumberUpdate(){
        $Update = new Update();
        $Update->ExeUpdate(self::numbers, $this->Data, "WHERE id=:i AND lang=:lg ", "i={$this->ID}&lg={$this->lang}");

        if($Update->getResult()):
            $this->Error = ["O formulário foi atualizado com sucesso!", WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Result = false;
            $this->Error = ["Aconteceu um erro inesperado ao atualizar o formulário!", WS_ERROR];
        endif;
    }

    public function Numbers($ClienteData){
        unset($ClienteData['SendPostFormL']);

        $this->Data['number_1'] = strip_tags(trim($ClienteData['number_1']));
        $this->Data['number_2'] = strip_tags(trim($ClienteData['number_2']));
        $this->Data['number_3'] = strip_tags(trim($ClienteData['number_3']));
        $this->Data['number_4'] = strip_tags(trim($ClienteData['number_4']));

        if(in_array("", $this->Data)):
            $this->Error = ["Preencha todos os campos para continuar com o processo!", WS_INFOR];
            $this->Result = false;
        else:
            $this->Data['lang'] = $this->lang;
            $this->Data['status'] = 1;

            $this->CreateNumbers();
        endif;
    }

    private function CreateNumbers(){
        $Create = new Create();
        $Create->ExeCreate(self::numbers, $this->Data);

        if($Create->getResult()):
            $this->Error = ["Operação realizada com sucesso!", WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Error = ["Aconteceu um erro inesperado ao salvar a operação, atualize a página e tente novamente!", WS_ERROR];
            $this->Result = false;
        endif;
    }

    public function AuthorUpdate($ClienteData, $file_one, $postId){
        unset($ClienteData['SendPostFormL']);
        $this->logotype = $file_one;
        $this->ID = $postId;

        $this->Data['name'] = strip_tags(trim($ClienteData['name']));
        $this->Data['function_1'] = strip_tags(trim($ClienteData['function_1']));
        $this->Data['extra'] = strip_tags(trim($ClienteData['extra']));
        $this->Data['type'] = strip_tags(trim($ClienteData['type']));
        $this->Data['content'] = ($ClienteData['content']);

        $this->Data['facebook'] = strip_tags(trim($ClienteData['facebook']));
        $this->Data['twitter'] = strip_tags(trim($ClienteData['twitter']));
        $this->Data['linkedin'] = strip_tags(trim($ClienteData['linkedin']));
        $this->Data['instagram'] = strip_tags(trim($ClienteData['instagram']));

        if(empty($this->Data['name'])):
            $this->Error = ["Preencha o campo Nome para continuar com o processo!", WS_INFOR];
            $this->Result = false;
        else:
            $this->SendLogoty();
            if($this->Result):
                $this->Data['cover'] = $this->logotype['logotype'];
            endif;

            $this->Data['lang'] = $this->lang;

            $this->UpdateAuthor();
        endif;
    }

    private function UpdateAuthor(){
        $Update = new Update();
        $Update->ExeUpdate(self::author, $this->Data, "WHERE id=:i AND lang=:lg ", "i={$this->ID}&lg={$this->lang}");

        if($Update->getResult()):
            $this->Error = ["O formulário foi atualizado com sucesso!", WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Result = false;
            $this->Error = ["Aconteceu um erro inesperado ao atualizar o formulário!", WS_ERROR];
        endif;
    }

    public function Author($ClienteData, $file_one){
        unset($ClienteData['SendPostFormL']);
        $this->logotype = $file_one;

        $this->Data['name'] = strip_tags(trim($ClienteData['name']));
        $this->Data['function_1'] = strip_tags(trim($ClienteData['function_1']));
        $this->Data['extra'] = strip_tags(trim($ClienteData['extra']));
        $this->Data['type'] = strip_tags(trim($ClienteData['type']));
        $this->Data['content'] = ($ClienteData['content']);

        $this->Data['facebook'] = strip_tags(trim($ClienteData['facebook']));
        $this->Data['twitter'] = strip_tags(trim($ClienteData['twitter']));
        $this->Data['linkedin'] = strip_tags(trim($ClienteData['linkedin']));
        $this->Data['instagram'] = strip_tags(trim($ClienteData['instagram']));

        if(empty($this->Data['name'])):
            $this->Error = ["Preencha o campo Nome para continuar com o processo!", WS_INFOR];
            $this->Result = false;
        else:
            $this->SendLogoty();
            if($this->Result):
                $this->Data['cover'] = $this->logotype['logotype'];
            endif;

            $this->Data['lang'] = $this->lang;
            $this->Data['hora'] = date('H:i:s');
            $this->Data['data'] = date('d-m-Y');
            $this->Data['status'] = 1;

            $this->CreateAuthor();
        endif;
    }

    private function CreateAuthor(){
        $Create = new Create();
        $Create->ExeCreate(self::author, $this->Data);

        if($Create->getResult()):
            $this->Error = ["Operação realizada com sucesso!", WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Error = ["Aconteceu um erro inesperado ao salvar a operação, atualize a página e tente novamente!", WS_ERROR];
            $this->Result = false;
        endif;
    }

    public function LegAndRep($ClienteData, $file){
        unset($ClienteData['SendPostFormL']);
        $this->file = $file;

        $this->Data['title'] = strip_tags(trim($ClienteData['title']));
        $this->Data['type'] = strip_tags(trim($ClienteData['type']));
        $this->Data['content'] = ($ClienteData['content']);

        if(empty($this->Data['title']) || !isset($this->Data['title'])):
            $this->Error = ["Preencha o campo titulo para finalizar o processo!", WS_ALERT];
            $this->Result = false;
        else:
            $this->SendFile();
            if($this->Result):
                $this->Data['file'] = $this->file['file'];
            endif;

            $this->Data['lang'] = $this->lang;
            $this->Data['data'] = date('d-m-Y');
            $this->Data['hora'] = date('H:i:s');
            $this->Data['status'] = 1;

            $this->CreateLegAndRap();
        endif;
    }

    private function CreateLegAndRap(){
        $Create = new Create();
        $Create->ExeCreate(self::reports, $this->Data);

        if($Create->getResult()):
            $this->Error = ["<strong>{$this->Data['type']}</strong>, foi criado com sucesso!", WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Result = false;
            $this->Error = ["Aconteceu um erro ao criar o registro de: <strong>{$this->Data['type']}</strong>"];
        endif;
    }

    public function UpdateAllInOne($ClienteData, $file_one, $postId, $language = null){
        unset($ClienteData['SendPostFormL']);
        $this->logotype = $file_one;
        $this->lang = strip_tags(trim($language));
        $this->ID = strip_tags(trim($postId));

        $this->Data['title'] = strip_tags(trim($ClienteData['title']));
        $this->Data['subtitle'] = strip_tags(trim($ClienteData['subtitle']));
        $this->Data['type'] = strip_tags(trim($ClienteData['type']));
        $this->Data['content'] = ($ClienteData['content']);

        if(empty($this->Data['title'])):
            $this->Error = ["Preencha o campo titulo para continuar com o processo!", WS_INFOR];
            $this->Result = false;
        else:
            $this->SendLogoty();
            if($this->Result):
                $this->Data['cover'] = $this->logotype['logotype'];
            endif;

            $this->Data['lang'] = $this->lang;

            $this->AllInOneUpdate();
        endif;
    }

    private function AllInOneUpdate(){
        $Update = new Update();
        $Update->ExeUpdate(self::create, $this->Data, "WHERE id=:i AND lang=:lg ", "i={$this->ID}&lg={$this->lang}");

        if($Update->getResult()):
            $this->Error = ["O formulário foi atualizado com sucesso!", WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Result = false;
            $this->Error = ["Aconteceu um erro inesperado ao atualizar o formulário!", WS_ERROR];
        endif;
    }

    public  function CreateAllInOne($ClienteData, $file_one, $language = null){
        unset($ClienteData['SendPostFormL']);
        $this->logotype = $file_one;
        $this->lang = strip_tags(trim($language));

        $this->Data['title'] = strip_tags(trim($ClienteData['title']));
        $this->Data['subtitle'] = strip_tags(trim($ClienteData['subtitle']));
        $this->Data['type'] = strip_tags(trim($ClienteData['type']));
        $this->Data['content'] = ($ClienteData['content']);

        if(empty($this->Data['title'])):
            $this->Error = ["Preencha o campo titulo para continuar com o processo!", WS_INFOR];
            $this->Result = false;
        else:
            $this->SendLogoty();
            if($this->Result):
                $this->Data['cover'] = $this->logotype['logotype'];
            endif;

            $this->Data['lang'] = $this->lang;
            $this->Data['hora'] = date('H:i:s');
            $this->Data['data'] = date('d-m-Y');
            $this->Data['status'] = 1;

            $this->AllInOne();
        endif;
    }

    private function AllInOne(){
        $Create = new Create();
        $Create->ExeCreate(self::create, $this->Data);

        if($Create->getResult()):
            $this->Error = ["<strong>{$this->Data['type']}</strong>, foi criado com sucesso!", WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Error = ["Aconteceu um erro inesperado ao criar o <strong>{$this->Data['type']}</strong>!", WS_ALERT];
            $this->Result = false;
        endif;
    }

    public function CreateUsers($ClienteData, $language = null){
        unset($ClienteData['SendPostFormL']);

        $this->Data['name'] = strip_tags(trim($ClienteData['name']));
        $this->Data['lastname'] = strip_tags(trim($ClienteData['lastname']));
        $this->Data['username'] = strip_tags(trim($ClienteData['username']));
        $this->Data['password'] = strip_tags(trim($ClienteData['password']));
        $this->Data['level'] = strip_tags(trim($ClienteData['level']));

        if(in_array("", $this->Data)):
            $this->Error = ["Preencha todos os campos para continuar com o processo!", WS_ALERT];
            $this->Result = false;
        elseif(!Check::Email($this->Data['username'])):
            $this->Error = ["Introduza um endereço de Email válido!", WS_INFOR];
            $this->Result = false;
        else:
            $this->CheckPassword($this->Data['password']);
            if($this->Result):
                $Read = new Read();
                $Read->ExeRead(self::users, "WHERE username=:i", "i={$this->Data['username']}");

                if($Read->getResult()):
                    $this->Error = ["Já encontramos um usuário com esse endereço de email: <strong>{$this->Data['username']}</strong>.", WS_ALERT];
                    $this->Result = false;
                else:
                    $this->Data['password'] = md5($this->Data['password']);
                    $this->Data['status'] = 1;

                    $this->UsersCreate();
                endif;
            endif;
        endif;
    }

    public function Pricing($ClienteData){
        $this->Data['plano'] = strip_tags(trim($ClienteData['plano']));
        $this->Data['pricing'] = strip_tags(trim($ClienteData['pricing']));
        $this->Data['moeda'] = strip_tags(trim($ClienteData['moeda']));
        $this->Data['type'] = strip_tags(trim($ClienteData['type']));
        $this->Data['content'] = ($ClienteData['content']);

        if(in_array("", $this->Data)):
            $this->Error = ["Preencha todos os campos para continuar com o processo!", WS_INFOR];
            $this->Result = false;
        else:
            $this->Data['lang'] = $this->lang;
            $this->Data['status'] = 1;
            $this->CreatePricing();
        endif;
    }

    private function CreatePricing(){
        $Create = new Create();
        $Create->ExeCreate(self::pricing, $this->Data);

        if($Create->getResult()):
            $this->Error = ["Operação realizada com sucesso!", WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Error = ["Aconteceu um erro inesperado ao salvar a operação, atualize a página e tente novamente!", WS_ERROR];
            $this->Result = false;
        endif;
    }

    public function UpdatePricing($ClienteData, $postId){
        $this->ID = $postId;
        $this->Data['plano'] = strip_tags(trim($ClienteData['plano']));
        $this->Data['pricing'] = strip_tags(trim($ClienteData['pricing']));
        $this->Data['moeda'] = strip_tags(trim($ClienteData['moeda']));
        $this->Data['type'] = strip_tags(trim($ClienteData['type']));
        $this->Data['content'] = ($ClienteData['content']);

        if(in_array("", $this->Data)):
            $this->Error = ["Preencha todos os campos para continuar com o processo!", WS_INFOR];
            $this->Result = false;
        else:
            $this->Data['lang'] = $this->lang;
            $this->Data['status'] = 1;
            $this->PricingUpdate();
        endif;
    }

    private function PricingUpdate(){
        $Update = new Update();
        $Update->ExeUpdate(self::pricing, $this->Data, "WHERE id=:i AND lang=:lg ", "i={$this->ID}&lg={$this->lang}");

        if($Update->getResult()):
            $this->Error = ["O formulário foi atualizado com sucesso!", WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Result = false;
            $this->Error = ["Aconteceu um erro inesperado ao atualizar o formulário!", WS_ERROR];
        endif;
    }

    private function CheckPassword($Password){
        unset($this->Data['password']);
        $this->Data['password'] = $Password;

        if(empty($this->Data['password'])):
            $this->Error = ['Preencha o campo senha para continuar com o processo!', WS_ERROR];
            $this->Result = false;
        elseif(isset($this->Data['password']) && strlen($this->Data['password']) < 8):
            $this->Error = ["O campo senha deve ter no minimo 8 caracteres.", WS_ALERT];
            $this->Result = false;
        elseif (!preg_match('/[A-Z]/', $this->Data['password']) || !preg_match('/[a-z]/', $this->Data['password'])):
            $this->Error = ["O campo senha deve conter caracteres Maiúsculos e Minúsculos.", WS_ERROR];
            $this->Result = false;
        elseif (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $this->Data['password'])):
            $this->Error = ["A senha deve conter caracteres especiais!", WS_INFOR];
            $this->Result = false;
        elseif(!preg_match('/[0-9]/', $this->Data['password'])):
            $this->Result = false;
            $this->Error = ["O campo senha deve conter números!", WS_ALERT];
        else:
            $this->Result = true;
        endif;
    }

    private function UsersCreate(){
        $Create = new Create();
        $Create->ExeCreate(self::users, $this->Data);

        if($Create->getResult()):
            $this->Error = ["Usuário criado com sucesso!", WS_ACCEPT];
            $this->Result = false;
        else:
            $this->Error = ["Aconteceu um erro inesperado ao criar usuário!", WS_ERROR];
            $this->Result = false;
        endif;
    }

    public function SEO($ClienteData, $language = null){
        unset($ClienteData['SendPostFormL']);

        $this->Data['description'] = strip_tags(trim($ClienteData['description']));
        $this->Data['keywords'] = strip_tags(trim($ClienteData['keywords']));
        $this->Data['author'] = strip_tags(trim($ClienteData['author']));

        if(!isset($this->Data['author']) || empty($this->Data['author'])):
            $this->Error = ["Preencha o campo Autor para continuar!", WS_ALERT];
            $this->Result = false;
        else:
            $status = 1;

            $Read = new Read();
            $Read->ExeRead(self::Seo, "WHERE status=:i ", "i={$status}");

            if($Read->getResult()):
                $this->ID = $Read->getResult()[0]['id'];
                $this->UpdateSeo();
            else:
                $this->Data['status'] = 1;
                $this->CreateSeo();
            endif;
        endif;
    }

    private function CreateSeo(){
        $Create = new Create();
        $Create->ExeCreate(self::Seo, $this->Data);

        if($Create->getResult()):
            $this->Error = ["Seo foi salvo com sucesso!", WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Error = ["Aconteceu um erro inesperado ao salvar o Seo!", WS_ERROR];
            $this->Result = false;
        endif;
    }

    private function UpdateSeo(){
        $Update = new Update();
        $Update->ExeUpdate(self::Seo, $this->Data, "WHERE id=:i ", "i={$this->ID}");

        if($Update->getResult()):
            $this->Error = ["Seo atualizado com sucesso!", WS_ALERT];
            $this->Result = true;
        else:
            $this->Error = ["Aconteceu um erro inesperado ao atualizar o Seo", WS_ERROR];
            $this->Result = false;
        endif;
    }

    public function Config($ClienteData, $file_one, $file_two, $file_tree, $language = null){
        unset($ClienteData['SendPostFormL']);
        //$this->Data = $ClienteData;
        $this->logotype = $file_one;
        $this->logotype_footer = $file_two;
        $this->icon = $file_tree;
        $this->lang = $language;

        $this->Data['name'] = strip_tags(trim($ClienteData['name']));
        $this->Data['email'] = strip_tags(trim($ClienteData['email']));
        $this->Data['telefone'] = strip_tags(trim($ClienteData['telefone']));
        $this->Data['endereco'] = strip_tags(trim($ClienteData['endereco']));
        $this->Data['facebook'] = strip_tags(trim($ClienteData['facebook']));
        $this->Data['twitter'] = strip_tags(trim($ClienteData['twitter']));
        $this->Data['linkedin'] = strip_tags(trim($ClienteData['linkedin']));
        $this->Data['whatsapp'] = strip_tags(trim($ClienteData['whatsapp']));
        $this->Data['instagram'] = strip_tags(trim($ClienteData['instagram']));
        $this->Data['youtube'] = strip_tags(trim($ClienteData['youtube']));
        $this->Data['email_host'] = strip_tags(trim($ClienteData['email_host']));
        $this->Data['email_senha'] = strip_tags(trim($ClienteData['email_senha']));
        $this->Data['email_porta'] = strip_tags(trim($ClienteData['email_porta']));
        $this->Data['email_name'] = strip_tags(trim($ClienteData['email_name']));

        if(!isset($this->Data['name']) || empty($this->Data['name'])):
            $this->Error = ["Preencha o campo Titulo do site para continuar!", WS_ALERT];
            $this->Result = false;
        elseif(!empty($this->Data['email']) && !Check::Email($this->Data['email'])):
            $this->Error = ["Introduza um endereço de email válido!", WS_ALERT];
            $this->Result = false;
        else:
            $this->SendLogoty();
            if($this->Result):
                $this->Data['cover'] = $this->logotype['logotype'];
            endif;

            $this->SendLogotyFooter();
            if($this->Result):
                $this->Data['cover_rodape'] = $this->logotype_footer['logotype_footer'];
            endif;

            $this->SendIcon();
            if($this->Result):
                $this->Data['icon'] = $this->icon['icon'];
            endif;

            $status = 1;

            $Read = new Read();
            $Read->ExeRead(self::config, "WHERE status=:i ", "i={$status}");

            if($Read->getResult()):
                $this->ID = $Read->getResult()[0]['id'];
                $this->UpdateConfig();
            else:
                $this->Data['status'] = 1;
                $this->CreateConfig();
            endif;
        endif;
    }

    private function UpdateConfig(){
        $Update = new Update();
        $Update->ExeUpdate(self::config, $this->Data, "WHERE id=:i ", "i={$this->ID}");

        if($Update->getResult()):
            $this->Error = ["As configurações foram atualizadas com sucesso!", WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Error = ["Aconteceu um erro inesperado ao atualizar as configurações!", WS_ERROR];
            $this->Result = false;
        endif;
    }

    private function CreateConfig(){
        $Create = new Create();
        $Create->ExeCreate(self::config, $this->Data);

        if($Create->getResult()):
            $this->Error = ["As configurações foram salvas com sucesso!", WS_ACCEPT];
            $this->Result = true;
        else:
            $this->Error = ["Aconteceu um erro inesperado ao salvar as configurações!", WS_ERROR];
            $this->Result = false;
        endif;
    }

    public function gbSendGallery(array $Image, $ClienteData, $postId){
        $this->File = $Image;
        $this->postId = $postId;

        $this->Data['id_news']  = $this->postId;
        $ImageName = "50726f536d617274-";

        if(empty($ClienteData)): $ClienteData = "Insira a fonte"; endif;

        if(empty($ClienteData)):
            $this->Result = false;
            $this->Error = ["Indroduza o crédito das imagens para continuar com o processo!", WS_ERROR];
        else:

            $gbFiles = array();
            $gbCount = Count($this->File['tmp_name']);
            $gbKeys  = array_keys($this->File);
            for($gb = 0; $gb < $gbCount; $gb++):
                foreach($gbKeys as $Keys):
                    $gbFiles[$gb][$Keys] = $this->File[$Keys][$gb];
                endforeach;
            endfor;

            $gbSend = new Upload('uploads/');

            $i = 0;
            $u = 0;

            foreach($gbFiles as $gbUpload):
                $i++;

                $format = array();
                $format['a'] = '\\|§$%&/()=?»£€{[]}´*+*ª^_.:-;,~´`áàâãéèêóòôõíìîúùûç';
                $format['b'] = '                                                    ';

                $ImgNames = strtr(utf8_decode($ImageName), $format['a'], $format['b']);

                $ImgNameL = "{$ImgNames}-gb-{$ImgNames}". (substr(md5(time() + $i), 0,5));
                $gbSend->Image($gbUpload, $ImgNameL, 0,'gallery');

                if($gbSend->getResult()):
                    $gbImage = $gbSend->getResult();
                    $this->Data['cover'] = $gbImage;

                    if(empty($ClienteData)):
                        $this->Result = false;
                        $this->Error = ["Indroduza o crédito das imagens para continuar com o processo!", WS_ERROR];
                    else:
                        $this->Data['credito_imagemX'] = strip_tags(trim($ClienteData));

                        $insertGb = new Create;
                        $insertGb->ExeCreate(self::gallery_blog, $this->Data);
                        $u++;
                    endif;
                endif;
            endforeach;

            if($u >= 1):
                $this->Error = ["Galleria atualizada com sucesso, foram enviadas {$u} imagens para galeria.", WS_ACCEPT];
                $this->Result  = true;
            endif;
        endif;
    }

    private function TempoDeLeitura(){
        // Tempo de leitura
        $tempo_total = null;
        $tempo_medio = 0.5;
        $tempo_leitura = null;

        $quantidade_palavras = str_word_count($this->Data['content']);
        $tempo_leitura = $tempo_medio * $quantidade_palavras;

        $tempo_total = floor($tempo_leitura/60);

        $this->Data['tempo_leitura'] = $tempo_total;
    }

    public function gbSend(array $Image, $ClienteData){
        $this->File = $Image;
        $ImageName = "50726f536d617274-";

        $this->Data['name'] = strip_tags(trim($ClienteData['name']));
        $this->Data['data'] = date('d-m-Y');
        $this->Data['hora'] = date('H:i:s');
        $this->Data['status'] = 1;
        $this->Data['lang'] = $this->lang;

        $gbFiles = array();
        $gbCount = Count($this->File['tmp_name']);
        $gbKeys  = array_keys($this->File);
        for($gb = 0; $gb < $gbCount; $gb++):
            foreach($gbKeys as $Keys):
                $gbFiles[$gb][$Keys] = $this->File[$Keys][$gb];
            endforeach;
        endfor;

        $gbSend = new Upload('uploads/');

        $i = 0;
        $u = 0;

        foreach($gbFiles as $gbUpload):
            $i++;

            $format = array();
            $format['a'] = '\\|§$%&/()=?»£€{[]}´*+*ª^_.:-;,~´`áàâãéèêóòôõíìîúùûç';
            $format['b'] = '                                                    ';

            $ImgNames = strtr(utf8_decode($ImageName), $format['a'], $format['b']);

            $ImgNameL = "{$ImgNames}-gb-{$ImgNames}". (substr(md5(time() + $i), 0,5));
            $gbSend->Image($gbUpload, $ImgNameL, 0,'gallery');

            if($gbSend->getResult()):
                $gbImage = $gbSend->getResult();
                $this->Data['cover'] = $gbImage;

                $insertGb = new Create;
                $insertGb->ExeCreate(self::gallery, $this->Data);
                $u++;
            endif;
        endforeach;

        if($u >= 1):
            $this->Error = ["Galleria atualizada com sucesso, foram enviadas {$u} imagens para galeria.", WS_ACCEPT];
            $this->Result  = true;
        else:
            $this->Error = ["Aconteceu um erro inesperado ao atualizar a galeria!", WS_INFOR];
            $this->Result = false;
        endif;
    }

    private function SendLogoty(){
        if(!empty($this->logotype['logotype']['tmp_name'])):
            $Upload = new Upload;
            $Upload->Image($this->logotype['logotype']);

            if($Upload->getError()):
                $this->Error = $Upload->getError();
                $this->Result = false;
            else:
                $this->logotype['logotype'] = $Upload->getResult();
                $this->Result = true;
            endif;
        endif;
    }

    private function SendLogotyFooter(){
        if(!empty($this->logotype_footer['logotype_footer']['tmp_name'])):
            $Upload = new Upload;
            $Upload->Image($this->logotype_footer['logotype_footer']);

            if($Upload->getError()):
                $this->Error = $Upload->getError();
                $this->Result = false;
            else:
                $this->logotype_footer['logotype_footer'] = $Upload->getResult();
                $this->Result = true;
            endif;
        endif;
    }

    private function SendIcon(){
        if(!empty($this->icon['icon']['tmp_name'])):
            $Upload = new Upload;
            $Upload->Image($this->icon['icon']);

            if($Upload->getError()):
                $this->Error = $Upload->getError();
                $this->Result = false;
            else:
                $this->icon['icon'] = $Upload->getResult();
                $this->Result = true;
            endif;
        endif;
    }

    private function SendFile(){
        if(!empty($this->file['file']['tmp_name'])):
            $Upload = new Upload;
            $Upload->File($this->file['file']);

            if($Upload->getError()):
                $this->Error = $Upload->getError();
                $this->Result = false;
            else:
                $this->file['file'] = $Upload->getResult();
                $this->Result = true;
            endif;
        endif;
    }

    public function getResult(){
        return $this->Result;
    }

    public function getError(){
        return $this->Error;
    }

    function __construct($lang = null){
        if(!isset($lang) || empty($lang)):
            $this->lang = "pt";
        else:
            $this->lang = strip_tags(trim($lang));
        endif;
    }

    private $Result, $Error, $Data, $logotype, $logotype_footer, $icon, $lang, $Category, $ID, $file, $File, $Author, $postId;

    const
        config = "xp_config",
        category = "xp_category",
        gallery_blog = "xp_gallery_blog",
        users = "xp_users",
        create = "xp_create_all_in_one",
        reports = "xp_legislacao_and_reports",
        author = "xp_author_and_test_and_team",
        numbers = "xp_numbers",
        faqs = "xp_faqs",
        pricing = "xp_pricing",
        gallery = "xp_gallery",
        blog = "xp_blog",
        Seo = "xp_seo";
}