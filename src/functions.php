<?php

/**
* Подключение к БД
*/
function connect($close = '')
{
    static $connect = null;

    if (!$connect) {
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $dbname = 'skillbox_19.6';

        $connect = new mysqli($host, $user, $password, $dbname) or die('connect BD err');
    }

    if ($close === 'close') {
        $connect->close();
        $connect = null;
        unset($connect);
        return;
    }

    return $connect;
}

/**
* Получить пользователя
*/
function getUser(string $email)
{
    $email = connect()->real_escape_string($email);

    $result = connect()->query(
        "SELECT * FROM `users`
        WHERE `users`.`email` = '$email' OR `users`.`id` = $email;"
    );

    $user = $result->fetch_array(MYSQLI_ASSOC);

    connect('close');

    if ($user) {
        return $user;
    } else {
        return false;
    }
}

/**
* Получить сообщение
*/
function getMessage(int $id, int $userId)
{
    $id = connect()->real_escape_string($id);
    $userId = connect()->real_escape_string($userId);

    $result = connect()->query(
        "SELECT * FROM `messages`
            WHERE `messages`.`id`=$id AND
            (`messages`.`user_id_sender`=$userId OR `messages`.`user_id_recipient`=$userId);"
    );

    $message = $result->fetch_array(MYSQLI_ASSOC);

    connect('close');

    if ($message) {
        return $message;
    } else {
        return false;
    }
}

/**
* Пометить как прочитанное
*/
function setMessageReading(int $messageId): bool
{
    $messageId = connect()->real_escape_string($messageId);

    $result = connect()->query(
        "UPDATE `messages` SET `messages`.`reading` = 1 WHERE `id`=$messageId;"
    );

    connect('close');

    if ($result) {
        return true;
    } else {
        return false;
    }
}

/**
* получение групп пользователя
*/
function getGroups(string $email): array
{
    $groups = [];
    $email = connect()->real_escape_string($email);

    $result = connect()->query(
        "SELECT `users`.`email`, `groups`.`name`, `groups`.`description`
        FROM `users`
        LEFT JOIN `user_groups` ON `users`.`id`=`user_groups`.`user_id`
        LEFT JOIN `groups` ON `user_groups`.`group_id`=`groups`.`id`
        WHERE `email`='$email';"
    );


    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $groups[] = $row;
    }

    connect('close');

    return $groups;
}

/**
* Получить заголовки сообщений
*/
function getTitleMessages(int $id): array
{
    $messages = [];
    $id = connect()->real_escape_string($id);

    $result = connect()->query(
        "SELECT `messages`.`id`, `messages`.`title`, `message_sections`.`name`, `messages`.`reading`
        FROM `messages`
        LEFT JOIN `message_sections` ON `message_sections`.`id`=`messages`.`id`
        WHERE `messages`.`user_id_recipient`='$id';"
    );


    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $messages[] = $row;
    }

    connect('close');

    return $messages;
}

/**
* Сортировка массива
* arraySort($array, 'sort_key', SORT_ASC) по возрастанию
* arraySort($array, 'sort_key', SORT_DESC) по убыванию
*/
function arraySort(array $array, $key = 'sort', $sort = SORT_ASC): array
{
    array_multisort(array_column($array, $key), $sort, $array);

    return $array;
}

/**
* Обрезка строки
* cutString($string, 14);
*/
function cutString(string $line, $length = 12, $appends = '...'): string
{
    return mb_strimwidth($line, 0, $length + mb_strlen($appends), $appends);
}

/**
* Вывод меню
* showMenu($menu, 'title', SORT_DESC, 'main-menu bottom')
*/
function showMenu(array $array, string $key, $sort, $className = '')
{
    require($_SERVER['DOCUMENT_ROOT'] . '/templates/menu.php');
}

/**
* Получить заголовок
*/
function getTitle(array $menu): string
{
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    foreach ($menu as $key => $value) {
        if ($value['path'] === $path) {
          return $value['title'];
        }
    }

    return 'Страница не найдена';
}

/**
* Если путь существует
* isCurrentUrl('/route/directory/') true
*/
function isCurrentUrl(string $url): bool
{
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === $url;
}
