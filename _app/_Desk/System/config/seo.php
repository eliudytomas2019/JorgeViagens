<?php
if ($language == "pt"):
    $page = "Seo | {$Ass['name']}";
elseif ($language == "en"):
    $page = "Seo | {$Ass['name']}";
else:
    $page = "Seo | {$Ass['name']}";
endif;

include("_app/_Desk/Include/Seo.inc.php");
?>


<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">SEO</h3>
    </div>

    <div class="card-body">
        <div class="row">
            <?php
            $ClienteData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if ($ClienteData && $ClienteData['SendPostFormL']):
                $Business = new ProjectXP();
                $Business->SEO($ClienteData, $language);
                if($Business->getResult()):
                    WSError($Business->getError()[0], $Business->getError()[1]);
                else:
                    WSError($Business->getError()[0], $Business->getError()[1]);
                endif;
            else:
                $status = 1;

                $Read = new Read();
                $Read->ExeRead("xp_seo", "WHERE status=:i ", "i={$status}");

                if($Read->getResult()):
                    $ClienteData = $Read->getResult()[0];
                endif;
            endif;
            ?>
            <form method="post" action="" name="SendPostFormL" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Descrição";
                                elseif($language == "fr"):
                                    echo "Description";
                                else:
                                    echo "Description";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['description'])) echo $ClienteData['description']; ?>" name="description" id="description" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "KeyWords";
                                elseif($language == "fr"):
                                    echo "Mots clés";
                                else:
                                    echo "KeyWords";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['keywords'])) echo $ClienteData['keywords']; ?>" name="keywords" id="keywords" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Autor";
                                elseif($language == "fr"):
                                    echo "Auteur";
                                else:
                                    echo "Author";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['author'])) echo $ClienteData['author']; ?>" name="author" id="author" placeholder=""/>
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
