<?php
	include_once "core/init.php";
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$url = $_POST['url'];
		$shorten = new Shorten();
		$code = $shorten->mkurl($url);
	}
?>