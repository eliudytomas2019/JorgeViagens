<section class="ftco-section testimony-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center heading-section ftco-animate">
                <span class="subheading">O que eles dizem sobre nós</span>
                <h2 class="mb-3">Testemunhos</h2>
            </div>
        </div>
        <div class="row ftco-animate">
            <div class="col-md-12">
                <div class="carousel-testimony owl-carousel ftco-owl">
                    <?php
                    $table = "xp_author_and_test_and_team";
                    $local = "testimonial";

                    $Read = new Read();
                    $Read->ExeRead($table, "WHERE type=:ty ORDER BY RAND()", "ty={$local}");

                    if($Read->getResult()):
                        foreach ($Read->getResult() as $key):
                            ?>
                            <div class="item">
                                <div class="testimony-wrap rounded text-center py-4 pb-5">
                                    <div class="user-img mb-2" style="background-image: url(uploads/<?php if(empty($key['cover']) || !isset($key['cover'])): echo "user.png"; else: echo $key['cover']; endif; ?>">
                                    </div>
                                    <div class="text pt-4">
                                        <p class="mb-4"><?= $key['content']; ?></p>
                                        <p class="name"><?= $key['name']; ?></p>
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