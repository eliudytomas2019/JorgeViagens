<?php
if ($language == "pt"):
    $page = "404 | {$Ass['name']}";
elseif ($language == "en"):
    $page = "404 | {$Ass['name']}";
else:
    $page = "404 | {$Ass['name']}";
endif;

include("_app/_Desk/Include/Seo.inc.php");
?>

<div class="error-page">
    <h2 class="headline text-warning"> 404</h2>

    <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-warning"></i> <?php
            if($language == "pt"):
                echo "Ops! Página não encontrada.";
            elseif($language == "fr"):
                echo "Oops! Page non trouvée.";
            else:
                echo "Oops! Page not found.";
            endif;
            ?></h3>
        <p>
            <?php
            if($language == "pt"):
                echo "Não foi possível encontrar a página que você procurava.
            Enquanto isso, você pode <a href='__admin.php?exe=default/home&lang={$language}'>retornar ao painel</a> ou tentar usar o formulário de pesquisa.";
            elseif($language == "fr"):
                echo "Nous n'avons pas pu trouver la page que vous recherchiez.
            En attendant, vous pouvez <a href='__admin.php?exe=default/home&lang={$language}'>revenir au tableau de bord</a> ou essayer d'utiliser le formulaire de recherche.";
            else:
                echo "We could not find the page you were looking for.
            Meanwhile, you may <a href='__admin.php?exe=default/home&lang={$language}'>return to dashboard</a> or try using the search form.";
            endif;
            ?>
        </p>
    </div>
</div>