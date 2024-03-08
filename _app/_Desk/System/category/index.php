<?php
$page = "Categoria | {$Ass['name']}";


include("_app/_Desk/Include/Seo.inc.php");
?>

<div class="row">
    &nbsp;&nbsp;<a href="__admin.php?exe=category/create&lang=<?= $language; ?>" class="btn btn-primary"><?php
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
                <h3 class="card-title"> Categorias</h3>
            </div>

            <div class="card-body table-responsive p-0">
                <?php
                $staus = ["Activar", "Suspender"];
                $staus0 = ["Activa", "Suspensa"];
                $database = "xp_category";
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
                                WSError("Publicaçāo eliminada com sucesso!", WS_ACCEPT);
                            else:
                                WSError("Ops: aconteceu um erro inesperado ao eliminar da publicaçāo!", WS_ERROR);
                            endif;
                            break;
                        case "status":
                            $Read->ExeRead($database, "WHERE id=:i", "i={$postId}");
                            if($Read->getResult()):
                                $Info = $Read->getResult()[0];
                                if($Info["status"] == 1): $data["status"] = 0; else: $data["status"] = 1; endif;
                                $Update->ExeUpdate($database, $data, "WHERE id=:i", "i={$postId}");
                                if($Update->getResult()):
                                    WSError("A publicaçāo do site foi {$staus0[$Info['status']]}", WS_INFOR);
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
                        <th>Cover</th>
                        <th>Categoria</th>
                        <th>Data & Hora</th>
                        <th>Views</th>
                        <th>Likes</th>
                        <th>-</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $posti = 0;
                    $getPage = filter_input(INPUT_GET, 'page',FILTER_VALIDATE_INT);
                    $Pager = new Pager("__admin.php?exe=category/index&lang={$language}&page=");
                    $Pager->ExePager($getPage, 12);

                    $Read = new Read();
                    $Read->ExeRead("{$database}", "ORDER BY views DESC, likes DESC LIMIT :limit OFFSET :offset ", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

                    if($Read->getResult()):
                        foreach ($Read->getResult() as $key):
                            ?>
                            <tr>
                                <td><?= $key['id']; ?></td>
                                <td><img style="width: 40px!important;height: 40px!important;border-radius: 50%!important;" src="./uploads/<?php if($key['cover'] != ''): echo $key['cover']; else: echo 'default.jpg'; endif;  ?>"></td>
                                <td><?= $key['category']; ?></td>
                                <td><?= $key['data']." ".$key['hora']; ?></td>
                                <td><?= $key['views']; ?></td>
                                <td><?= $key['likes']; ?></td>
                                <td>
                                    <a href="__admin.php?exe=category/index&postId=<?= $key['id']; ?>&action=status" class="btn btn-sm btn-primary"><?= $staus[$key['status']]; ?></a>
                                    <a href="__admin.php?exe=category/update&postId=<?= $key['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                                    <a href="__admin.php?exe=category/index&postId=<?= $key['id']; ?>&action=delete" class="btn btn-sm btn-danger">Apagar</a>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                    endif;
                    ?>
                    </tbody>
                </table>

                <?php
                    $Pager->ExePaginator($database, "WHERE lang=:i ORDER BY views DESC, likes DESC", "i={$language}");
                    echo $Pager->getPaginator();
                ?>
            </div>
        </div>
    </div>
</div>