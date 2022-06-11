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

if (0) {
    foreach ($users as $key => $user) {
        $fullName = $user['fullName'];
        $email = $user['email'];
        $password = password_hash('123456', PASSWORD_DEFAULT);

        $result = mysqli_query(connect(),
            "INSERT INTO `users` (`fullName`, `email`, `password`)
            VALUES ('$fullName', '$email', '$password')"
        );
    }

    mysqli_close(connect());
}

if (1) {
    $result = mysqli_query(connect(),
        "SELECT * FROM `users` WHERE `users`.`email` = 'Pushkin@fake.net'"
    );

    var_dump( mysqli_fetch_array($result,  MYSQL_BOTH) );

    mysqli_close(connect());
}

if ( isset($_COOKIE['user']) && isset($_SESSION['isAuth']) ) {
    $authUser = json_decode($_COOKIE['user'], true);
    setcookie('user', $_COOKIE['user'], $cookieTime, '/');
}

if ( isset($_COOKIE['user']) ) {
    $login = json_decode($_COOKIE['user'], true)['email'];
}

if ( isset($_POST['auth']) ) {
    if (!$login || !$password) {
        $error = 'Все поля должны быть заполнены!';
    } else {
        $error = 'Неверный логин или пароль!';

        foreach ($users as $key => $value) {
            if ($login == $value['email'] && $password == $passwords[$key]) {
                $success = true;
                $authUser = $value;
                $error = '';

                $_SESSION['isAuth'] = true;
                setcookie('user', json_encode($value, JSON_UNESCAPED_UNICODE), $cookieTime);
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
