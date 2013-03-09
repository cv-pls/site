<?php

date_default_timezone_set('Europe/Amsterdam');

require __DIR__.'/config.downloads.php';
if (is_file(__DIR__.'/config.alpha.php')) {
    require __DIR__.'/config.alpha.php';
}

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
        $title = 'Changelog';
        $content = get_page_content('changelog');
        break;

    case 'source':
        $title = 'Source';
        $content = get_page_content('source');
        break;

    case 'downloads':
        $title = 'Downloads';
        $content = get_page_content('downloads');
        break;

    case 'privacy':
        $title = 'Privacy statement';
        $content = get_page_content('privacy');
        break;

    case 'about-us':
        $title = 'About us';
        $content = get_page_content('about-us');
        break;

    default:
        $title = 'Not found';
        $content = get_page_content('not-found');
        break;
}

require __DIR__ . '/pages/base.phtml';