
<?php

require($_SERVER['DOCUMENT_ROOT'] . '/src/functions.php');
require($_SERVER['DOCUMENT_ROOT'] . '/src/main_menu.php');

$login = htmlspecialchars($_POST['login'] ?? '');
$password = htmlspecialchars($_POST['password'] ?? '');

$authUser = [];
$success = false;
$error = '';

if ( isset($_POST['auth']) ) {
    require ($_SERVER['DOCUMENT_ROOT'] . '/php/users.php');

    if ( $login == '' || $password == '' ) {
        $error = 'Все поля должны быть заполнены!';
    } else {
        $error = 'Неверный логин или пароль!';

        for ($i = 0; $i < count($users); $i++) {
            if ($login == $users[$i]['email'] && $password == $passwords[$i]) {
                $success = true;
                $authUser = $users[$i];
                $error = '';
            }
        }
    }
}
