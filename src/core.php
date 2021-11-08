<?php
session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/src/functions.php';
require $_SERVER['DOCUMENT_ROOT'] . '/src/main_menu.php';
require $_SERVER['DOCUMENT_ROOT'] . '/php/users.php';

$login = htmlspecialchars($_POST['login'] ?? '');
$password = htmlspecialchars($_POST['password'] ?? '');

$authUser = [];
$success = false;
$error = '';
$cookieTime = time() + 60 * 60 * 24 * 30;

if ( isset($_COOKIE['user']) && isset($_SESSION['isAuth']) ) {
    $authUser = json_decode($_COOKIE['user'], true);
    setcookie('user', $_COOKIE['user'], $cookieTime, '/');
}

if ( isset($_COOKIE['user']) ) {
    $login = json_decode($_COOKIE['user'], true)['email'];
}

if ( isset($_POST['auth']) ) {
    if ( $login == '' || $password == '' ) {
        $error = 'Все поля должны быть заполнены!';
    } else {
        $error = 'Неверный логин или пароль!';

        for ($i = 0; $i < count($users); $i++) {
            if ($login == $users[$i]['email'] && $password == $passwords[$i]) {
                $success = true;
                $authUser = $users[$i];
                $error = '';

                $_SESSION['isAuth'] = true;
                setcookie('user', json_encode($users[$i], JSON_UNESCAPED_UNICODE), $cookieTime);
                header('Location: /');
                exit();
            }
        }
    }
}

if ( isset($_GET['logout']) ) {
    session_destroy();
    unset($_SESSION['isAuth']);

    setcookie('user', '', 1);

    header('Location: /');
    exit();
}
