<section class="ftco-section ftco-no-pt bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                <span class="subheading">Conheça os nossos serviços</span>
                <h2 class="mb-2">Serviços</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="carousel-car owl-carousel">
                    <?php
                    $table = "xp_create_all_in_one";
                    $local = "servico";

                    $Read = new Read();
                    $Read->ExeRead($table, "WHERE type=:ty ORDER BY RAND()", "ty={$local}");

                    if($Read->getResult()):
                        foreach ($Read->getResult() as $key):
                            ?>
                            <div class="item">
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
        </div>
    </div>
</section>