<?php

/*
	This one reads redirects from CSV list
	and echoes .htaccess rules
*/

$i = 0;

$startingUrl = 'http://www.example.com/';
$dataFile = 'data/input.csv';

echo 'Reading csv<br />';
if (file_exists($dataFile)) {

	$file = @fopen($dataFile, "r") ;
	// while there is another line to read in the file
	echo '<pre>';
	while (!feof($file)){
		// Get the current line that the file is reading
		$currentLine = fgets($file) ;
		$currentLine = explode(',',$currentLine) ;

		$req = substr($currentLine[0], 23);
		echo 'RewriteCond %{REQUEST_URI}  ^'.str_replace('.', '\.', $req).'$<br/>';
		echo 'RewriteRule ^(.*)$  '.$currentLine[1].' [R=301,L]<br/><br/>';

		$i++;
	}
	echo '</pre>';

	fclose($file) ;

}

echo $i.' lines read';

?>