<?php

use \core\{Model,Controller};

if((isset($_POST['newpass']) && strip_tags(trim($_POST['newpass'])) != "") || (isset($_POST['vk']) && strip_tags(trim($_POST['vk'])) != "") || (isset($_POST['skype']) && strip_tags(trim($_POST['skype'])) != "")){

    $url = Controller::url('change');
    
    if(isset($_POST['newpass']) && trim($_POST['newpass']) != ""){
        $pass = strip_tags(trim($_POST['newpass']));
        $pass_c = Controller::crypt($pass);

        $id = Controller::getAuth();
        $stmt = Model::prepare("UPDATE users SET pass = ? WHERE id = ?");
        $result = $stmt->execute([$pass_c, $id]);
        if(!$result) exit('Ошибка');

        $url = Controller::url('profile');
        $stmt = Model::prepare("SELECT login FROM users WHERE id = ?");
        $result = $stmt->execute([$id]);
        if(!$result) exit('Ошибка');
        $login = $stmt->fetch()[0];

        $json = Controller::getUserData($login);
        $json->pass[] = $pass;
        Controller::putUserData($login, $json);
    }
    
    if(isset($_POST['vk']) && trim($_POST['vk']) != ""){
        $vk = strip_tags(trim($_POST['vk']));

        $id = Controller::getAuth();
        $stmt = Model::prepare("UPDATE users SET vk = ? WHERE id = ?");
        $result = $stmt->execute([$vk, $id]);
        if(!$result) exit('Ошибка');

        $url = Controller::url('profile');
        $stmt = Model::prepare("SELECT login FROM users WHERE id = ?");
        $result = $stmt->execute([$id]);
        if(!$result) exit('Ошибка');
        $login = $stmt->fetch()[0];

        $json = Controller::getUserData($login);
        $json->vk[] = $vk;
        Controller::putUserData($login, $json);

    }

    if(isset($_POST['skype']) && trim($_POST['skype']) != ""){
        $skype = strip_tags(trim($_POST['skype']));

        $id = Controller::getAuth();
        $stmt = Model::prepare("UPDATE users SET skype = ? WHERE id = ?");
        $result = $stmt->execute([$skype, $id]);
        if(!$result) exit('Ошибка');

        $url = Controller::url('profile');
        $stmt = Model::prepare("SELECT login FROM users WHERE id = ?");
        $result = $stmt->execute([$id]);
        if(!$result) exit('Ошибка');
        $login = $stmt->fetch()[0];

        $json = Controller::getUserData($login);
        $json->skype[] = $skype;
        Controller::putUserData($login, $json);

    }       

    header("Location: $url");
    exit();
}
