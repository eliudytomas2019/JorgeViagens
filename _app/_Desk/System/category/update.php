<?php
$page = "Atualizar categoria | {$Ass['name']}";


include("_app/_Desk/Include/Seo.inc.php");
?>

<div class="row">
    &nbsp;&nbsp;<a href="__admin.php?exe=category/index&lang=<?= $language; ?>" class="btn btn-primary"><?php
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
        <h3 class="card-title">Categorias</h3>
    </div>

    <div class="card-body">
        <div class="row">
            <?php
            $postId = filter_input(INPUT_GET, "postId", FILTER_VALIDATE_FLOAT);
            $ClienteData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if ($ClienteData && $ClienteData['SendPostFormL']):
                $logotype['logotype'] = ($_FILES['logotype']['tmp_name'] ? $_FILES['logotype'] : null);

                $Business = new ProjectXP($language);
                $Business->CategoryUpdate($ClienteData, $logotype, $postId);
                if($Business->getResult()):
                    WSError($Business->getError()[0], $Business->getError()[1]);
                else:
                    WSError($Business->getError()[0], $Business->getError()[1]);
                endif;
            else:
                $status = 1;

                $Read = new Read();
                $Read->ExeRead("xp_category", "WHERE id=:i ", "i={$postId}");

                if($Read->getResult()):
                    $ClienteData = $Read->getResult()[0];
                endif;
            endif;
            ?>
            <form method="post" action="" name="SendPostFormL" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="">Categoria <span class="required">*</span>
                            </label>
                            <input id="category" class="form-control" value="<?php if (!empty($ClienteData['category'])) echo $ClienteData['category']; ?>" name="category" placeholder=""  type="text">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="">Imagem <span class="required">*</span>
                            </label>
                            <input id="logotype" class="form-control" name="logotype" placeholder="" accept=".jpg, .png" type="file">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="control-label" for="textarea">Descrição <span class="required">*</span>
                            </label>
                            <textarea id="content" name="content" class="form-control"><?php if (!empty($ClienteData['content'])) echo $ClienteData['content']; ?></textarea>
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