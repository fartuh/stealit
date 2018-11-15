<?php

use \core\{Controller,Model};

Controller::action('forget');

?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title></title>
</head>
<body>
    <form action="" method="post">
        <label for="">Введите ваш login<br/><input type="text" name="login"><br/></label>
        <label for="">Введите секретное слово, указанное при регистрации<br/><input type="text" name="secret"><br/></label>
        <label for="">Введите новый пароль<br/><input type="text" name="newpass"><br/></label>
        <input type="submit" value="Восстановить аккаунт" onclick="return valform()">
    </form>
<script>
    function valform(){
        var pass = document.getElementsByName('newpass')[0].value;
        if(pass.length < 8){
            alert('Пароль не должен быть менее 8 символов');
            return false;
        }

        return true;
    }
</script>
</body>
</html>
