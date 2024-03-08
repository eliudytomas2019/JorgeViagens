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
    &nbsp;&nbsp;<a href="__admin.php?exe=reports/index&lang=<?= $language; ?>" class="btn btn-primary"><?php
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
            $postId = filter_input(INPUT_GET, "postId", FILTER_VALIDATE_FLOAT);
            $ClienteData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if ($ClienteData && $ClienteData['SendPostFormL']):
                $file_one['file'] = ($_FILES['file']['tmp_name'] ? $_FILES['file'] : null);

                $Business = new ProjectXP($language);
                $Business->UpdateLegAndRep($ClienteData, $file_one, $postId);
                if($Business->getResult()):
                    WSError($Business->getError()[0], $Business->getError()[1]);
                else:
                    WSError($Business->getError()[0], $Business->getError()[1]);
                endif;
            else:
                $status = 1;

                $Read = new Read();
                $Read->ExeRead("xp_legislacao_and_reports", "WHERE id=:i ", "i={$postId}");

                if($Read->getResult()):
                    $ClienteData = $Read->getResult()[0];
                endif;
            endif;
            ?>
            <form method="post" action="" name="SendPostFormL" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
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
                            <label>File</label>
                            <input type="file" class="form-control" value="<?php if (!empty($ClienteData['file'])) echo $ClienteData['file']; ?>" name="file" id="file" accept=".pdf, .doc, .docx, .xml, .docm, .xls, .dif, .pptx" placeholder=""/>
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
                                <option value="leg" <?php if (isset($ClienteData['type']) && $ClienteData['type'] == "leg") echo 'selected="selected"'; ?>><?php if($language == "pt"):echo "Legislação";elseif($language == "fr"):echo "Législation";else:echo "Legislation";endif; ?></option>
                                <option value="rep" <?php if (isset($ClienteData['type']) && $ClienteData['type'] == "rep") echo 'selected="selected"'; ?>><?php if($language == "pt"):echo "Relatórios";elseif($language == "fr"):echo "Rapports";else:echo "Reports";endif; ?></option>
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