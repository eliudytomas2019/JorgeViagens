<?php
ob_start();
require_once("Config.inc.php");
$sessao = new Session;
Check::UserOnline();

$Read = new Read();
$Read->ExeRead("xp_config");
if($Read->getResult()): $Ass = $Read->getResult()[0]; else: $Ass = null; endif;
?>
    <!DOCTYPE html>
    <html lang="<?= $language; ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="text/html" href="uploads/<?= $Ass['icon']; ?>">

        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <link rel="stylesheet" href="dist/css/adminlte.min.css">
        <link rel="stylesheet" href="_app/css/reset.css"/>

        <?php
        if ($language == "pt"):
            $page = "Recuperação de Senha | {$Ass['name']}";
        elseif ($language == "en"):
            $page = "Password recovery | {$Ass['name']}";
        else:
            $page = "Récupération de mot de passe | {$Ass['name']}";
        endif;

        include("_app/_Desk/Include/Seo.inc.php");
        ?>
    </head>
    <body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="__login.php?lang=<?= $language; ?>" class="h1"><img style="max-height: 120px!important;max-width: 220px!important;" src="uploads/<?php if(isset($Ass['cover']) && !empty($Ass['cover'])): echo $Ass['cover']; endif; ?>"></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">
                    <?php
                        if($language == "pt"):
                            echo "Preencha o formulário para recuperar a senha!";
                        elseif($language == "fr"):
                            echo "Remplissez le formulaire pour récupérer votre mot de passe !";
                        else:
                            echo "Fill in the form to recover your password";
                        endif;

                        $ClienteData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                        if (isset($ClienteData) && $ClienteData['SendPostFormL']):
                            if(empty($ClienteData['user'])):
                                WSError("Preencha o campo Email para finalizar o processo!", WS_ALERT);
                            elseif(!Check::Email($ClienteData['user'])):
                                WSError("Introduza endereço de Email válido!", WS_INFOR);
                            else:
                                $Read = new Read();
                                $Read->ExeRead("xp_users", "WHERE username=:i", "i={$ClienteData['user']}");

                                if($Read->getResult()):
                                    $Data = $Read->getResult()[0];
                                    include("_app/_Desk/Include/forgot-mailer.inc.php");
                                else:
                                    WSError("Não encontramos nenhum usuário que corresponde ao endereço de Email digitado!", WS_ERROR);
                                endif;
                            endif;
                        endif;
                    ?>
                </p>

                <form action="" method="POST" name="SendPostFormL">
                    <div class="input-group mb-3">
                        <input type="text" name="user" id="user" value="<?php if (!empty($ClienteData['user'])) echo $ClienteData['user']; ?>" class="form-control" placeholder="<?php
                        if($language == "pt"):
                            echo "Digite o e-mail";
                        elseif($language == "fr"):
                            echo "Entrez l'e-mail";
                        else:
                            echo "Enter email";
                        endif;
                        ?>" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <input type="submit" name="SendPostFormL" class="btn btn-primary btn-block" value="<?php
                            if($language == "pt"):
                                echo "Recuperar";
                            elseif($language == "fr"):
                                echo "S'en remettre";
                            else:
                                echo "To recover";
                            endif;
                            ?>"/>
                        </div>
                    </div>
                </form>

                <p class="mb-1">
                    <a href="__login.php?lang=<?= $language; ?>"><?php
                        if($language == "pt"):
                            echo "Voltar a tela de Login";
                        elseif($language == "fr"):
                            echo "Revenir à l'écran de connexion";
                        else:
                            echo "Return to Login screen";
                        endif;
                        ?></a>
                </p>
            </div>
        </div>
    </div>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
    </body>
    </html>
<?php
ob_end_flush();