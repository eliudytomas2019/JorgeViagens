<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.php"><img style="max-width: 220px!important;max-height: 160px!important;" src="uploads/<?php if(isset($Ass['cover']) && !empty($Ass['cover'])): echo $Ass['cover']; endif; ?>"/></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item li<?php if (in_array('home', $linkto)) echo ' active';  ?>"><a href="index.php?exe=default/home" class="nav-link">Início</a></li>
                <li class="nav-item li<?php if (in_array('about', $linkto)) echo ' active';  ?>"><a href="index.php?exe=about/about_us" class="nav-link">Sobre</a></li>
                <li class="nav-item li<?php if (in_array('services', $linkto)) echo ' active';  ?>"><a href="index.php?exe=services/services_us" class="nav-link">Serviços</a></li>
                <li class="nav-item li<?php if (in_array('blog', $linkto)) echo ' active';  ?>"><a href="index.php?exe=blog/news" class="nav-link">Blog</a></li>
                <li class="nav-item li<?php if (in_array('contact', $linkto)) echo ' active';  ?>"><a href="index.php?exe=contact/contact_us" class="nav-link">Contactos</a></li>
            </ul>
        </div>
    </div>
</nav>