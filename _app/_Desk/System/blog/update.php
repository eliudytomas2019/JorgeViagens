<?php
$page = "Atualizar notícia | {$Ass['name']}";


include("_app/_Desk/Include/Seo.inc.php");
?>

<div class="row">
    &nbsp;&nbsp;<a href="__admin.php?exe=blog/index&lang=<?= $language; ?>" class="btn btn-primary"><?php
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
        <h3 class="card-title">Blog</h3>
    </div>

    <div class="card-body">
        <div class="row">
            <?php
            $postId = filter_input(INPUT_GET, "postId", FILTER_VALIDATE_FLOAT);
            $SendForm = filter_input(INPUT_POST, "SendPostFormL");
            $ClienteData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if(isset($SendForm)):
                if ($ClienteData && $ClienteData['SendPostFormL']):
                    $logotype['logotype'] = ($_FILES['logotype']['tmp_name'] ? $_FILES['logotype'] : null);

                    $Business = new ProjectXP($language);
                    $Business->UpdateBlog($ClienteData, $logotype, $postId);
                    if($Business->getResult()):
                        WSError($Business->getError()[0], $Business->getError()[1]);
                    else:
                        WSError($Business->getError()[0], $Business->getError()[1]);
                    endif;
                else:
                    $status = 1;

                    $Read = new Read();
                    $Read->ExeRead("xp_blog", "WHERE id=:i ", "i={$postId}");

                    if($Read->getResult()):
                        $ClienteData = $Read->getResult()[0];
                    endif;
                endif;
            else:
                $status = 1;

                $Read = new Read();
                $Read->ExeRead("xp_blog", "WHERE id=:i ", "i={$postId}");

                if($Read->getResult()):
                    $ClienteData = $Read->getResult()[0];
                endif;
            endif;
            ?>
            <form method="post" action="" name="SendPostFormL" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="control-label " for="">Titulo <span class="required">*</span>
                            </label>
                            <input id="title" class="form-control"  name="title" value="<?php if (!empty($ClienteData['title'])) echo $ClienteData['title']; ?>" placeholder="" type="text">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label" for="">Categoria <span class="required">*</span>
                            </label>
                            <select name="id_category" id="id_category" class="form-control">
                                <option value="">-- Seleciona a categoria --</option>
                                <?php
                                $Read = new Read();
                                $Read->ExeRead("xp_category", "ORDER BY views DESC");

                                if($Read->getResult()):
                                    foreach ($Read->getResult() as $key):
                                        ?>
                                        <option  value="<?= $key['id']; ?>" <?php if(isset($ClienteData['id_category']) && $ClienteData['id_category'] == $key['id']) echo " selected" ?>><?= $key['category']." ({$key['posts']})"; ?></option>
                                    <?php
                                    endforeach;
                                endif;
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Autor <span class="required">*</span>
                            </label>
                            <select name="id_author" id="id_author" class="form-control">
                                <option value="">-- Seleciona o autor --</option>
                                <?php
                                $tt = "author";

                                $Read = new Read();
                                $Read->ExeRead("xp_author_and_test_and_team", "WHERE type=:yy ORDER BY posts DESC, views DESC", "yy={$tt}");

                                if($Read->getResult()):
                                    foreach ($Read->getResult() as $key):
                                        ?>
                                        <option  value="<?= $key['id']; ?>" <?php if(isset($ClienteData['id_author']) && $ClienteData['id_author'] == $key['id']) echo " selected" ?>><?= $key['name']." ({$key['posts']})"; ?></option>
                                    <?php
                                    endforeach;
                                endif;
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label" for="">Data <span class="required">*</span>
                            </label>
                            <input id="data" class="form-control"  name="data" value="<?php if (!empty($ClienteData['data'])) echo $ClienteData['data']; else echo date('Y-m-d'); ?>" placeholder="" type="date">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label" for="">Hora <span class="required">*</span>
                            </label>
                            <input id="hora" class="form-control"  name="hora" value="<?php if (!empty($ClienteData['hora'])) echo $ClienteData['hora']; else echo date('H:i'); ?>" placeholder="" type="time">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label" for="">Imagem <span class="required">*</span>
                            </label>
                            <input id="logotype" class="form-control"  name="logotype" value="<?php if (!empty($ClienteData['logotype'])) echo $ClienteData['logotype']; ?>" placeholder="" type="file" accept=".jpg, .png">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label" for="">Credito Imagem <span class="required"></span>
                            </label>
                            <input id="credito_imagem" class="form-control"  name="credito_imagem" value="<?php if (!empty($ClienteData['credito_imagem'])) echo $ClienteData['credito_imagem']; ?>" placeholder="" type="text"/>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label" for="">Titulo do Link <span class="required"></span>
                            </label>
                            <input id="title_link" class="form-control"  name="title_link" value="<?php if (!empty($ClienteData['title_link'])) echo $ClienteData['title_link']; ?>" placeholder="" type="text">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label " for="">Link <span class="required"></span>
                            </label>
                            <input id="link" class="form-control"  name="link" value="<?php if (!empty($ClienteData['link'])) echo $ClienteData['link']; ?>" placeholder="" type="text">
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
</div><br/>

