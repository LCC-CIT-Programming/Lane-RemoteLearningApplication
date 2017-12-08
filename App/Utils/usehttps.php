<?php 

function forceHttps($use_sts) {
	// iis sets HTTPS to 'off' for non-SSL requests
	if ($use_sts && isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
    	header('Strict-Transport-Security: max-age=31536000');
	} elseif ($use_sts) {
    	header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], true, 301);
    	// we are in cleartext at the moment, prevent further execution and output
    	die();
	}
}

?>