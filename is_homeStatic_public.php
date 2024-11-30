<?php 
    include_once PLX_CORE.'lib/class.plx.token.php';
    include(PLX_CORE.'/lang/'.$plxShow->plxMotor->aConf['default_lang'].'/admin.php');
    # Control du token du formulaire
    plxToken::validateFormToken($_POST);
    # demande de connexion
    if (!empty($_POST['login']) and !empty($_POST['password'])) {
        $connected = false;
        foreach ($plxShow->plxMotor->aUsers as $userid => $user) {
            if ($_POST['login'] == $user['login'] and sha1($user['salt'] . md5($_POST['password'])) === $user['password'] and $user['active'] and !$user['delete']) {
                $_SESSION['user'] = $userid;
                $_SESSION['profil'] = $user['profil'];
                $_SESSION['hash'] = plxUtils::charAleatoire(10);
                $_SESSION['domain'] = $session_domain;
                $_SESSION['admin_lang'] = $user['lang'];
                $connected = true;
                break;
            }
        }
        if ($connected) {
            header('Location: ' .$_SERVER['PHP_SELF']);
            exit;
            } else {
            $css = 'alert red';
            echo '<p class="'.$css.'>'.$LANG['L_ERR_WRONG_PASSWORD'].'</p>';
        }
    }
    $go=false;
    if($plxShow->plxMotor->mode == 'static'  && $plxShow->plxMotor->aConf['homestatic'] == str_pad($plxShow->staticId(),3,'0',STR_PAD_LEFT)) $go = true;


    # affichage formumaire si non connecter
    if (!isset($_SESSION['profil']) && $go != true ) { 

    ?>

    <main class="main">     
        <div class="container">         
            <div class="grid">              
                <div class="content col sml-12">
                    <article class="article" >
                        <header>
                            <h2>
                                <?php 

                                    echo $LANG['L_AUTH_PAGE_TITLE'];
                                ?>
                            </h2>
                        </header>                       
                        <form 
                        method="post" id="form_auth">
                            <fieldset>
                                <?php echo plxToken::getTokenPostMethod() ?>
                                <div class="grid">
                                    <div class="col sml-12">
                                        <label><?= $LANG['L_AUTH_LOGIN_FIELD'] ?></label>
                                    <input id="id_login" name="login" type="text" autofocus class="full-width" placeholder="Login de connexion" size="10" maxlength="255"/>                                </div>
                                </div>
                                <div class="grid">
                                    <div class="col sml-12">
                                        <label><?= $LANG['L_AUTH_PASSWORD_FIELD'] ?></label>
                                    <input id="id_password" name="password" type="password" class="full-width" placeholder="Mot de passe" size="10" maxlength="255"/>                                </div>
                                </div>
                                <div class="grid">
                                    <div class="col sml-12">
                                        <small><a href="/core/admin/auth.php?action=lostpassword" target="_blank"><?= $LANG['L_LOST_PASSWORD'] ?></a></small>
                                    </div>
                                </div>
                                <div class="grid">
                                    <div class="col sml-12 text-center">
                                        <input class="blue" type="submit" value="Valider"/>
                                    </div>
                                </div>
                            </fieldset>
                        </form>';
                    </article>
                </div>
            </div>
        </div>
    </main>
    <?php 
        include __DIR__.'/footer.php'; 
        exit;
    }
