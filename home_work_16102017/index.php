<?php

define('DS', DIRECTORY_SEPARATOR);

include_once('lib'.DS.'core.php');

if (isset($admin)) {
    $patch = 'admin';
} else {
    $patch = 'public';
}

$incPatch = __DIR__.DS.'inc'.DS.$patch;

$page = 'main';

if (isset($_GET['page'])) {
    $page = str_replace('/','',$_GET['page']);
}

ob_start();

include($incPatch.DS.'header.php');

if (!include($incPatch.DS."$page.php")) {
    header("HTTP/1.0 404 Not Found");
    die(404);
};

include($incPatch.DS.'footer.php');

echo ob_get_clean();