<?php
    ob_start();
    require_once("Config.inc.php");
    $sessao = new Session;
    Check::UserOnline();

    $logoff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);
    $getexe = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
    $lock = filter_input(INPUT_GET, 'lock', FILTER_DEFAULT);

    $Read = new Read();
    $Read->ExeRead("xp_config");
    if($Read->getResult()): $Ass = $Read->getResult()[0]; else: $Ass = null; endif;
?>
<!DOCTYPE html>
<html lang="<?= $language; ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="_app/css/reset.css"/>
    <link rel="stylesheet" href="_app/css/preview.css"/>
</head>
<body>
<?php
    if (isset($getexe)):
        $linkto = explode('/', $getexe);
    else:
        Header("Location: index.php?exe=default/home");
    endif;

    if(!empty($_GET['exe'])):
        $includepatch = __DIR__.DIRECTORY_SEPARATOR."_app".DIRECTORY_SEPARATOR."System".DIRECTORY_SEPARATOR. strip_tags(trim($_GET['exe']).'.php');
    else:
        $includepatch = __DIR__.DIRECTORY_SEPARATOR."_app".DIRECTORY_SEPARATOR."System".DIRECTORY_SEPARATOR."default".DIRECTORY_SEPARATOR. "home.php";
    endif;

    if(file_exists($includepatch)):
        include("_app/Include/navbar.inc.php");

        include($includepatch);

        include("_app/Include/footer.inc.php");
    else:
        include("_app/404.inc.php");
    endif;

?>

<script src="js/jquery.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/jquery.timepicker.min.js"></script>
<script src="js/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="js/google-map.js"></script>
<script src="js/main.js"></script>
</body>
</html>
<?php
ob_end_flush();