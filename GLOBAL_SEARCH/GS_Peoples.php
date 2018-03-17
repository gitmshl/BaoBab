<?php
	/*
		Этот файл отвечает за глобальный поиск по людям
	*/
	session_start();
	$N = 15;
	$_SESSION['GS']['Border'] = isset($_SESSION['GS']['Border']) ? $_SESSION['GS']['Border'] : $N;
	
?>