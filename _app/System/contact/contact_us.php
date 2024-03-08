<?php
$title = "Contactos - {$Ass['name']}";

$Seo = new SEO($title, $Ass['content'], "", "index, follow", "{$_SERVER['REQUEST_URI']}}", "Eliúdy Tomás");
$Seo->metaTags();

$yX = explode("-", $title);
include("_app/Include/Section.inc.php");
?>

<section class="ftco-section contact-section">
    <div class="container">
        <div class="row d-flex mb-5 contact-info">
            <div class="col-md-4">
                <div class="row mb-5">
                    <div class="col-md-12">
                        <div class="border w-100 p-4 rounded mb-2 d-flex">
                            <div class="icon mr-3">
                                <span class="icon-map-o"></span>
                            </div>
                            <p><span>Endereço:</span> <?= $Ass['endereco']; ?></p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="border w-100 p-4 rounded mb-2 d-flex">
                            <div class="icon mr-3">
                                <span class="icon-mobile-phone"></span>
                            </div>
                            <p><span>Telefone:</span> <a href="#"><?= $Ass['telefone']; ?></a></p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="border w-100 p-4 rounded mb-2 d-flex">
                            <div class="icon mr-3">
                                <span class="icon-envelope-o"></span>
                            </div>
                            <p><span>Email:</span> <a href="mailto:<?= $Ass['email']; ?>"><?= $Ass['email']; ?></a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 block-9 mb-md-5">
                <?php
                use PHPMailer\PHPMailer\PHPMailer;
                use PHPMailer\PHPMailer\SMTP;
                use PHPMailer\PHPMailer\Exception;

                require './vendor/autoload.php';

                $SendPostFormL = filter_input(INPUT_POST, "SendPostFormL");
                if(isset($SendPostFormL)):
                    $ClienteData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                    if ($ClienteData && $ClienteData['SendPostFormL']):
                        $name = strip_tags(trim(htmlspecialchars($ClienteData['name'])));
                        $emails = strip_tags(trim(htmlspecialchars($ClienteData['RemitenteEmail'])));
                        $subject = strip_tags(trim(htmlspecialchars($ClienteData['subject'])));
                        $message = strip_tags(trim(htmlspecialchars($ClienteData['message'])));

                        if(empty($name) || empty($emails) || empty($subject) || empty($message)):
                            WSError("Oops: preencha todos os campos para prosseguir com o processo!", WS_ALERT);
                        elseif(!Check::Email($emails)):
                            WSError("Oops: introduza um endereço de e-mail válido!", WS_INFOR);
                        else:
                            $mail = new PHPMailer(true);

                            try{
                                $mail->CharSet = 'UTF-8';
                                $mail->isSMTP();
                                $mail->Host       = MailHost;
                                $mail->SMTPAuth   = true;
                                $mail->Username   =  Email;
                                $mail->Password   = SenhaEmail;
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                                $mail->Port       = PortaEmail;

                                $mail->setFrom("{$ClienteData['RemitenteEmail']}", "{$ClienteData['name']}");
                                $mail->addAddress(Email, EmailName);

                                $mail->isHTML(true);
                                $mail->Subject = "{$ClienteData['subject']}";
                                $mail->Body    = "{$ClienteData['message']}";

                                $mail->send();
                                WSError("Recebemos o seu email, entraremos em contacto o mais breve possível!", WS_ACCEPT);
                            } catch(Exception $e){
                                WSError("Aconteceu um erro inesperado ao enviar o E-mail: {$mail->ErrorInfo}", WS_ERROR);
                            }
                        endif;
                    endif;
                endif;
                ?>
                <form action="#getResult" method="post" enctype="multipart/form-data" class="bg-light p-5 contact-form">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nome" value="<?php if (!empty($ClienteData['name'])) echo $ClienteData['name']; ?>" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Objectivo" value="<?php if (!empty($ClienteData['subject'])) echo $ClienteData['subject']; ?>" name="subject" id="subject">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email" value="<?php if (!empty($ClienteData['RemitenteEmail'])) echo $ClienteData['RemitenteEmail']; ?>" name="RemitenteEmail" id="RemitenteEmail">
                    </div>
                    <div class="form-group">
                        <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Message"><?php if (!empty($ClienteData['message'])) echo $ClienteData['message']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary py-3 px-5" type="submit" name="SendPostFormL" value="Enviar"/>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

<?php include("_app/Include/Numbers.inc.php"); ?>