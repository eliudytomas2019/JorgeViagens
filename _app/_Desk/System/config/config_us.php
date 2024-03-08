<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title"> <?php
            if($language == "pt"):
                echo "Configurações";
            elseif($language == "fr"):
                echo "Paramètres";
            else:
                echo "Settings";
            endif;
            ?></h3>
    </div>

    <div class="card-body">
        <div class="row">
            <?php
                $ClienteData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                if ($ClienteData && $ClienteData['SendPostFormL']):
                    $file_one['logotype'] = ($_FILES['logotype']['tmp_name'] ? $_FILES['logotype'] : null);
                    $file_two['logotype_footer'] = ($_FILES['logotype_footer']['tmp_name'] ? $_FILES['logotype_footer'] : null);
                    $file_tree['icon'] = ($_FILES['icon']['tmp_name'] ? $_FILES['icon'] : null);

                    $Business = new ProjectXP();
                    $Business->Config($ClienteData, $file_one, $file_two, $file_tree, $language);
                    if($Business->getResult()):
                        WSError($Business->getError()[0], $Business->getError()[1]);
                    else:
                        WSError($Business->getError()[0], $Business->getError()[1]);
                    endif;
                else:
                    $status = 1;

                    $Read = new Read();
                    $Read->ExeRead("xp_config", "WHERE status=:i ", "i={$status}");

                    if($Read->getResult()):
                        $ClienteData = $Read->getResult()[0];
                    endif;
                endif;
            ?>
            <form method="post" action="" name="SendPostFormL" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Titulo do Site";
                                elseif($language == "fr"):
                                    echo "Titre du site";
                                else:
                                    echo "Site Title";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['name'])) echo $ClienteData['name']; ?>" name="name" id="name" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Telefone";
                                elseif($language == "fr"):
                                    echo "Téléphone";
                                else:
                                    echo "Telephone";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['telefone'])) echo $ClienteData['telefone']; ?>" name="telefone" id="telefone" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Email";
                                elseif($language == "fr"):
                                    echo "Email";
                                else:
                                    echo "Email";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['email'])) echo $ClienteData['email']; ?>" name="email" id="email" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Endereço";
                                elseif($language == "fr"):
                                    echo "Adresse";
                                else:
                                    echo "Address";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['endereco'])) echo $ClienteData['endereco']; ?>" name="endereco" id="endereco" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Facebook";
                                elseif($language == "fr"):
                                    echo "Facebook";
                                else:
                                    echo "Facebook";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['facebook'])) echo $ClienteData['facebook']; ?>" name="facebook" id="facebook" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Twitter";
                                elseif($language == "fr"):
                                    echo "Twitter";
                                else:
                                    echo "Twitter";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['twitter'])) echo $ClienteData['twitter']; ?>" name="twitter" id="twitter" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Linkedin";
                                elseif($language == "fr"):
                                    echo "Linkedin";
                                else:
                                    echo "Linkedin";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['linkedin'])) echo $ClienteData['linkedin']; ?>" name="linkedin" id="linkedin" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "WhatsApp";
                                elseif($language == "fr"):
                                    echo "WhatsApp";
                                else:
                                    echo "WhatsApp";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['whatsapp'])) echo $ClienteData['whatsapp']; ?>" name="whatsapp" id="whatsapp" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Instagram";
                                elseif($language == "fr"):
                                    echo "Instagram";
                                else:
                                    echo "Instagram";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['instagram'])) echo $ClienteData['instagram']; ?>" name="instagram" id="instagram" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "YouTube";
                                elseif($language == "fr"):
                                    echo "YouTube";
                                else:
                                    echo "YouTube";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['youtube'])) echo $ClienteData['youtube']; ?>" name="youtube" id="youtube" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Logotipo do Cabeçalho";
                                elseif($language == "fr"):
                                    echo "Logo d'en-tête";
                                else:
                                    echo "Header Logo";
                                endif;
                                ?></label>
                            <input type="file" class="form-control" value="<?php if (!empty($ClienteData['logotype'])) echo $ClienteData['logotype']; ?>" name="logotype" id="logotype" accept=".jpeg, .png, .jpg" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Logotipo do Rodapé";
                                elseif($language == "fr"):
                                    echo "Logo de pied de page";
                                else:
                                    echo "Footer Logo";
                                endif;
                                ?></label>
                            <input type="file" class="form-control" value="<?php if (!empty($ClienteData['logotype_footer'])) echo $ClienteData['logotype_footer']; ?>" accept=".jpeg, .png, .jpg" name="logotype_footer" id="logotype_footer" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Icon";
                                elseif($language == "fr"):
                                    echo "icône";
                                else:
                                    echo "icon";
                                endif;
                                ?></label>
                            <input type="file" class="form-control" value="<?php if (!empty($ClienteData['icon'])) echo $ClienteData['icon']; ?>" accept=".jpeg, .png, .jpg" name="icon" id="icon" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Host-email";
                                elseif($language == "fr"):
                                    echo "E-mail de l'hôte";
                                else:
                                    echo "Host-email";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['email_host'])) echo $ClienteData['email_host']; ?>" name="email_host" id="email_host" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Email-senha";
                                elseif($language == "fr"):
                                    echo "Mot de passe de l'email";
                                else:
                                    echo "Email-password";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['email_senha'])) echo $ClienteData['email_senha']; ?>" name="email_senha" id="email_senha" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Email-porta";
                                elseif($language == "fr"):
                                    echo "Port de messagerie";
                                else:
                                    echo "Email-port";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['email_porta'])) echo $ClienteData['email_porta']; ?>" name="email_porta" id="email_porta" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Nome do usuário do Email";
                                elseif($language == "fr"):
                                    echo "Nom d'utilisateur par e-mail";
                                else:
                                    echo "Email username";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['email_name'])) echo $ClienteData['email_name']; ?>" name="email_name" id="email_name" placeholder=""/>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="form-footer">
                        <input type="submit" name="SendPostFormL" class="btn btn-primary" value="<?php
                        if($language == "pt"):
                            echo "Guardar";
                        elseif($language == "fr"):
                            echo "Sauvegarder";
                        else:
                            echo "Save";
                        endif;
                        ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
