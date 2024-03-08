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
    &nbsp;&nbsp;<a href="__admin.php?exe=reports/create&lang=<?= $language; ?>" class="btn btn-primary"><?php
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
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> <?php
                    if($language == "pt"):
                        echo "Criar Registros";
                    elseif($language == "fr"):
                        echo "Créer des enregistrements";
                    else:
                        echo "Create Records";
                    endif;
                    ?></h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body table-responsive p-0">
                <?php
                $staus = ["Activar", "Suspender"];
                $database = "xp_legislacao_and_reports";
                $postId = filter_input(INPUT_GET, "postId", FILTER_VALIDATE_FLOAT);
                if(isset($postId) || $postId != null):
                    $Read = new Read();
                    $Update = new Update();
                    $action = filter_input(INPUT_GET, "action", FILTER_DEFAULT);
                    switch ($action):
                        case "delete":
                            $Delete = new Delete();
                            $Delete->ExeDelete($database, "WHERE id=:i", "i={$postId}");
                            if($Delete->getResult() || $Delete->getRowCount()):
                                WSError("Publicaçāo apagada com sucesso!", WS_ACCEPT);
                            else:
                                WSError("Ops: aconteceu um erro inesperado ao apagar o status da publicaçāo!", WS_ERROR);
                            endif;
                            break;
                        case "status":
                            $Read->ExeRead($database, "WHERE id=:i", "i={$postId}");
                            if($Read->getResult()):
                                $Info = $Read->getResult()[0];
                                if($Info["status"] == 1): $data["status"] = 0; else: $data["status"] = 1; endif;
                                $Update->ExeUpdate($database, $data, "WHERE id=:i", "i={$postId}");
                                if($Update->getResult()):
                                    WSError("A publicaçāo do site foi {$staus[$Info['status']]}", WS_INFOR);
                                else:
                                    WSError("Ops: aconteceu um erro inesperado ao alterar o status da publicaçāo!", WS_ERROR);
                                endif;
                            endif;
                            break;
                        default:
                            WSError("Ops: nāo encontramos a açāo desejada!", WS_INFOR);
                    endswitch;
                endif;
                ?>
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th><?php if($language == "pt"):echo "Titulo";elseif($language == "fr"):echo "Titre";else:echo "Title";endif; ?></th>
                        <th><?php if($language == "pt"):echo "Hora & data";elseif($language == "fr"):echo "Heure et date";else:echo "Hour and date";endif; ?></th>
                        <th><?php if($language == "pt"):echo "Tipo";elseif($language == "fr"):echo "Taper";else:echo "Type";endif; ?></th>
                        <th>Download</th>
                        <th>-</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $posti = 0;
                    $getPage = filter_input(INPUT_GET, 'page',FILTER_VALIDATE_INT);
                    $Pager = new Pager("__admin.php?exe=reports/index&lang={$language}&page=");
                    $Pager->ExePager($getPage, 10);

                    $Read = new Read();
                    $Read->ExeRead($database, "WHERE lang=:i ORDER BY id DESC LIMIT :limit OFFSET :offset", "i={$language}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

                    if($Read->getResult()):
                        foreach ($Read->getResult() as $key):
                            ?>
                            <tr>
                                <td><?= $key['id']; ?></td>
                                <td><?= $key['title']; ?></td>
                                <td><?= $key['hora']." ".$key['data']; ?></td>
                                <td><?= $key['type']; ?></td>
                                <td><a href="__download.php?postId=<?= $key['id']; ?>" target="_blank">Download</a></td>
                                <td>
                                    <a href="__admin.php?exe=reports/update&postId=<?= $key['id']; ?>&lang=<?= $language; ?>" class="btn btn-primary"><?php if($language == "pt"):echo "Editar";elseif($language == "fr"):echo "Éditer";else:echo "Edit";endif; ?></a>
                                    <a href="__admin.php?exe=reports/index&postId=<?= $key['id']; ?>&action=status&lang=<?= $language; ?>" class="btn btn-warning"><?php if($language == "pt"):echo "Suspender";elseif($language == "fr"):echo "Suspendre";else:echo "Suspend";endif; ?></a>
                                    <a href="__admin.php?exe=reports/index&postId=<?= $key['id']; ?>&action=delete&lang=<?= $language; ?>" class="btn btn-danger"><?php if($language == "pt"):echo "Apagar";elseif($language == "fr"):echo "Éteindre";else:echo "Delete";endif; ?></a>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                    endif;
                    ?>
                    </tbody>
                </table>

                <?php
                $Pager->ExePaginator($database, "WHERE lang=:i", "i={$language}");
                echo $Pager->getPaginator();
                ?>
            </div>
        </div>
    </div>
</div>