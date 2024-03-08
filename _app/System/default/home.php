<?php
$title = "Início - {$Ass['name']}";

$Seo = new SEO($title, $Ass['content'], "", "index, follow", "{$_SERVER['REQUEST_URI']}}", "Eliúdy Tomás");
$Seo->metaTags();
?>

<?php
$table = "xp_create_all_in_one";
$local = "home";

$Read = new Read();
$Read->ExeRead($table, "WHERE type=:ty ORDER BY id DESC LIMIT 1", "ty={$local}");

if($Read->getResult()):
    foreach ($Read->getResult() as $key):
        ?>
        <div class="hero-wrap ftco-degree-bg" style="background-image: url('uploads/<?= $key['cover']; ?>');" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
                    <div class="col-lg-8 ftco-animate">
                        <div class="text w-100 text-center mb-md-5 pb-md-5">
                            <h1 class="mb-4"><?= $key['title']; ?></h1>
                            <p style="font-size: 18px;"><?= $key['content']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    endforeach;
endif;

include("_app/Include/About.inc.php");
include("_app/Include/Missao.inc.php");
include("_app/Include/Services.inc.php");
include("_app/Include/Facha.inc.php");
include("_app/Include/Testemunhos.inc.php");
include("_app/Include/Clientes.inc.php");
?>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">Notícias</span>
                <h2>Notícias Recentes</h2>
            </div>
        </div>
        <div class="row d-flex">
            <?php
                $status = 1;

                $posti = 0;
                $getPage = filter_input(INPUT_GET, 'page',FILTER_VALIDATE_INT);
                $Pager = new Pager("index.php?exe=blog/news&page=");
                $Pager->ExePager($getPage, 3);

                $Meses = ["", "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];

                $Read = new Read();
                $Read->ExeRead("xp_blog", "WHERE status=:i ORDER BY id DESC LIMIT :limit OFFSET :offset ", "i={$status}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

                if($Read->getResult()):
                    foreach ($Read->getResult() as $key):
                        ?>
                        <div class="col-md-4 d-flex ftco-animate">
                            <div class="blog-entry justify-content-end">
                                <a href="<?= HOME ?>index.php?exe=blog/single_news&key_word=<?= $key['key_word']; ?>" class="block-20" style="background-image: url('uploads/<?php if($key['cover'] != ''): echo $key['cover']; else: echo 'default.jpg'; endif;  ?>');">
                                </a>
                                <div class="text pt-4">
                                    <div class="meta mb-3">
                                        <div><a href="<?= HOME ?>index.php?exe=blog/single_news&key_word=<?= $key['key_word']; ?>"><?php include("_app/HorOfDays.inc.php"); ?></a></div>
                                        <div><a href="<?= HOME ?>index.php?exe=blog/single_news&key_word=<?= $key['key_word']; ?>">Por <?php $Read->ExeRead("xp_author_and_test_and_team", "WHERE id=:i ", "i={$key['id_author']}"); if($Read->getResult()) echo $Read->getResult()[0]['name']; ?></a></div>
                                        <div><a href="<?= HOME ?>index.php?exe=blog/single_news&key_word=<?= $key['key_word']; ?>" class="meta-chat"><span class="icon-chat"></span> <?= $key['commint']; ?></a></div>
                                    </div>
                                    <h3 class="heading mt-2"><a href="#"><?= $key['title']; ?></a></h3>
                                    <p><a href="<?= HOME ?>index.php?exe=blog/single_news&key_word=<?= $key['key_word']; ?>" class="btn btn-primary">Lêr mais...</a></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    endforeach;
                endif;
            ?>
        </div>
    </div>
</section>

<?php include("_app/Include/Numbers.inc.php"); ?>