<?php

use \core\Controller;

setcookie('id', '', time() - 3600);
unset($_COOKIE['id']);
unset($_SESSION['id']);
unset($_SESSION['access']);
$url = Controller::url('auth');
header("Location: $url");
exit();
