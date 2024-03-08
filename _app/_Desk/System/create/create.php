<?php
if ($language == "pt"):
    $page = "Criar novo Registro | {$Ass['name']}";
elseif ($language == "en"):
    $page = "Create new Record | {$Ass['name']}";
else:
    $page = "Créer un nouvel enregistrement | {$Ass['name']}";
endif;

include("_app/_Desk/Include/Seo.inc.php");
?>

<div class="row">
    &nbsp;&nbsp;<a href="__admin.php?exe=create/index_create&lang=<?= $language; ?>" class="btn btn-primary"><?php
        if($language == "pt"):
            echo "Voltar";
        elseif($language == "fr"):
            echo "Retourner";
        else:
            echo "To go back";
        endif;
        ?></a>
</div><br/>

<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title"><?php
            if($language == "pt"):
                echo "Criar Novo";
            elseif($language == "fr"):
                echo "Créer un nouveau";
            else:
                echo "Create news";
            endif;
            ?></h3>
    </div>

    <div class="card-body">
        <div class="row">
            <?php
            $ClienteData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if ($ClienteData && $ClienteData['SendPostFormL']):
                $file_one['logotype'] = ($_FILES['logotype']['tmp_name'] ? $_FILES['logotype'] : null);

                $Business = new ProjectXP();
                $Business->CreateAllInOne($ClienteData, $file_one, $language);
                if($Business->getResult()):
                    WSError($Business->getError()[0], $Business->getError()[1]);
                else:
                    WSError($Business->getError()[0], $Business->getError()[1]);
                endif;
            endif;
            ?>
            <form method="post" action="" name="SendPostFormL" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Titulo";
                                elseif($language == "fr"):
                                    echo "Titre";
                                else:
                                    echo "Title";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['title'])) echo $ClienteData['title']; ?>" name="title" id="title" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Subtitulo";
                                elseif($language == "fr"):
                                    echo "Légende";
                                else:
                                    echo "Subtitle";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['subtitle'])) echo $ClienteData['subtitle']; ?>" name="subtitle" id="subtitle" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Imagem";
                                elseif($language == "fr"):
                                    echo "Image";
                                else:
                                    echo "Cover";
                                endif;
                                ?></label>
                            <input type="file" class="form-control" value="<?php if (!empty($ClienteData['logotype'])) echo $ClienteData['logotype']; ?>" name="logotype" id="logotype" accept=".jpg, .png, .jpeg" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Tipo";
                                elseif($language == "fr"):
                                    echo "Taper";
                                else:
                                    echo "Type";
                                endif;
                                ?></label>
                            <select name="type" id="type" class="form-control">
                                <option value="home" <?php if (isset($ClienteData['type']) && $ClienteData['type'] == "home") echo 'selected="selected"'; ?>><?php if($language == "pt"):echo "Início";elseif($language == "fr"):echo "Commencer";else:echo "Start";endif; ?></option>
                                <option value="sobre" <?php if (isset($ClienteData['type']) && $ClienteData['type'] == "sobre") echo 'selected="selected"'; ?>><?php if($language == "pt"):echo "Sobre";elseif($language == "fr"):echo "À propos";else:echo "About";endif; ?></option>
                                <option value="historia" <?php if (isset($ClienteData['type']) && $ClienteData['type'] == "historia") echo 'selected="selected"'; ?>><?php if($language == "pt"):echo "História";elseif($language == "fr"):echo "Histoire";else:echo "History";endif; ?></option>
                                <option value="area_tuacao" <?php if (isset($ClienteData['type']) && $ClienteData['type'] == "area_tuacao") echo 'selected="selected"'; ?>><?php if($language == "pt"):echo "Área de Atuação";elseif($language == "fr"):echo "Zone d'occupation";else:echo "Occupation area";endif; ?></option>
                                <option value="servico" <?php if (isset($ClienteData['type']) && $ClienteData['type'] == "servico") echo 'selected="selected"'; ?>><?php if($language == "pt"):echo "Serviços";elseif($language == "fr"):echo "prestations de service";else:echo "Services";endif; ?></option>
                                <option value="produto" <?php if (isset($ClienteData['type']) && $ClienteData['type'] == "produto") echo 'selected="selected"'; ?>><?php if($language == "pt"):echo "Produtos";elseif($language == "fr"):echo "Des produits";else:echo "Products";endif; ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Descrição";
                                elseif($language == "fr"):
                                    echo "Description";
                                else:
                                    echo "Content";
                                endif;
                                ?></label>
                            <textarea name="content" id="content" class="form-control"><?php if (!empty($ClienteData['content'])) echo $ClienteData['content']; ?></textarea>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="form-footer">
                        <input type="submit" name="SendPostFormL" class="btn btn-primary" value="<?php
                        if($language == "pt"):
                            echo "Guardar";
                        elseif($language == "fr"):
                            echo "Sauvegarder";
                        else:
                            echo "Save";
                        endif;
                        ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>