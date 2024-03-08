<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center heading-section ftco-animate">
                <h2 class="mb-3">Nossa Missão, Visão e Valores</h2>
            </div>
        </div>
        <div class="row">
            <?php
            $table = "xp_create_all_in_one";
            $local = "sobre";

            $Read = new Read();
            $Read->ExeRead($table, "WHERE id!=:id AND type=:ty ORDER BY id ASC  LIMIT 6", "id={$idX}&ty={$local}");

            if($Read->getResult()):
                foreach ($Read->getResult() as $key):
                    ?>
                    <div class="col-md-4">
                        <div class="services services-2 w-100 text-center">
                            <div class="icon d-flex align-items-center justify-content-center"><img style="max-width: 40px!important;max-height: 72px!important;" src="uploads/<?= $key['cover']; ?>"></div>
                            <div class="text w-100">
                                <h3 class="heading mb-2"><?= $key['title']; ?></h3>
                                <p><?= $key['content']; ?></p>
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