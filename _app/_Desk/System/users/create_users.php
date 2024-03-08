<?php
if ($language == "pt"):
    $page = "Criar Usuário | {$Ass['name']}";
elseif ($language == "en"):
    $page = "Create User | {$Ass['name']}";
else:
    $page = "Créer un utilisateur | {$Ass['name']}";
endif;

include("_app/_Desk/Include/Seo.inc.php");
?>

<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title"><?php
            if($language == "pt"):
                echo "Criar Usuário";
            elseif($language == "fr"):
                echo "Créer un utilisateur";
            else:
                echo "Create User";
            endif;
            ?></h3>
    </div>

    <div class="card-body">
        <div class="row">
            <?php
            $ClienteData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if ($ClienteData && $ClienteData['SendPostFormL']):
                $Business = new ProjectXP();
                $Business->CreateUsers($ClienteData, $language);
                if($Business->getResult()):
                    WSError($Business->getError()[0], $Business->getError()[1]);
                else:
                    WSError($Business->getError()[0], $Business->getError()[1]);
                endif;
            endif;
            ?>
            <form method="post" action="" name="SendPostFormL" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Nome";
                                elseif($language == "fr"):
                                    echo "Nom";
                                else:
                                    echo "Name";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['name'])) echo $ClienteData['name']; ?>" name="name" id="name" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Sobrenome";
                                elseif($language == "fr"):
                                    echo "Nom de famille";
                                else:
                                    echo "Lastname";
                                endif;
                                ?></label>
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['lastname'])) echo $ClienteData['lastname']; ?>" name="lastname" id="lastname" placeholder=""/>
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
                            <input type="text" class="form-control" value="<?php if (!empty($ClienteData['username'])) echo $ClienteData['username']; ?>" name="username" id="username" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Senha";
                                elseif($language == "fr"):
                                    echo "Mot de passe";
                                else:
                                    echo "Password";
                                endif;
                                ?></label>
                            <input type="password" class="form-control" value="<?php if (!empty($ClienteData['password'])) echo $ClienteData['password']; ?>" name="password" id="password" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> <?php
                                if($language == "pt"):
                                    echo "Nível de acesso";
                                elseif($language == "fr"):
                                    echo "Niveau d'accès";
                                else:
                                    echo "Access level";
                                endif;
                                ?></label>
                            <select class="form-control" name="level" id="level">
                                <option value="1" <?php if (isset($ClienteData['level']) && $ClienteData['level'] == 1) echo 'selected="selected"'; ?>><?php if($language == "pt"):echo "Usuário";elseif($language == "fr"):echo "Utilisateur";else:echo "User";endif; ?></option>
                                <option value="2" <?php if (isset($ClienteData['level']) && $ClienteData['level'] == 2) echo 'selected="selected"'; ?>><?php if($language == "pt"):echo "Gestor";elseif($language == "fr"):echo "Directeur";else:echo "Manager";endif; ?></option>
                                <option value="3" <?php if (isset($ClienteData['level']) && $ClienteData['level'] == 3) echo 'selected="selected"'; ?>><?php if($language == "pt"):echo "Administrador";elseif($language == "fr"):echo "Administrateur";else:echo "Administrator";endif; ?></option>
                                <option value="4" <?php if (isset($ClienteData['level']) && $ClienteData['level'] == 4) echo 'selected="selected"'; ?>><?php if($language == "pt"):echo "Desenvolvidor";elseif($language == "fr"):echo "Développeur";else:echo "Developer";endif; ?></option>
                            </select>
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