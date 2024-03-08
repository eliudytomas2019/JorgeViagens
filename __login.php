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
            $page = "Login | {$Ass['name']}";
        elseif ($language == "en"):
            $page = "Login | {$Ass['name']}";
        else:
            $page = "Login | {$Ass['name']}";
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
                        echo "Preencha o formulário para fazer o login!";
                    elseif($language == "fr"):
                        echo "Remplissez le formulaire pour vous connecter !";
                    else:
                        echo "Fill out the form to login!";
                    endif;

                    $login = new Login(1);
                    if ($login->CheckLogin()):
                        header("Location: __admin.php?exe=default/home&lang={$language}");
                    endif;

                    $ClienteData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                    if ($ClienteData && $ClienteData['SendPostFormL']):
                        $user   = strip_tags(($_POST['user']));
                        $pass   = strip_tags(($_POST['pass']));

                        $Data = ['user' => $user, 'pass' => $pass];

                        $Login = new Login(1);
                        $Login->ExeLogin($Data);

                        if($Login->getResult()):
                            WSError($Login->getError()[0], $Login->getError()[1]);
                            $login = new Login(1);
                            if ($login->CheckLogin()):
                                header("Location: __admin.php?exe=default/home&lang={$language}");
                            endif;
                        else:
                            WSError($Login->getError()[0], $Login->getError()[1]);
                        endif;
                    endif;


                    $get = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
                    if (!empty($get)):
                        if ($get == 'restrito'):
                            WSError('<b>Ops:</b> Acesso negado. Favor efetue login para acessar o painel!+', WS_ALERT);
                        elseif ($get == 'logoff'):
                            WSError('<b>Sucesso ao deslogar:</b> Sua sessão foi finalizada. Volte sempre!', WS_ACCEPT);
                        elseif($get == 'logs'):
                            WSError("<b>Ops!</b> A sua conta encontra-se temporariamente suspença, contate o administrador.", WS_ERROR);
                        elseif($get == 'accounting'):
                            WSError("<b>Ops!</b> O Painel da empresa encontra-se suspenso, contate o Administrador.", WS_INFOR);
                        elseif($get == 'session_off'):
                            WSError("<b>Ops:</b> Não conseguimos estabelecer uma conexão segura, atualize a página e tente novamente!", WS_ALERT);
                        elseif($get == 'session_end'):
                            WSError("<b>Ops:</b> A sessão expirou, faça novamente o login!", WS_ALERT);
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
                <div class="input-group mb-3">
                    <input type="password" name="pass" id="pass" value="<?php if (!empty($ClienteData['pass'])) echo $ClienteData['pass']; ?>" class="form-control" placeholder="<?php
                    if($language == "pt"):
                        echo "Digite a Senha";
                    elseif($language == "fr"):
                        echo "Tapez le mot de passe";
                    else:
                        echo "Type the password";
                    endif;
                    ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <input type="submit" name="SendPostFormL" class="btn btn-primary btn-block" value="<?php
                        if($language == "pt"):
                            echo "Entrar";
                        elseif($language == "fr"):
                            echo "Entrer";
                        else:
                            echo "To enter";
                        endif;
                        ?>"/>
                    </div>
                </div>
            </form>

            <p class="mb-1">
                <a href="__forgot.php?lang=<?= $language; ?>"><?php
                    if($language == "pt"):
                        echo "Esqueci a minha senha";
                    elseif($language == "fr"):
                        echo "j'ai oublié mon mot de passe";
                    else:
                        echo "I forgot my password";
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