<?php
if ($language == "pt"):
    $page = "Criar novo Registro I | {$Ass['name']}";
elseif ($language == "en"):
    $page = "Create new Record I | {$Ass['name']}";
else:
    $page = "Créer un nouvel enregistrement I | {$Ass['name']}";
endif;

include("_app/_Desk/Include/Seo.inc.php");
?>

<div class="row">
    &nbsp;&nbsp;<a href="__admin.php?exe=gallery/create&lang=<?= $language; ?>" class="btn btn-primary"><?php
        if($language == "pt"):
            echo "Criar Novo";
        elseif($language == "fr"):
            echo "Créer un nouveau";
        else:
            echo "Create news";
        endif;
        ?></a>
</div><br/>

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title"><?php
                    if($language == "pt"):
                        echo "Galeria";
                    elseif($language == "fr"):
                        echo "Galerie";
                    else:
                        echo "Gallery";
                    endif;
                    ?></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                        $database = "xp_gallery";
                        $id = filter_input(INPUT_GET, "postId", FILTER_VALIDATE_FLOAT);
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
                        $read->ExeRead($database, "ORDER BY id DESC");
                        if($read->getResult()):
                            foreach ($read->getResult() as $key):
                                ?>
                                <div class="col-sm-2">
                                    <a target="_blank" href="uploads/<?php if($key["cover"] != '' || !empty($key['cover'])): echo $key["cover"]; else: echo 'default.jpg'; endif; ?>" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                                        <img src="uploads/<?php if($key["cover"] != '' || !empty($key['cover'])): echo $key["cover"]; else: echo 'default.jpg'; endif; ?>" class="img-fluid mb-2" alt="white sample"/>
                                    </a>

                                    <div class="ms-auto">
                                        <a href="__admin.php?exe=gallery/index&postId=<?= $key['id']; ?>&action=delete" class="btn btn-sm btn-danger">Apagar</a>&nbsp;
                                    </div>
                                </div>
                                <?php
                            endforeach;
                        endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>