<?php
$doc_root = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');

$uri = filter_input(INPUT_SERVER, 'REQUEST_URI');
$dirs = explode('/', $uri);
$app_path = '';

$i = 0;
foreach($dirs as $directory) {
    if ($i == 0) {
        $app_path += '/' . $directory . '/';
    } else {
        $app_path += $directory . '/';
    }
    $i++;
}

set_include_path($doc_root . $app_path);
?>