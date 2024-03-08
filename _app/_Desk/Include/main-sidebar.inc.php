<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="__admin.php?exe=default/home&lang=<?= $language; ?>" class="brand-link">
        <img src="uploads/<?= $Ass['cover']; ?>" alt="<?= $Ass['name']; ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?= $Ass['name']; ?></span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="uploads/<?php if(isset($userlogin['cover'])): echo $userlogin['cover']; else: echo "user.png"; endif; ?>" class="img-circle elevation-2" alt="<?= $userlogin['name']; ?>">
            </div>
            <div class="info">
                <a href="__admin.php?exe=users/profile" class="d-block"><?= $userlogin['name']." ".$userlogin['lastname']; ?></a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">
                    <?php
                        if($language == "pt"):
                            echo "Menu";
                        elseif($language == "fr"):
                            echo "Menu";
                        else:
                            echo "Menu";
                        endif;
                    ?>
                </li>
                <li class="nav-item">
                    <a href="__admin.php?exe=config/config_us&lang=<?= $language; ?>" class="nav-link">
                        <p>
                            <?php
                            if($language == "pt"):
                                echo "Configurações";
                            elseif($language == "fr"):
                                echo "Paramètres";
                            else:
                                echo "Settings";
                            endif;
                            ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="__admin.php?exe=config/seo&lang=<?= $language; ?>" class="nav-link">
                        <p>
                            SEO
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="__admin.php?exe=create/index_create&lang=<?= $language; ?>" class="nav-link">
                        <p>
                            <?php
                            if($language == "pt"):
                                echo "Criar Registros";
                            elseif($language == "fr"):
                                echo "Créer des enregistrements";
                            else:
                                echo "Create Records";
                            endif;
                            ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="__admin.php?exe=users/create_users&lang=<?= $language; ?>" class="nav-link">
                        <p>
                            <?php
                            if($language == "pt"):
                                echo "Criar Usuário";
                            elseif($language == "fr"):
                                echo "Créer un utilisateur";
                            else:
                                echo "Create User";
                            endif;
                            ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="__admin.php?exe=reports/index&lang=<?= $language; ?>" class="nav-link">
                        <p>
                            <?php
                            if($language == "pt"):
                                echo "Legislação & Relatórios";
                            elseif($language == "fr"):
                                echo "Législation et rapports";
                            else:
                                echo "Legislation & Reports";
                            endif;
                            ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="__admin.php?exe=author/index&lang=<?= $language; ?>" class="nav-link">
                        <p>
                            <?php
                            if($language == "pt"):
                                echo "Equipe, Autor & Testemunhos";
                            elseif($language == "fr"):
                                echo "Équipe, auteur et témoignages";
                            else:
                                echo "Team, Author & Testimonials";
                            endif;
                            ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="__admin.php?exe=numbers/index&lang=<?= $language; ?>" class="nav-link">
                        <p>
                            <?php
                            if($language == "pt"):
                                echo "Números";
                            elseif($language == "fr"):
                                echo "Nombres";
                            else:
                                echo "Numbers";
                            endif;
                            ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="__admin.php?exe=faqs/index&lang=<?= $language; ?>" class="nav-link">
                        <p>
                            <?php
                            if($language == "pt"):
                                echo "Faq's";
                            elseif($language == "fr"):
                                echo "Faq's";
                            else:
                                echo "Faq's";
                            endif;
                            ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="__admin.php?exe=gallery/index&lang=<?= $language; ?>" class="nav-link">
                        <p>
                            <?php
                            if($language == "pt"):
                                echo "Galeria";
                            elseif($language == "fr"):
                                echo "Galerie";
                            else:
                                echo "Gallery";
                            endif;
                            ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="__admin.php?exe=pricing/index&lang=<?= $language; ?>" class="nav-link">
                        <p>
                            <?php
                            if($language == "pt"):
                                echo "Preços";
                            elseif($language == "fr"):
                                echo "Tarifs";
                            else:
                                echo "Pricing";
                            endif;
                            ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="__admin.php?exe=category/index&lang=<?= $language; ?>" class="nav-link">
                        <p>
                            <?php
                            if($language == "pt"):
                                echo "Categorias";
                            elseif($language == "fr"):
                                echo "Catégories";
                            else:
                                echo "Category";
                            endif;
                            ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="__admin.php?exe=blog/index&lang=<?= $language; ?>" class="nav-link">
                        <p>
                            <?php
                            if($language == "pt"):
                                echo "Notícias";
                            elseif($language == "fr"):
                                echo "Nouvelles";
                            else:
                                echo "Blog";
                            endif;
                            ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="__admin.php?logoff=true&lang=<?= $language; ?>" class="nav-link">
                        <p>
                            <?php
                                if($language == "pt"):
                                    echo "Terminar a sessão";
                                elseif($language == "fr"):
                                    echo "Fin de séance";
                                else:
                                    echo "Log off";
                                endif;
                            ?>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>