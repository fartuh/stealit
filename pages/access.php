<?php

use \core\{Controller, Model, FactoryAccess};

if(!isset($_SESSION['access'])){
    $_SESSION['access'] = 'User';
}



$params = FactoryAccess::getParams($_SESSION['access']);

if(!$params['list'] || !isset($_GET['login'])){
    $path = Controller::url('profile');
    header("Location: $path");
}

$login = strip_tags(trim($_GET['login']));

$json = Controller::getUserData($login);

$current_access = end($json->access);

if(isset($_POST['new_access']) && strip_tags(trim($_POST['new_access'])) != ""){
    $new_access = strip_tags(trim($_POST['new_access']));
    
    $stmt = Model::prepare("SELECT access FROM users WHERE login = ?");
    $result = $stmt->execute([$login]);

    if(!$result) exit('Ошибка');
    
    $access = $stmt->fetch(\PDO::FETCH_ASSOC)['access'];
    if($access == "Admin" || $current_access == "Admin") echo "Недостаточно прав";
    else{
        $stmt = Model::prepare("UPDATE users SET access = ? WHERE login = ?");
        $result = $stmt->execute([$new_access]);

        if(!$result) exit('Ошибка');

        $json = Controller::getUserData($login);
        $json->access[] = $new_access;
        Controller::putUserData($login, $json);

        echo "Изменено успешно";
    }
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <a href="<?= Controller::url('profile') ?>">Вернуться в аккаунт</a>
    <form action="" method="POST">
        <h2>Текущий уровень доступа: <?= $current_access ?></h2>
        <input name="new_access" list="data">
        <datalist id="data">
            <option value="User"></option>
            <option value="VIP"></option>
            <option value="Premium"></option>
        </datalist>
        <input type="submit">
    </form>
</body>
</html>
