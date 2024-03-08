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
    &nbsp;&nbsp;<a href="__admin.php?exe=author/index&lang=<?= $language; ?>" class="btn btn-primary"><?php
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

                $Business = new ProjectXP($language);
                $Business->Author($ClienteData, $file_one);
                if($Business->getResult()):
                    WSError($Business->getError()[0], $Business->getError()[1]);
                else:
                    WSError($Business->getError()[0], $Business->getError()[1]);
                endif;
            endif;
            ?>
            <form method="post" action="" name="SendPostFormL" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Nome";
                                elseif($language == "fr"):
                                    echo "Nom";
                                else:
                                    echo "Name";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['name'])) echo $ClienteData['name']; ?>" name="name" id="name" placeholder=""/>
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
                                    echo "Função";
                                elseif($language == "fr"):
                                    echo "Fonction";
                                else:
                                    echo "Function";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['function_1'])) echo $ClienteData['function_1']; ?>" name="function_1" id="function_1" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Extra";
                                elseif($language == "fr"):
                                    echo "Extra";
                                else:
                                    echo "Supplémentaire";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['extra'])) echo $ClienteData['extra']; ?>" name="extra" id="extra" placeholder=""/>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Facebook";
                                elseif($language == "fr"):
                                    echo "Facebook";
                                else:
                                    echo "Facebook";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['facebook'])) echo $ClienteData['facebook']; ?>" name="facebook" id="facebook" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Twitter";
                                elseif($language == "fr"):
                                    echo "Twitter";
                                else:
                                    echo "Twitter";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['twitter'])) echo $ClienteData['twitter']; ?>" name="twitter" id="twitter" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Linkedin";
                                elseif($language == "fr"):
                                    echo "Linkedin";
                                else:
                                    echo "Linkedin";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['linkedin'])) echo $ClienteData['linkedin']; ?>" name="linkedin" id="linkedin" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Instagram";
                                elseif($language == "fr"):
                                    echo "Instagram";
                                else:
                                    echo "Instagram";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['instagram'])) echo $ClienteData['instagram']; ?>" name="instagram" id="instagram" placeholder=""/>
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
                                <option value="author" <?php if (isset($ClienteData['type']) && $ClienteData['type'] == "author") echo 'selected="selected"'; ?>><?php if($language == "pt"):echo "Autor";elseif($language == "fr"):echo "Auteur";else:echo "Author";endif; ?></option>
                                <option value="testimonial" <?php if (isset($ClienteData['type']) && $ClienteData['type'] == "testimonial") echo 'selected="selected"'; ?>><?php if($language == "pt"):echo "Testemunhos";elseif($language == "fr"):echo "Témoignages";else:echo "Testimonial";endif; ?></option>
                                <option value="team" <?php if (isset($ClienteData['type']) && $ClienteData['type'] == "team") echo 'selected="selected"'; ?>><?php if($language == "pt"):echo "Equipe";elseif($language == "fr"):echo "Équipe";else:echo "Team";endif; ?></option>
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