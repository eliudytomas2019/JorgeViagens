<?php
$page = "Início | {$Ass['name']}";

include("_app/_Desk/Include/Seo.inc.php");
?>

<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <div class="info-box-content">
                <span class="info-box-text"> Total de Usuários</span>
                <span class="info-box-number">
                 <?php
                 $dia = date('d');
                 $mes = date('m');
                 $ano = date('Y');

                 $Read = new Read();
                 $Read->ExeRead("xp_users");

                 if($Read->getResult()): echo $Read->getRowCount(); endif;

                 $siteViews = null;
                 $ip = date('Y-m-d');

                 $Read->ExeRead("site_views", "WHERE s_date=:i", "i={$ip}");
                 if($Read->getResult()): $siteViews = $Read->getResult()[0]; else: $siteViews['pages'] = null;  endif;
                 ?>
                </span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <div class="info-box-content">
                <span class="info-box-text">Sessões</span>
                <span class="info-box-number">
                    <?php
                    $Read->FullRead("SELECT COUNT(id) as sessions FROM site_views_static WHERE dia={$dia} AND mes={$mes} AND ano={$ano}");
                    if($Read->getResult()): echo $Read->getResult()[0]['sessions']; endif;
                    ?>
                </span>
            </div>
        </div>
    </div>
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <div class="info-box-content">
                <span class="info-box-text">Visualizações de Páginas</span>
                <span class="info-box-number"><?= $siteViews['pages']; ?></span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <div class="info-box-content">
                <span class="info-box-text">Total de Publicações</span>
                <span class="info-box-number"><?php
                    $Read = new Read();
                    $Read->ExeRead("xp_blog");

                    if($Read->getResult()): echo $Read->getRowCount(); endif;
                    ?></span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <div class="info-box-content">
                <span class="info-box-text">Total Newsletter</span>
                <span class="info-box-number"><?php
                    $Read = new Read();
                    $Read->FullRead("SELECT SUM(email) as commints FROM xp_newsletter");

                    if($Read->getResult()): echo $Read->getResult()[0]['commints']; endif;
                    ?></span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <div class="info-box-content">
                <span class="info-box-text">Visualizações de página</span>
                <span class="info-box-number"><?php
                    $ano = date('Y');

                    $Read->FullRead("SELECT SUM(pages) AS pag FROM site_views WHERE ano={$ano}");
                    if($Read->getResult()): echo $Read->getResult()[0]['pag']; endif;
                    ?></span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <div class="info-box-content">
                <span class="info-box-text">Usuários Online</span>
                <span class="info-box-number"><?php
                    $ano = date('Y');
                    $Read->FullRead("SELECT COUNT(session) AS pag FROM site_views_static WHERE ano={$ano}");
                    if($Read->getResult()): echo $Read->getResult()[0]['pag']; endif;
                    ?></span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <div class="info-box-content">
                <span class="info-box-text">Visualizações de Publicação</span>
                <span class="info-box-number"><?php
                    $ano = date('Y');
                    $Read->FullRead("SELECT SUM(views) AS pag FROM xp_blog WHERE ano={$ano}");
                    if($Read->getResult()): echo $Read->getResult()[0]['pag']; endif;
                    ?></span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <div class="info-box-content">
                <span class="info-box-text">Likes nas Publcações</span>
                <span class="info-box-number"><?php
                    $ano = date('Y');
                    $Read->FullRead("SELECT SUM(likes) AS pag FROM xp_blog WHERE ano={$ano}");
                    if($Read->getResult()): echo $Read->getResult()[0]['pag']; endif;
                    ?></span>
            </div>
        </div>
    </div>
</div>