<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Galeria do Blog</h3>
    </div>

    <div class="card-body">
        <div class="row">
            <?php
            $ClienteData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $SendFormGallery = filter_input(INPUT_POST, "SendPostForm");
            if(isset($SendFormGallery)):
                if ($ClienteData && $ClienteData['SendPostForm']):
                    $BR = new ProjectXP($language);
                    $BR->gbSendGallery($_FILES['gallery'], $ClienteData['credito_imagemX'], $postId);

                    if($BR->getResult()):
                        WSError($BR->getError()[0], $BR->getError()[1]);
                    else:
                        WSError($BR->getError()[0], $BR->getError()[1]);
                    endif;
                endif;
            endif;
            ?>
            <form class="form-horizontal form-label-left" method="post" action="" name = "SendPostForm"  enctype="multipart/form-data">
                <div class="col-lg-12">
                    <div class="form-group">
                    <label class="control-label" for="">Credito Imagem <span class="required"></span>
                    </label>
                        <input id="credito_imagemX" class="form-control"  name="credito_imagemX" placeholder="" type="text"/>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                    <label class="control-label" for="name">Imagens <span class="required">*</span>
                    </label>
                        <input id="gallery[]" type="file" accept=".png, .jpg, .jpeg" multiple name="gallery[]" class="form-control">
                    </div>
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <input type="submit" name="SendPostForm" class="btn btn-primary ms-auto" value="Salvar"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><br/>

<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Galeria do Blog</h3>
    </div>

    <div class="card-body">
        <div class="row">
            <?php
            $database = "xp_gallery_blog";
            $id = filter_input(INPUT_GET, "id", FILTER_DEFAULT);
            if(isset($id) || $id != null):
                $Read = new Read();
                $Update = new Update();
                $action = filter_input(INPUT_GET, "action", FILTER_DEFAULT);
                switch ($action):
                    case "delete":
                        $Delete = new Delete();
                        $Delete->ExeDelete($database, "WHERE id=:i", "i={$id}");
                        if($Delete->getResult() || $Delete->getRowCount()):
                            WSError("Publicaçāo apagada com sucesso!", WS_ACCEPT);
                        else:
                            WSError("Ops: aconteceu um erro inesperado ao apagar a publicaçāo!", WS_ERROR);
                        endif;
                        break;
                    default:
                        WSError("Ops: nāo encontramos a açāo desejada!", WS_INFOR);
                endswitch;
            endif;

            $read = new Read();
            $read->ExeRead($database, "WHERE id_news=:i", "i={$postId}");
            if($read->getResult()):
                foreach ($read->getResult() as $key):
                    ?>
                    <div class="col-md-55">
                        <div class="thumbnail">
                            <div class="image view view-first">
                                <img style="width: 100%; display: block;" src="uploads/<?php if($key["cover"] != '' || !empty($key['cover'])): echo $key["cover"]; else: echo 'default.jpg'; endif; ?>" alt="<?php if (!empty($ClienteData['title'])) echo $ClienteData['title']; ?>" />
                                <div class="mask">
                                    <p><?php if (!empty($ClienteData['title'])) echo $ClienteData['title']; ?></p>
                                    <div class="tools tools-bottom">
                                        <a href="__admin.php?exe=blog/update&lang=<?= $language; ?>&postId=<?= $postId; ?>&id=<?= $key['id']; ?>&action=delete"><i class="fa fa-times"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="caption">
                                <p><?php if (!empty($ClienteData['title'])) echo $ClienteData['title']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</div>