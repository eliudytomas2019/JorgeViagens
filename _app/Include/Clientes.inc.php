<div class="client-section spad">
    <div class="container">
        <div id="client-carousel" class="client-slider">
            <?php
                $Read = new Read();
                $Read->ExeRead("xp_gallery");

                if($Read->getResult()):
                    foreach ($Read->getResult() as $key):
                        ?>
                        <div class="single-brand">
                            <a href="#">
                                <img src="uploads/<?= $key['cover']; ?>" style="max-width: 159px!important;max-height: 80px!important;" alt="">
                            </a>
                        </div>
                        <?php
                    endforeach;
                endif;
            ?>
        </div>
    </div>
</div>