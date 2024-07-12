<?php
	$host='localhost';
	$dbuser = 'burke';
	$dbpassword = 'e3e3ee33';
	$dbname = 'pygogo';
	$link = mysqli_connect($host,$dbuser,$dbpassword,$dbname);
	if($link){
		mysqli_query($link,'SET NAMES utf8');
		session_start();
	}
?>