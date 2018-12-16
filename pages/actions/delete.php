<?php

use \core\{Controller,Model};

if(isset($_GET['id'])){
    $id = strip_tags(trim($_GET['id']));
    if(isset($_SERVER['HTTP_REFEREF'])){
        $back = $_SERVER['HTTP_REFEREF'];
    }
    else $back = Controller::url('profile');

    if($id == ""){
        echo "Не указан id"; 
    }
    else{
        $stmt = Model::prepare("SELECT * FROM accounts WHERE steal_id = ?");
        $result = $stmt->execute([$id]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        if(!isset($data['steal_id'])) exit("Такой id не найден");
        $auth = Controller::getAuth();
        if($auth != $data['user_id']){
            echo "Недостаточно прав";
        }
        else{
            $stmt = Model::prepare("DELETE FROM accounts WHERE steal_id = ?");
            $stmt->execute([$id]);
            header("Location: $back");
            exit();
        }
    }
}
else{
    echo "Не указан id"; 
}
