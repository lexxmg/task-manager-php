<?php
session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/src/functions.php';
require $_SERVER['DOCUMENT_ROOT'] . '/src/main_menu.php';
//require $_SERVER['DOCUMENT_ROOT'] . '/php/users.php';

$login = htmlspecialchars($_POST['login'] ?? '');
$password = htmlspecialchars($_POST['password'] ?? '');

$authUser = [];
$userGroups = [];
$success = false;
$error = '';
$cookieTime = time() + 60 * 60 * 24 * 30;

if (0) {
    $password = password_hash('123456', PASSWORD_DEFAULT);

    $result = connect()->query(
        "UPDATE `users` SET `password`='$password'"
    );

    connect()->close();
}

if ( isset($_COOKIE['user']) && isset($_SESSION['isAuth']) ) {
    $authUser = json_decode($_COOKIE['user'], true);
    setcookie('user', $_COOKIE['user'], $cookieTime, '/');
}

if ( isset($_COOKIE['user']) ) {
    $login = json_decode($_COOKIE['user'], true)['email'];

    $groups = getGroups($login);

    if ($groups) {
        $userGroups = $groups;
    }
}

if ( isset($_POST['auth']) ) {
    if (!$login || !$password) {
        $error = 'Все поля должны быть заполнены!';
    } else {
        $error = 'Неверный логин или пароль!';

        $user = getUser($login);

        if ($user && password_verify($password, $user['password'])) {
            foreach ($user as $key => $item) {
                if ($key != 'password') {
                    $authUser[$key] = $item;
                }
            }

            $success = true;
            $error = '';

            $_SESSION['isAuth'] = true;
            setcookie('user', json_encode($authUser, JSON_UNESCAPED_UNICODE), $cookieTime);
            header('Location: /');
            exit();
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
