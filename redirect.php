<?php
	include_once 'core/init.php';
	$shorten = new Shorten();
	if(isset($_GET['code'])){
		$code = $_GET['code'];
		$url = $shorten->redirect($code);
		if($url){
			header('Location:'.$url);
		}else{
			header('Location:index.php');
		}
	}else{
		header('Location:index.php');
	}	
	
?>