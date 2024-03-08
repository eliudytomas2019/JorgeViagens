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
    &nbsp;&nbsp;<a href="__admin.php?exe=pricing/index&lang=<?= $language; ?>" class="btn btn-primary"><?php
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

                $Business = new ProjectXP($language);
                $Business->Pricing($ClienteData);
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
                                    echo "Preço";
                                elseif($language == "fr"):
                                    echo "Prix";
                                else:
                                    echo "Pricing";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['pricing'])) echo $ClienteData['pricing']; ?>" name="pricing" id="pricing" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Plano";
                                elseif($language == "fr"):
                                    echo "Plat";
                                else:
                                    echo "Flat";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['plano'])) echo $ClienteData['plano']; ?>" name="plano" id="plano" placeholder=""/>
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
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['type'])) echo $ClienteData['type']; ?>" name="type" id="type" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Moeda";
                                elseif($language == "fr"):
                                    echo "Pièce de monnaie";
                                else:
                                    echo "Coin";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['moeda'])) echo $ClienteData['moeda']; ?>" name="moeda" id="moeda" placeholder=""/>
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