<?php

$doc_root = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');

$uri = filter_input(INPUT_SERVER, 'REQUEST_URI');
$dirs = explode('/', $uri);
$app_path = '/';

foreach($dirs as $directory) {
	if (!empty($directory)) {
        $app_path .= $directory . '/';
    }
}

$picture_path = '/App';
foreach($dirs as $directory) {
    if (!empty($directory)) {
    	if ($directory == 'App') {
    		$picture_path .= '/ProfilePictures/';
    		break;
    	}
    	else
        	$picture_path .= $directory . '/';
    }
}

set_include_path($doc_root . $app_path);

?>