
<?php

//______________________Сортировка массива______________________________________
  // arraySort($array, 'sort_key', SORT_ASC) по возрастанию
  // arraySort($array, 'sort_key', SORT_DESC) по убыванию

function arraySort(array $array, $key = 'sort', $sort = SORT_ASC): array
{
    //$sortArray = $array;

    array_multisort(array_column($array, $key), $sort, $array);

    return $array;
}

//______________________________________________________________________________


//______________________Обрезка строки__________________________________________
 // cutString($string, 14);

function cutString(string $line, $length = 12, $appends = '...'): string
{
    return mb_strimwidth($line, 0, $length + mb_strlen($appends), $appends);
}

//______________________________________________________________________________


//______________________Вывод меню______________________________________________
  //showMenu($menu, 'title', SORT_DESC, 'main-menu bottom')

function showMenu(array $array, string $key, $sort, $className = '')
{
    require($_SERVER['DOCUMENT_ROOT'] . '/templates/menu.php');
}

//______________________________________________________________________________


//______________________Получить заголовок______________________________________

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

//______________________________________________________________________________

//______________________Если путь существует____________________________________

  //isCurrentUrl('/route/directory/') true

function isCurrentUrl(string $url): bool
{
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === $url;
}

//______________________________________________________________________________
