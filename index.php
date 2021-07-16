<?php

require ($_SERVER['DOCUMENT_ROOT'] . '/php/users.php');

$login = htmlspecialchars($_POST['login'] ?? '');
$password = htmlspecialchars($_POST['password'] ?? '');

$authUser = [];
$success = false;
$error = '';

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
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/success.css">
    <title>Project - ведение списков</title>
</head>

<body>
    <div class="header">
    	<div class="logo"><img src="/i/logo.png" width="68" height="23" alt="Project"></div>

        <div class="clearfix"></div>
    </div>

    <div class="clear">
        <ul class="main-menu">
            <li><a href="#">Главная</a></li>
            <li><a href="#">О нас</a></li>
            <li><a href="#">Контакты</a></li>
            <li><a href="#">Новости</a></li>
            <li><a href="#">Каталог</a></li>
        </ul>
    </div>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
    	<tr>
        	<td class="left-collum-index">

				<h1>Возможности проекта —</h1>
				<p>Вести свои личные списки, например покупки в магазине, цели, задачи и многое другое. Делится списками с друзьями и просматривать списки друзей.</p>

			</td>
            <td class="right-collum-index">

				<div class="project-folders-menu">
					<ul class="project-folders-v">
    					<li class="project-folders-v-active"><a href="<?=$_SERVER['PHP_SELF']?>?login=yes">Авторизация</a></li>
    					<li><a href="#">Регистрация</a></li>
    					<li><a href="#">Забыли пароль?</a></li>
					</ul>
				    <div class="clearfix"></div>
				</div>

                <?php if (isset($_GET['login']) && $_GET['login'] == 'yes'): ?>

    				<div class="index-auth">
                        <form action="" method="post">
    						<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <?php if ($error): ?>
                                    <tr>
        								<td class="iat">
                                            <span class="text-error"><?=$error?></span>
                                        </td>
        							</tr>
                                <?php endif ?>

                                <?php if ($success): ?>
                                    <?php include($_SERVER['DOCUMENT_ROOT'] . '/php/success.php')?>
                                <?php endif ?>

    							<tr>
    								<td class="iat">
                                        <label for="login_id">Ваш e-mail:</label>
                                        <input id="login_id" size="30" name="login" value="<?=$login?>">
                                    </td>
    							</tr>
    							<tr>
    								<td class="iat">
                                        <label for="password_id">Ваш пароль:</label>
                                        <input id="password_id" size="30" name="password" type="password" value="<?=$password?>">
                                    </td>
    							</tr>
    							<tr>
    								<td><input type="submit" name="auth" value="Войти"></td>
    							</tr>
    						</table>
                        </form>
    				</div>

                <?php endif ?>

			</td>
        </tr>
    </table>

    <div class="clearfix">
        <ul class="main-menu bottom">
            <li><a href="#">Главная</a></li>
            <li><a href="#">О нас</a></li>
            <li><a href="#">Контакты</a></li>
            <li><a href="#">Новости</a></li>
            <li><a href="#">Каталог</a></li>
        </ul>
    </div>

    <div class="footer">&copy;&nbsp;<nobr>2018</nobr> Project.</div>

</body>
</html>
