<?php
$acao = strip_tags((filter_input(INPUT_POST, 'acao', FILTER_DEFAULT)));

if ($acao):
    require_once("../../Config.inc.php");

    switch ($acao):
        case 'searchUsers':
            $sLevel = ["", "Usuário", "", "", "Editor", "Administrador"];
            $staus = ["Activar", "Suspender"];
            $txt = strip_tags(trim($_POST['txt']));
            $Read = new Read();
            $Read->ExeRead("db_users", "WHERE (name LIKE '%' :link '%') OR (level LIKE '%' :link '%') OR (id LIKE '%' :link '%') ORDER BY name DESC LIMIT 12", "link={$txt}");

            if($Read->getResult()):
                foreach ($Read->getResult() as $key):
                    ?>
                    <tr>
                        <td><?= $key['id']; ?></td>
                        <td><img style="width: 40px!important;height: 40px!important;border-radius: 50%!important;" src="./uploads/<?php if($key['cover'] != ''): echo $key['cover']; else: echo 'default.jpg'; endif;  ?>"</td>
                        <td><?= $key['name']." ".$key['lastname']; ?></td>
                        <td><?= $sLevel[$key['level']]; ?></td>
                        <td><?= $key['telefone']; ?></td>
                        <td><?= $key['username']; ?></td>
                        <td>
                            <a href="cPanel.php?exe=default/users&postId=<?= $key['id']; ?>&action=status" class="btn btn-sm btn-primary"><?= $staus[$key['status']]; ?></a>
                            <a href="cPanel.php?exe=default/update&postId=<?= $key['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="cPanel.php?exe=default/users&postId=<?= $key['id']; ?>&action=delete" class="btn btn-sm btn-danger">Apagar</a>
                        </td>
                    </tr>
                    <?php
                endforeach;
            endif;
            break;
        case 'searchNews':
            $staus = ["Activar", "Suspender"];
            $txt = strip_tags(trim($_POST['txt']));
            $Read = new Read();
            $Read->ExeRead("nerd_news", "WHERE (title LIKE '%' :link '%') OR (content LIKE '%' :link '%') OR (id LIKE '%' :link '%') ORDER BY views DESC, commint DESC LIMIT 12", "link={$txt}");

            if($Read->getResult()):
                foreach ($Read->getResult() as $key):
                    ?>
                    <tr>
                        <td><?= $key['id']; ?></td>
                        <td><img style="width: 40px!important;height: 40px!important;border-radius: 50%!important;" src="./uploads/<?php if($key['cover'] != ''): echo $key['cover']; else: echo 'default.jpg'; endif;  ?>"</td>
                        <td><?= $key['title']; ?></td>
                        <td><?php $Read->ExeRead("nerd_category", "WHERE id=:i ", "i={$key['id_category']}"); if($Read->getResult()) echo $Read->getResult()[0]['category']; ?></td>
                        <td><?php $Read->ExeRead("nerd_author", "WHERE id=:i ", "i={$key['id_author']}"); if($Read->getResult()) echo $Read->getResult()[0]['name']; ?></td>
                        <td><?= $key['data']." ".$key['hora']; ?></td>
                        <td><?= $key['commint']; ?></td>
                        <td><?= $key['likes']; ?></td>
                        <td><?= $key['views']; ?></td>
                        <td>
                            <a href="cPanel.php?exe=news/index&postId=<?= $key['id']; ?>&action=status" class="btn btn-sm btn-primary"><?= $staus[$key['status']]; ?></a>
                            <a href="cPanel.php?exe=news/update&postId=<?= $key['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="cPanel.php?exe=news/index&postId=<?= $key['id']; ?>&action=delete" class="btn btn-sm btn-danger">Apagar</a>
                        </td>
                    </tr>
                <?php
                endforeach;
            endif;
            break;
        case 'searchAuthor':
            $staus = ["Activar", "Suspender"];
            $txt = strip_tags(trim($_POST['txt']));
            $status = 1;
            $Read = new Read();
            $Read->ExeRead("nerd_author", "WHERE (name LIKE '%' :link '%' AND status=:st) OR (content LIKE '%' :link '%'  AND status=:st) OR (posts LIKE '%' :link '%'  AND status=:st)  ORDER BY views DESC, posts DESC LIMIT 12", "link={$txt}&st={$status}");

            if($Read->getResult()):
                foreach ($Read->getResult() as $key):
                    ?>
                    <tr>
                        <td><?= $key['id']; ?></td>
                        <td><img style="width: 40px!important;height: 40px!important;border-radius: 50%!important;" src="./uploads/<?php if($key['cover'] != ''): echo $key['cover']; else: echo 'default.jpg'; endif;  ?>"</td>
                        <td><?= $key['name']; ?></td>
                        <td><?= $key['data']." ".$key['hora']; ?></td>
                        <td><?= $key['views']; ?></td>
                        <td><?= $key['posts']; ?></td>
                        <td>
                            <a href="cPanel.php?exe=author/index&postId=<?= $key['id']; ?>&action=status" class="btn btn-sm btn-primary"><?= $staus[$key['status']]; ?></a>
                            <a href="cPanel.php?exe=author/update&postId=<?= $key['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="cPanel.php?exe=author/index&postId=<?= $key['id']; ?>&action=delete" class="btn btn-sm btn-danger">Apagar</a>
                        </td>
                    </tr>
                    <?php
                endforeach;
            endif;
            break;
        case 'searchCategory':
            $staus = ["Activar", "Suspender"];
            $txt = strip_tags(trim($_POST['txt']));
            $status = 1;
            $Read = new Read();
            $Read->ExeRead("nerd_category", "WHERE (category LIKE '%' :link '%' AND status=:st) OR (content LIKE '%' :link '%'  AND status=:st) OR (id LIKE '%' :link '%'  AND status=:st)  ORDER BY views DESC, likes DESC LIMIT 12", "link={$txt}&st={$status}");

            if($Read->getResult()):
                foreach ($Read->getResult() as $key):
                    ?>
                    <tr>
                        <td><?= $key['id']; ?></td>
                        <td><img style="width: 40px!important;height: 40px!important;border-radius: 50%!important;" src="./uploads/<?php if($key['cover'] != ''): echo $key['cover']; else: echo 'default.jpg'; endif;  ?>"</td>
                        <td><?= $key['category']; ?></td>
                        <td><?= $key['data']." ".$key['hora']; ?></td>
                        <td><?= $key['views']; ?></td>
                        <td><?= $key['likes']; ?></td>
                        <td>
                            <a href="cPanel.php?exe=category/index&postId=<?= $key['id']; ?>&action=status" class="btn btn-sm btn-primary"><?= $staus[$key['status']]; ?></a>
                            <a href="cPanel.php?exe=category/update&postId=<?= $key['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="cPanel.php?exe=category/index&postId=<?= $key['id']; ?>&action=delete" class="btn btn-sm btn-danger">Apagar</a>
                        </td>
                    </tr>
                    <?php
                endforeach;
            endif;
            break;
        default:
            WSError("Ops: não encontramos a ação desejada!", WS_INFOR);
    endswitch;
endif;