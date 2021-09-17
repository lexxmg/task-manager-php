
<?php

//______________________Сортировка массива______________________________________
// arraySort($array, 'sort_key', SORT_ASC) по возрастанию
// arraySort($array, 'sort_key', SORT_DESC) по убыванию

function arraySort(array $array, $key = 'sort', $sort = SORT_ASC): array
{
    $sortArray = $array;

    array_multisort(array_column($sortArray, $key), $sort, $sortArray);

    return $sortArray;
}

//______________________________________________________________________________


//______________________Обрезка строки__________________________________________
// cutString($string, 14);

function cutString(string $line, $length = 12, $appends = '...'): string
{
    $strLength = mb_strlen($line);

    if ($strLength > $length) {
        return mb_substr($line, 0, $length) . $appends;
    } else {
        return $line;
    }
}

//______________________________________________________________________________


//______________________Вывод меню______________________________________________

function showMenu(array $array, string $key, $sort, $className = '')
{
  require($_SERVER['DOCUMENT_ROOT'] . '/templates/menu.php');
}

//______________________________________________________________________________


//______________________Получить заголовок______________________________________

function getTitle(array $menu): string
{
    $url = $_SERVER['REQUEST_URI'];

    foreach ($menu as $key => $value) {
      if ($value['path'] === $url) {
        return $value['title'];
      }
    }
}

//______________________________________________________________________________
