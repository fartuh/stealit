<?php

use \core\Controller;

Controller::action('change');

?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title></title>
</head>
<body>
    <form action="" method="post" >
        <a href="<?= Controller::url('profile') ?>">Вернуться в аккаунт</a>
        <br/>
        <label for="">Новый пароль<br/><input type="text" name="newpass"><br/><br/></label>
        <label for="">Новый vk<br/><input type="text" name="vk"><br/><br/></label>
        <label for="">Новый skype<br/><input type="text" name="skype"><br/><br/></label>
        <input type="submit" value="Изменить пароль" onclick="return valform()">
    </form>
<script>
    function valform(){
        var pass = document.getElementsByName('newpass')[0].value;
        var vk = document.getElementsByName('vk')[0].value;
        var skype = document.getElementsByName('skype')[0].value;
        if(pass == ""){

        }
        else{
            if(pass.length < 8){
                alert('Пароль не должен быть менее 8 символов');
                return false;
            }
        }

        return true;
    }
</script>
</body>
</html>
