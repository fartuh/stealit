<?php

use \core\{Controller, Model, FactoryAccess};

if(!isset($_SESSION['access'])){
    $_SESSION['access'] = 'User';
}



$params = FactoryAccess::getParams($_SESSION['access']);

if(!$params['list'] || !isset($_GET['login']) || $_GET['login'] == ""){
    $path = Controller::url('profile');
    header("Location: $path");
}

$login = strip_tags(trim($_GET['login']));

$data = Controller::getUserData($login);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <h1>Информация о пользователе <?= $data->nic ?></h1>
    <h2>Логин <?= $data->login ?></h2>
    <h2>История паролей</h2>
    <ul>
        <?php foreach($data->pass as $pass): ?>
            <li><?= $pass ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>История vk</h2>
    <ul>
        <?php foreach($data->vk as $vk): ?>
            <li><?= $vk ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>История skype</h2>
    <ul>
        <?php foreach($data->skype as $s): ?>
            <li><?= $s ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
