<?php

date_default_timezone_set('Europe/Amsterdam');

$path = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

function get_page_content($page)
{
    ob_start();
    require __DIR__ . '/pages/content/' . $page . '.phtml';
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

switch ($path[0]) {
    case '':
        $content = get_page_content('home');
        break;

    case 'changelog':
        $content = get_page_content('changelog');
        break;

    default:
        $content = get_page_content('not-found');
        break;
}

require __DIR__ . '/pages/base.phtml';