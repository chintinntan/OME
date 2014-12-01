<?php
	session_start();

	$_SESSION['user'] = 'francis';
	$_SESSION['pass'] = 'padao';
	$_SESSION['name'] = 'francisreypadao';

	echo '<pre>';
	print_r($_SESSION);
	echo '</pre>';

	echo session_id();

	//session_destroy();
?>