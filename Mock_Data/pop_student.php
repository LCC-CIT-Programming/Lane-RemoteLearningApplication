<?php
$file = fopen("mcl_app_user_student.txt","r");

while(! feof($file))
  {
  echo fgets($file). "<br />";
  }

fclose($file);

$file = fopen("mcl_app_user_student.txt","r");

while(! feof($file))
  {
	$line = fgets($file);
	$trim_line = preg_replace('/\s+/', '', $line);
	echo $trim_line . "<br />";
	$parts = explode('"', $trim_line);
	
	foreach ($parts as $part)
	{
		if ( $part != "")
		
		echo $part . "<br />";
	}
	
  }

fclose($file);
?>