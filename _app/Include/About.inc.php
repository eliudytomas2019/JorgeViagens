<?php
$table = "xp_create_all_in_one";
$local = "sobre";
$idX = null;

$Read = new Read();
$Read->ExeRead($table, "WHERE type=:ty ORDER BY id ASC  LIMIT 1", "ty={$local}");

if($Read->getResult()):
    foreach ($Read->getResult() as $key):
        $idX = $key['id'];
        ?>
        <section class="ftco-section ftco-about">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url(uploads/<?= $key['cover']; ?>);">
                    </div>
                    <div class="col-md-6 wrap-about ftco-animate">
                        <div class="heading-section heading-section-white pl-md-5">
                            <span class="subheading">Sobre</span>
                            <h2 class="mb-4"><?= $key['title']; ?></h2>
                            <?= $key['content']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
    endforeach;
endif;