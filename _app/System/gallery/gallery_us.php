<?php
$title = "Nossa Frota - {$Ass['name']}";

$Seo = new SEO($title, $Ass['content'], "", "index, follow", "{$_SERVER['REQUEST_URI']}}", "Eliúdy Tomás");
$Seo->metaTags();

$yX = explode("-", $title);
include("_app/Include/Section.inc.php");

?>
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            <?php
            $table = "xp_create_all_in_one";
            $local = "produto";

            $Read = new Read();
            $Read->ExeRead($table, "WHERE type=:ty ORDER BY RAND()", "ty={$local}");

            if($Read->getResult()):
                foreach ($Read->getResult() as $key):
                    ?>
                    <div class="col-md-4">
                        <div class="car-wrap rounded ftco-animate">
                            <div class="img rounded d-flex align-items-end" style="background-image: url(uploads/<?= $key['cover']; ?>);">
                            </div>
                            <div class="text">
                                <h2 class="mb-0"><a href="#"><?= $key['title']; ?></a></h2>
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
<?php
include("_app/Include/Clientes.inc.php");
include("_app/Include/Numbers.inc.php");
?>