
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
        <link rel="stylesheet" href="/css/error.css">
        <link rel="stylesheet" href="/css/directory.css">
        <link rel="stylesheet" href="/css/success.css">

        <title>Project - ведение списков</title>
    </head>

    <body>
        <div class="header">
        	<div class="logo"><img src="/i/logo.png" width="68" height="23" alt="Project"></div>

            <?php if ( !empty($authUser) ): ?>
                <div class="auth-user-container">
                    <div class="auth-user-container__user">
                        <a href="/?logout" class="auth-user-container__link">Выйти</a>

                        <span class="auth-user-container__email"><?=$authUser['fullName']?></span>
                    </div>
                </div>
            <?php endif; ?>

            <div class="clearfix"></div>
        </div>

        <div class="clearfix">
          <?php showMenu($menu, 'sort', SORT_ASC, 'main-menu')?>
        </div>
