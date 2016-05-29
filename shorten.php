<?php
	session_start();
	include_once "core/init.php";
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$url = $_POST['url'];
		$shorten = new Shorten();
		$code = $shorten->mkurl($url);
		if(!$code){
			$_SESSION['failed'] = 'URL is not valid ! ';
		}else{
			$_SESSION['success'] = 'URL shorten success.';
		}
		header('Location:index.php');
	}
?>