<footer class="ftco-footer ftco-bg-dark ftco-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2"><a href="#" class="logo"><img style="max-width: 320px!important;max-height: 180px!important;" src="uploads/<?php if(isset($Ass['cover_rodape']) && !empty($Ass['cover_rodape'])): echo $Ass['cover_rodape']; endif; ?>"/></a></h2>
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                        <li class="ftco-animate"><a href="<?= $Ass['twitter']; ?>" target="_blank"><span class="icon-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="<?= $Ass['facebook']; ?>" target="_blank"><span class="icon-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="<?= $Ass['instagram']; ?>" target="_blank"><span class="icon-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4 ml-md-5">
                    <h2 class="ftco-heading-2">Menu</h2>
                    <ul class="list-unstyled">
                        <li><a href="index.php?exe=default/home" class="py-2 d-block">Início</a></li>
                        <li><a href="index.php?exe=about/about_us" class="py-2 d-block">Sobre</a></li>
                        <li><a href="index.php?exe=services/services_us" class="py-2 d-block">Serviços</a></li>
                        <li><a href="index.php?exe=blog/news" class="py-2 d-block">Blog</a></li>
                        <li><a href="index.php?exe=contact/contact_us" class="py-2 d-block">Contactos</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">SERVIÇOS</h2>
                    <ul class="list-unstyled">
                        <li><a href="https://s4kids.ao" class="py-2 d-block">S4KIDS</a></li>
                        <li><a href="https://kwanzar.ao" class="py-2 d-block">KWANZAR</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Contactos</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon icon-map-marker"></span><span class="text"><?= $Ass['endereco']; ?></span></li>
                            <li><a href="#"><span class="icon icon-phone"></span><span class="text"><?= $Ass['telefone']; ?></span></a></li>
                            <li><a href="#"><span class="icon icon-envelope"></span><span class="text"><?= $Ass['email']; ?></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">

                <p>
                    Copyright &copy; <?= date('Y'); ?> Todos os direitos reservados | Desenvolvido por <a href="https://kwanzar.ao" target="_blank">Kwanzar</a>
                </p>
            </div>
        </div>
    </div>
</footer>

<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
