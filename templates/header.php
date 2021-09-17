
<?php
    require($_SERVER['DOCUMENT_ROOT'] . '/src/core.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <link href="/css/styles.css" rel="stylesheet">
        <link rel="stylesheet" href="/css/abote.css">
        <link rel="stylesheet" href="/css/contacts.css">
        <link rel="stylesheet" href="/css/news.css">
        <link rel="stylesheet" href="/css/directory.css">
        <link rel="stylesheet" href="/css/success.css">

        <title>Project - ведение списков</title>
    </head>

    <body>
        <div class="header">
        	<div class="logo"><img src="/i/logo.png" width="68" height="23" alt="Project"></div>

            <div class="clearfix"></div>
        </div>

        <div class="clearfix">
            <ul class="main-menu">
                <?php foreach (arraySort($menu, 'sort', SORT_ASC) as $key => $value): ?>
                    <li><a href="<?=$value['path']?>"><?=$value['title']?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
