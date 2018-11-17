<?php

use \core\{Controller, Model, FactoryAccess};

if(!isset($_SESSION['access'])){
    $_SESSION['access'] = 'User';
}



$params = FactoryAccess::getParams($_SESSION['access']);

if(!$params['users']){
    $path = Controller::url('profile');
    header("Location: $path");
}

$stmt = Model::prepare("SELECT * FROM users WHERE users.access <> 'Admin' AND users.access <> 'Moderator'");
$result = $stmt->execute([]);

if(!$result) exit('Ошибка');

$data = $stmt->fetchall(\PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<a href="<?= Controller::url('profile') ?>">Вернуться в профиль</a>
    <table>
        <tr>
            <td>Ник</td>
            <td>Логин</td>
            <td>Уровень доступа</td>
            <td>Вконтакте</td>
            <td>Skype</td>
        </tr>
        <?php foreach($data as $d): ?>
            <tr>
                <td><?= $d['nic'] ?></td>
                <td><?= $d['login'] ?></td>
                <td><?= $d['access'] ?></td>
                <td><?= $d['vk'] ?></td>
                <td><?= $d['skype'] ?></td>
                <td>
                    <a href="<?= Controller::url('list') . "?login=" . $d['login'] ?>">Информация о пользователе</a>
                </td>
                <td>
                    <a href="<?= Controller::url('access') . "?login=" . $d['login'] ?>">Изменить уровень доступа</a>
                </td>

           </tr>
        <?php endforeach; ?>
    </table>

    </body>
