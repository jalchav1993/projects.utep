<?php
	session_start();
	$menu_source = "./json/".$_SESSION['state'].".json";
	$fp = fopen($menu_source, 'r');
	$output = fread($fp, filesize($menu_source));
	fclose($fp);
	print($output);
?>