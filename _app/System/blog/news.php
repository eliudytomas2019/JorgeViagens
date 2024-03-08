<?php
$title = "Notícias - {$Ass['name']}";

$Seo = new SEO($title, $Ass['content'], "", "index, follow", "{$_SERVER['REQUEST_URI']}}", "Eliúdy Tomás");
$Seo->metaTags();

$yX = explode("-", $title);
include("_app/Include/Section.inc.php");
?>
    <section class="ftco-section">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <?php
                $status = 1;

                $posti = 0;
                $getPage = filter_input(INPUT_GET, 'page',FILTER_VALIDATE_INT);
                $Pager = new Pager("index.php?exe=blog/news&page=");
                $Pager->ExePager($getPage, 20);

                $Meses = ["", "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];

                $Read = new Read();
                $Read->ExeRead("xp_blog", "WHERE status=:i ORDER BY id DESC LIMIT :limit OFFSET :offset ", "i={$status}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

                if($Read->getResult()):
                    foreach ($Read->getResult() as $key):
                        ?>
                        <div class="col-md-12 text-center d-flex ftco-animate">
                            <div class="blog-entry justify-content-end mb-md-5">
                                <a href="<?= HOME ?>index.php?exe=blog/single_news&key_word=<?= $key['key_word']; ?>" class="block-20 img" style="background-image: url('uploads/<?php if($key['cover'] != ''): echo $key['cover']; else: echo 'default.jpg'; endif;  ?>');">
                                </a>
                                <div class="text px-md-5 pt-4">
                                    <div class="meta mb-3">
                                        <div><a href="<?= HOME ?>index.php?exe=blog/single_news&key_word=<?= $key['key_word']; ?>"><?php include("_app/HorOfDays.inc.php"); ?></a></div>
                                        <div><a href="<?= HOME ?>index.php?exe=blog/single_news&key_word=<?= $key['key_word']; ?>">Por <?php $Read->ExeRead("xp_author_and_test_and_team", "WHERE id=:i ", "i={$key['id_author']}"); if($Read->getResult()) echo $Read->getResult()[0]['name']; ?></a></div>
                                        <div><a href="<?= HOME ?>index.php?exe=blog/single_news&key_word=<?= $key['key_word']; ?>" class="meta-chat"><span class="icon-chat"></span> <?= $key['commint']; ?></a></div>
                                    </div>
                                    <h3 class="heading mt-2"><a href="<?= HOME ?>index.php?exe=blog/single_news&key_word=<?= $key['key_word']; ?>"><?= $key['title']; ?></a></h3>
                                    <p><?= Check::Words($key['content'], 22); ?></p>
                                    <p><a href="<?= HOME ?>index.php?exe=blog/single_news&key_word=<?= $key['key_word']; ?>" class="btn btn-primary">Lêr mais <span class="icon-long-arrow-right"></span></a></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    endforeach;
                endif;
                ?>
            </div>
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                        <?php
                            $Pager->ExePaginator("xp_blog", "WHERE status=:i ORDER BY id DESC ", "i={$status}");
                            echo $Pager->getPaginator();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include("_app/Include/Numbers.inc.php"); ?>