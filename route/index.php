
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/templates/header.php');

switch ( parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ) {
    case '/route/about/':
        require($_SERVER['DOCUMENT_ROOT'] . '/templates/about.php');
        break;

    case '/route/contacts/':
        require($_SERVER['DOCUMENT_ROOT'] . '/templates/contacts.php');
        break;

    case '/route/directory/':
        require($_SERVER['DOCUMENT_ROOT'] . '/templates/directory.php');
        break;

    case '/route/news/':
        require($_SERVER['DOCUMENT_ROOT'] . '/templates/news.php');
        break;

    default:
        require($_SERVER['DOCUMENT_ROOT'] . '/templates/error.php');
        break;
}

require($_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php');
