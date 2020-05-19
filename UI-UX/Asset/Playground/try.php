<?php
	$str = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/Asset/notice.json');
	$json = json_decode($str, true);
	foreach ($json as $value) 
	{
		print_r($value);
		print_r("\n");
	}
?>