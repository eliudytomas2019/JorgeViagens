<?php
ob_start();
require_once("Config.inc.php");
Check::UserOnline();

$sessao = new Session();
$level = $_SESSION['userlogin']['level'];
if(!isset($_SESSION["userlogin"])):
    unset($_SESSION['userlogin']);
    header('Location: __login.php?corn=restrito&lang='.$language);
else:
    if($level >= 1):
        $Login = new Login(1);
        if(!isset($_SESSION['userlogin'])):
            unset($_SESSION['userlogin']);
            header('Location: __login.php?corn=restrito&lang='.$language);
        else:
            $userlogin = $_SESSION['userlogin'];
            $id_user = $userlogin['id'];
        endif;
    else:
        if($level < 1):
            header("location: __login.php?lang=".$language);
        endif;
    endif;
endif;

$level = $_SESSION['userlogin']['level'];
$useronline = $_SESSION['userlogin'];
$id_user = $_SESSION['userlogin']['id'];

$logoff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);
$getexe = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
$lock = filter_input(INPUT_GET, 'lock', FILTER_DEFAULT);

if($logoff):
    unset($_SESSION['userlogin']);
    header('Location: __login.php?logoff&lang='.$language);
endif;

$Read = new Read();
$Read->ExeRead("xp_config");
if($Read->getResult()): $Ass = $Read->getResult()[0]; else: $Ass = null; endif;

$st1 = 0;
$Read = new Read();
$Read->ExeRead("xp_blog", "WHERE status=:st1", "st1={$st1}");

if($Read->getResult()):
    foreach ($Read->getResult() as $key):
        if($key['data'] == date('Y-m-d') && date('H:i') == $key['hora']):
            $Nerd = new ProjectXP();
            $Nerd->StatusNews($key['id']);

            if(!$Nerd->getResult()):
                WSError($Nerd->getError()[0], $Nerd->getError()[1]);
            endif;
        elseif(date('Y-m-d') > $key['data']):
            $Nerd = new ProjectXP();
            $Nerd->StatusNews($key['id']);

            if(!$Nerd->getResult()):
                WSError($Nerd->getError()[0], $Nerd->getError()[1]);
            endif;
        endif;
    endforeach;
endif;

$Meses = ["", "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
require_once("_app/C-137/Charts.01.Nerd.inc.php");
require_once("_app/C-137/Charts.02.Nerd.inc.php");
require_once("_app/C-137/Charts.03.Nerd.inc.php");
require_once("_app/C-137/Charts.04.Nerd.inc.php");
require_once("_app/C-137/Charts.05.Nerd.inc.php");
?>
<!DOCTYPE html>
<html lang="<?= $language; ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="text/html" href="uploads/<?= $Ass['icon']; ?>">

    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

    <link rel="stylesheet" href="_app/css/reset.css"/>
    <script src="tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <?php
        if (isset($getexe)):
            $linkto = explode('/', $getexe);
        else:
            header("Location: __admin.php?exe=default/home&lang={$language}");
        endif;

        include("_app/_Desk/Include/main-header.inc.php");
        include("_app/_Desk/Include/main-sidebar.inc.php");
    ?>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">

            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <?php
                    if(!empty($_GET['exe'])):
                        $includepatch = __DIR__.DIRECTORY_SEPARATOR."_app".DIRECTORY_SEPARATOR."_Desk".DIRECTORY_SEPARATOR."System".DIRECTORY_SEPARATOR. strip_tags(trim($_GET['exe']).'.php');
                    else:
                        $includepatch = __DIR__.DIRECTORY_SEPARATOR."_app".DIRECTORY_SEPARATOR."_Desk".DIRECTORY_SEPARATOR."System".DIRECTORY_SEPARATOR."default".DIRECTORY_SEPARATOR. "home.php";
                    endif;

                    if(file_exists($includepatch)):
                        require($includepatch);
                    else:
                        require("_app/_Desk/Include/404.inc.php");
                    endif;
                ?>
            </div>
        </section>
    </div>
    <?php include("_app/_Desk/Include/main-footer.inc.php"); ?>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="plugins/sparklines/sparkline.js"></script>
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="dist/js/adminlte.js"></script>
<script src="dist/js/demo.js"></script>
<script src="dist/js/pages/dashboard.js"></script>
</body>
</html>
<?php
require_once("_app/C-137/NerdCharts.01.inc.php");

ob_end_flush();