<section class="ftco-counter ftco-section img bg-light" id="section-counter">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <?php
            $a = null;
            $table = "xp_numbers";
            $Arrau = ["", "Anos de experiência", "Carros", "Clientes Satisfeitos", "Viagens Realizadas"];
            $Read = new Read();
            $Read->ExeRead($table, "ORDER BY id ASC LIMIT 6");

            if($Read->getResult()):
                foreach ($Read->getResult() as $key):
                    $a += 1;
                    ?>
                    <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                        <div class="block-18">
                            <div class="text text-border d-flex align-items-center">
                                <strong class="number" data-number="<?= $key['number_1']; ?>">0</strong>
                                <span><?= $Arrau[$a]; ?></span>
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